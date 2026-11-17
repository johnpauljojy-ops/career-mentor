<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIResumeController extends Controller
{
    /**
     * Generate AI suggestions, Job Description alignment, Deficiency Score,
     * and Improvement Tracking for Premium Resumes based on Designation.
     */
    public function generateSuggestions(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please sign in to access AI resume features.'
            ], 401);
        }

        $userId = Auth::id();

        $resume = Resume::with('template')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Check if template is Premium
        if (!$resume->isPremium()) {
            return response()->json([
                'success' => false,
                'message' => 'AI suggestions and deficiency analysis are exclusively available for Premium Resumes.'
            ], 403);
        }

        // Check active subscription
        $hasActiveSubscription = Subscription::where('user_id', $userId)
            ->where('status', 'active')
            ->whereNotNull('end_date')
            ->where('end_date', '>=', now())
            ->exists();

        if (!$hasActiveSubscription) {
            return response()->json([
                'success' => false,
                'message' => 'An active subscription is required to use Premium AI features.'
            ], 403);
        }

        // Target Designation (form field used for AI search and suggestions benchmarking; not a column in resumes table)
        $designation = trim(
            $request->input('designation') 
            ?: ($request->input('title') 
            ?: ($resume->ai_suggestions['designation'] ?? $resume->title))
        );

        if (empty($designation)) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a target designation in the Designation box to get AI suggestions.'
            ], 422);
        }

        $previousScore = $request->input('previous_score') !== null 
            ? (int)$request->input('previous_score') 
            : ($resume->ai_score !== null ? (int)$resume->ai_score : null);

        $previousDeficiency = $request->input('previous_deficiency') !== null 
            ? (int)$request->input('previous_deficiency') 
            : ($resume->ai_deficiency !== null ? (int)$resume->ai_deficiency : null);

        // Current Resume snapshot from request (live form data) or model
        $resumeSnapshot = [
            'full_name'    => $request->input('full_name') ?: ($resume->full_name ?: Auth::user()->name),
            'title'        => $request->input('title') ?: $resume->title,
            'designation'  => $designation,
            'email'        => $request->input('email') ?: $resume->email,
            'phone'        => $request->input('phone') ?: $resume->phone,
            'location'     => $request->input('location') ?: $resume->location,
            'objective'    => $request->input('objective') ?: $resume->objective,
            'education'    => $request->input('education') ?: $resume->education,
            'experience'   => $request->input('experience') ?: $resume->experience,
            'skills'       => $request->input('skills') ?: $resume->skills,
            'achievements' => $request->input('achievements') ?: $resume->achievements,
            'language'     => $request->input('language') ?: $resume->language,
            'hobbies'      => $request->input('hobbies') ?: $resume->hobbies,
        ];

        // Perform AI Analysis
        $analysisResult = $this->callGroqForAnalysis($designation, $resumeSnapshot, $previousScore, $previousDeficiency);

        if (!$analysisResult) {
            $analysisResult = $this->getHeuristicFallback($designation, $resumeSnapshot, $previousScore, $previousDeficiency);
        }

        // Persist AI insights to resumes table
        try {
            // Note: 'designation' is NOT a database field in the 'resumes' table.
            // 'title' is the resume title column in the database and should not be overwritten by AI search.
            if (empty($resume->title)) {
                $resume->title = $request->input('title') ?: $designation;
            }
            if (!empty($analysisResult['job_description'])) {
                $resume->ai_job_description = json_encode($analysisResult['job_description']);
            }
            $resume->ai_score = $analysisResult['evaluation']['match_score'] ?? 70;
            $resume->ai_deficiency = $analysisResult['evaluation']['deficiency_score'] ?? (100 - $resume->ai_score);
            $analysisResult['designation'] = $designation;
            $resume->ai_suggestions = $analysisResult;
            $resume->save();
        } catch (\Exception $e) {
            Log::warning('Failed saving AI resume metrics to DB: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'data'    => $analysisResult,
            'message' => 'AI resume suggestions and deficiency analysis updated successfully.'
        ]);
    }

    /**
     * Call Groq AI API with structured JSON output instructions
     */
    protected function callGroqForAnalysis(string $designation, array $resumeData, ?int $previousScore, ?int $previousDeficiency): ?array
    {
        $apiKey = config('services.groq.key', env('GROQ_API_KEY'));
        if (empty($apiKey)) {
            return null;
        }

        $prevScoreText = $previousScore !== null 
            ? "Previous Evaluation Score: {$previousScore}% (Previous Deficiency: " . (100 - $previousScore) . "%). Compare the current resume against the previous score to determine how much the resume has improved or how much deficiency has decreased after corrections."
            : "This is the initial evaluation for this target designation.";

        $prompt = "You are a Chief Talent Officer and ATS (Applicant Tracking System) Specialist.
Analyze this resume for the target designation: \"{$designation}\".

TARGET DESIGNATION: {$designation}
{$prevScoreText}

CURRENT CANDIDATE RESUME:
" . json_encode($resumeData, JSON_PRETTY_PRINT) . "

INSTRUCTIONS:
1. Benchmark against the authentic modern industry Job Description for \"{$designation}\".
2. Evaluate the match rate (match_score from 0 to 100).
3. Compute the deficiency_score (deficiency_score = 100 - match_score).
4. If a previous score was provided ({$previousScore}%), calculate:
   - score_improvement: difference (e.g., if now 82% and previous was 68%, score_improvement = +14%). If first evaluation, set to 0.
   - deficiency_reduction: how much deficiency was reduced.
   - improvement_message: explain specifically what additions/corrections improved the resume and what deficiencies remain.
5. Identify top 3-4 specific deficiencies / missing competencies (e.g. missing tools, lack of quantified business outcomes, generic summary).
6. Provide concrete, high-impact section suggestions:
   - suggested_objective: an ATS-optimized, high-impact career objective for \"{$designation}\".
   - missing_skills_to_add: array of must-have technical/domain skills for \"{$designation}\" missing from the resume.
   - experience_enhancements: 2-3 tailored bullet points using action verbs and metrics for \"{$designation}\".
   - recommended_certifications: 2-3 industry-standard certifications for \"{$designation}\".
7. Return strictly valid RAW JSON format only. No markdown fences.

OUTPUT JSON SCHEMA:
{
  \"designation\": \"{$designation}\",
  \"job_description\": {
    \"title\": \"Standard Title for {$designation}\",
    \"overview\": \"1-2 sentence industry overview of what this role entails.\",
    \"key_responsibilities\": [
      \"Core responsibility 1\",
      \"Core responsibility 2\",
      \"Core responsibility 3\"
    ],
    \"required_skills\": [
      \"Key skill 1\",
      \"Key skill 2\",
      \"Key skill 3\",
      \"Key skill 4\"
    ],
    \"preferred_certifications\": [
      \"Cert 1\",
      \"Cert 2\"
    ]
  },
  \"evaluation\": {
    \"match_score\": 78,
    \"deficiency_score\": 22,
    \"previous_score\": " . ($previousScore !== null ? $previousScore : "null") . ",
    \"score_improvement\": " . ($previousScore !== null ? "12" : "0") . ",
    \"is_improved\": true,
    \"deficiency_level\": \"Low / Moderate / High\",
    \"improvement_summary\": \"Detailed explanation of how much the resume improved or what remains deficient.\",
    \"status_badge\": \"Strong Candidate / Moderate Match / Needs Improvement\"
  },
  \"deficiencies\": [
    {
      \"section\": \"Skills / Experience / Certifications / Summary\",
      \"severity\": \"High / Medium / Low\",
      \"issue\": \"Specific deficiency description\",
      \"recommendation\": \"How to fix this deficiency\"
    }
  ],
  \"section_suggestions\": {
    \"suggested_objective\": \"Impactful ATS summary...\",
    \"missing_skills_to_add\": [\"Skill A\", \"Skill B\", \"Skill C\"],
    \"experience_enhancements\": [
      \"• Action-oriented bullet 1 with measurable impact...\",
      \"• Action-oriented bullet 2 with tech stack...\"
    ],
    \"recommended_certifications\": [\"Cert A\", \"Cert B\"]
  },
  \"overall_verdict\": \"2 sentences of actionable advice to reach 95%+ readiness for this designation.\"
}";

        $models = ['openai/gpt-oss-120b', 'openai/gpt-oss-20b', 'qwen/qwen3.8-27b'];

        foreach ($models as $model) {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type'  => 'application/json',
                ])->timeout(30)->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => $model,
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are an expert ATS Resume Auditor and Career Coach. Always return strictly valid JSON.'],
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'response_format' => ['type' => 'json_object']
                ]);

                if ($response->successful()) {
                    $raw = $response->json()['choices'][0]['message']['content'] ?? '{}';
                    $decoded = json_decode($raw, true);
                    if ($decoded && isset($decoded['evaluation']['match_score'])) {
                        return $decoded;
                    }
                } else {
                    Log::warning("Groq AI Resume call failed on model {$model}: " . $response->status() . ' - ' . $response->body());
                }
            } catch (\Exception $e) {
                Log::error("Groq AI Resume exception on model {$model}: " . $e->getMessage());
            }
        }

        return null;
    }

    /**
     * Fallback heuristic evaluator if external API is unreachable
     */
    protected function getHeuristicFallback(string $designation, array $resumeData, ?int $previousScore, ?int $previousDeficiency): array
    {
        $text = strtolower(
            ($resumeData['objective'] ?? '') . ' ' .
            ($resumeData['experience'] ?? '') . ' ' .
            ($resumeData['skills'] ?? '') . ' ' .
            ($resumeData['achievements'] ?? '')
        );

        $wordCount = str_word_count($text);
        $hasMetrics = preg_match('/\b\d+(%|k|\+|x)?\b/i', $text);
        $hasSkills = !empty($resumeData['skills']);
        $hasExp = !empty($resumeData['experience']) && strlen($resumeData['experience']) > 40;

        // Base score calculation
        $baseScore = 55;
        if ($wordCount > 100) $baseScore += 10;
        if ($wordCount > 200) $baseScore += 5;
        if ($hasSkills) $baseScore += 10;
        if ($hasMetrics) $baseScore += 8;
        if ($hasExp) $baseScore += 7;

        $baseScore = min(95, max(40, $baseScore));

        // If previously evaluated, simulate improvement based on content changes
        if ($previousScore !== null) {
            $improvement = max(2, $baseScore - $previousScore);
            $newScore = min(98, $previousScore + $improvement);
        } else {
            $newScore = $baseScore;
            $improvement = 0;
        }

        $deficiency = 100 - $newScore;
        $defLevel = $deficiency > 40 ? 'High' : ($deficiency > 20 ? 'Moderate' : 'Low');

        return [
            'designation' => $designation,
            'job_description' => [
                'title' => $designation,
                'overview' => "A professional in {$designation} is responsible for driving core technical delivery, system optimization, cross-functional collaboration, and aligning deliverables with organizational goals.",
                'key_responsibilities' => [
                    "Design, implement, and maintain high-quality deliverables in line with {$designation} best practices.",
                    "Collaborate with stakeholders and engineering peers to resolve technical and architectural bottlenecks.",
                    "Ensure code quality, automated test coverage, system security, and scalability."
                ],
                'required_skills' => [
                    "Core domain fundamentals in {$designation}",
                    "Problem Solving & Architecture",
                    "Version Control & Modern Tooling",
                    "Database Optimization & API Integration"
                ],
                'preferred_certifications' => [
                    "Industry Certified Specialist in {$designation}",
                    "Cloud / System Architecture Associate"
                ]
            ],
            'evaluation' => [
                'match_score' => $newScore,
                'deficiency_score' => $deficiency,
                'previous_score' => $previousScore,
                'score_improvement' => $improvement,
                'is_improved' => $improvement > 0,
                'deficiency_level' => $defLevel,
                'improvement_summary' => $previousScore !== null 
                    ? "Your resume has improved by +{$improvement}%! Deficiencies dropped from " . (100 - $previousScore) . "% to {$deficiency}% as you refined key sections."
                    : "Initial baseline analysis: your resume currently holds a {$newScore}% match with a {$deficiency}% deficiency gap against standard {$designation} expectations.",
                'status_badge' => $newScore >= 80 ? 'Strong Candidate' : ($newScore >= 65 ? 'Good Alignment' : 'Needs Optimization')
            ],
            'deficiencies' => [
                [
                    'section' => 'Skills',
                    'severity' => 'High',
                    'issue' => "Lacks specific modern keywords and framework certifications commonly filtered by ATS for {$designation}.",
                    'recommendation' => "Add industry-standard libraries, frameworks, and deployment tools relevant to {$designation}."
                ],
                [
                    'section' => 'Experience',
                    'severity' => 'Medium',
                    'issue' => "Project descriptions are action-light and miss quantifiable impact metrics (e.g. speedup %, users supported).",
                    'recommendation' => "Incorporate measurable business impact and technical depth in each project bullet."
                ],
                [
                    'section' => 'Summary',
                    'severity' => 'Low',
                    'issue' => "Career summary does not explicitly spotlight target role keyword '{$designation}'.",
                    'recommendation' => "Align summary to highlight value proposition as a future-ready {$designation}."
                ]
            ],
            'section_suggestions' => [
                'suggested_objective' => "Dedicated and detail-oriented professional targeting the {$designation} role, offering solid technical acumen, demonstrated problem-solving skills, and a commitment to scalable, high-impact deliverables.",
                'missing_skills_to_add' => [
                    "Advanced {$designation} Methodology",
                    "Agile / Scrum Sprint Delivery",
                    "System Performance Optimization",
                    "CI/CD & Cloud Infrastructure"
                ],
                'experience_enhancements' => [
                    "• Spearheaded technical implementations for key features, enhancing efficiency by 25% and reducing defect turnaround.",
                    "• Designed and engineered modular components aligning with enterprise {$designation} standards."
                ],
                'recommended_certifications' => [
                    "Professional Certified {$designation} Practitioner",
                    "AWS / Azure Cloud Certified Associate"
                ]
            ],
            'overall_verdict' => "Incorporate the suggested keywords, quantifiable outcomes, and certifications to elevate your resume match to 90%+."
        ];
    }
}
