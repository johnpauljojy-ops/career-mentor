<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Student;
use App\Models\StudentSkill;
use App\Models\StudentProject;
use App\Models\StudentCertification;
use App\Models\StudentEducation;
use App\Models\StudentLanguage;

class AIRecommendationController extends Controller
{
    /**
     * Display AI-powered recommendations based strictly on the student's qualification, branch, skills, projects, and career profile.
     */
    public function recommendationsPage()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $userId = $user->userid ?? Auth::id();

        // 1. Fetch student record along with all relationships
        $student = Student::with([
            'qualification',
            'branch',
            'skills',
            'projects',
            'certifications',
            'languages',
            'educations'
        ])
        ->where('userid', $userId)
        ->first();

        if (!$student) {
            return redirect()->route('student.profile')->with('error', 'Please complete your student profile first.');
        }

        // 2. Extract child data from student profile
        $skills = $student->skills ? $student->skills->pluck('skill_name')->filter()->values()->toArray() : [];

        $projects = $student->projects ? $student->projects->map(function ($p) {
            return [
                'title'        => $p->project_title,
                'description'  => $p->description,
                'technologies' => $p->technologies,
            ];
        })->toArray() : [];

        $certifications = $student->certifications ? $student->certifications->map(function ($c) {
            return [
                'name'         => $c->certification_name,
                'organization' => $c->issuing_organization,
            ];
        })->toArray() : [];

        $educations = $student->educations ? $student->educations->map(function ($e) {
            return [
                'qualification' => $e->qualification_name,
                'branch'        => $e->branch_name,
                'institution'   => $e->institution_name,
                'cgpa'          => $e->cgpa,
                'years'         => ($e->start_year ? $e->start_year . ' - ' : '') . ($e->end_year ?? ''),
            ];
        })->toArray() : [];

        $languages = $student->languages ? $student->languages->map(function ($l) {
            return [
                'language'    => $l->language_name,
                'proficiency' => $l->proficiency,
            ];
        })->toArray() : [];

        // 3. Prepare structured student profile for the AI prompt
        $studentData = [
            'student_name'      => $user->name ?? 'Student',
            'qualification'     => $student->qualification->qualification_name ?? 'Undergraduate Degree',
            'branch'            => $student->branch->branch_name ?? 'General',
            'college'           => $student->collegename ?? 'N/A',
            'cgpa'              => $student->cgpa ?? 'N/A',
            'graduation_year'   => $student->graduation_year ?? 'N/A',
            'career_goal'       => $student->carrergoal ?? 'Professional Growth in Domain',
            'areas_of_interest' => $student->interest ?? 'Technology & Development',
            'skills'            => !empty($skills) ? $skills : [],
            'projects'          => !empty($projects) ? $projects : [],
            'certifications'    => !empty($certifications) ? $certifications : [],
            'education_history' => !empty($educations) ? $educations : [],
            'languages'         => !empty($languages) ? $languages : [],
        ];

        $skillsStr = !empty($skills) ? implode(', ', $skills) : 'None';

        // 4. Prompt for Groq AI with strict qualification and branch grounding
        $prompt = "You are an expert Senior Academic & Career Counselor.

STUDENT ACADEMIC & CAREER PROFILE:
" . json_encode($studentData, JSON_PRETTY_PRINT) . "

TASK:
Provide personalized, high-value career recommendations (top 3 to 4 job roles) and higher studies recommendations (top 3 to 4 academic pathways) specifically tailored to this student.

CRITICAL RULES:
1. QUALIFICATION & BRANCH ANCHOR:
   - All Job Roles MUST directly correspond to what a candidate with this specific QUALIFICATION ({$studentData['qualification']}) and BRANCH ({$studentData['branch']}) can pursue, combined with their practical skills ({$skillsStr}), projects, certifications, interests, and career goals.
   - All Higher Studies Pathways MUST be valid, recognized post-graduate or master's degrees for which someone with this exact QUALIFICATION ({$studentData['qualification']}) and BRANCH ({$studentData['branch']}) is genuinely eligible (e.g. BCA -> MCA/M.Sc CS; B.Tech CS -> M.Tech/MS CS/AI; B.Com -> M.Com/MBA Finance/CFA; B.Tech Mech -> M.Tech/MS Mechanical/Robotics/Automotive; MBA -> Executive Ph.D./Specialized Post-Grad Certifications/MCA if transitioning).
2. PERSONALIZED EXPLANATIONS:
   - In each job role description and higher study description, explicitly explain how the recommendation aligns with their specific Qualification ({$studentData['qualification']}), Branch ({$studentData['branch']}), skills, and career aspirations.
3. OUTPUT FORMAT:
   - Output strictly valid RAW JSON only. No markdown formatting, no code fences.

JSON STRUCTURE:
{
  \"profile_summary\": \"2-3 sentences analyzing how their {$studentData['qualification']} in {$studentData['branch']} combined with their specific skills and projects empowers them toward their career goal.\",
  \"job_options\": [
    {
      \"job_role\": \"Specific Job Role Title\",
      \"match_score\": 94,
      \"icon\": \"💻\",
      \"badge\": \"94% Match\",
      \"qualification_fit\": \"Directly builds on {$studentData['qualification']} ({$studentData['branch']})\",
      \"description\": \"Detailed explanation connecting their qualification, branch, skills, and projects to this career role.\",
      \"skills\": [\"Skill 1\", \"Skill 2\", \"Skill 3\", \"Skill 4\"],
      \"avg_salary\": \"Realistic salary range (e.g. \$65,000 - \$95,000 / ₹6 - 10 LPA)\",
      \"demand\": \"Very High\"
    }
  ],
  \"higher_studies\": [
    {
      \"program_name\": \"Degree/Program Name (e.g. MCA / M.Tech / M.S. / MBA / M.Sc)\",
      \"specialization\": \"Specialization / Core Domain Focus\",
      \"icon\": \"🎓\",
      \"badge\": \"Top Choice\",
      \"description\": \"Why this postgraduate program is the logical next academic step after {$studentData['qualification']} ({$studentData['branch']}) to fulfill their career goals.\",
      \"skills_or_duration\": [\"2 Years\", \"Top National & Global Universities\", \"Industry Aligned\"],
      \"eligibility\": \"Prerequisite eligibility based on {$studentData['qualification']} ({$studentData['branch']})\",
      \"exam\": \"Relevant Entrance Exams (e.g. NIMCET / GATE / GRE / CAT / CUET-PG)\"
    }
  ]
}";

        // 5. Call Groq API
        $apiKey = config('services.groq.key', env('GROQ_API_KEY'));
        $recommendations = null;

        if (!empty($apiKey)) {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type'  => 'application/json',
                ])->timeout(30)->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'openai/gpt-oss-120b',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are an AI Academic & Career Counselor. Always return valid JSON only.'],
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'response_format' => ['type' => 'json_object']
                ]);

                if ($response->successful()) {
                    $rawContent = $response->json()['choices'][0]['message']['content'] ?? '{}';
                    $recommendations = json_decode($rawContent, true);
                } else {
                    // Fallback to gpt-oss-20b if 120b model is busy
                    $fallbackResponse = Http::withoutVerifying()->withHeaders([
                        'Authorization' => 'Bearer ' . $apiKey,
                        'Content-Type'  => 'application/json',
                    ])->timeout(25)->post('https://api.groq.com/openai/v1/chat/completions', [
                        'model' => 'openai/gpt-oss-20b',
                        'messages' => [
                            ['role' => 'system', 'content' => 'You are an AI Academic & Career Counselor. Always return valid JSON only.'],
                            ['role' => 'user', 'content' => $prompt]
                        ],
                        'response_format' => ['type' => 'json_object']
                    ]);

                    if ($fallbackResponse->successful()) {
                        $rawContent = $fallbackResponse->json()['choices'][0]['message']['content'] ?? '{}';
                        $recommendations = json_decode($rawContent, true);
                    }
                }
            } catch (\Exception $e) {
                Log::error('Groq AI Recommendation Error: ' . $e->getMessage());
                $recommendations = null;
            }
        }

        // Fallback default recommendations if API call failed
        if (empty($recommendations) || empty($recommendations['job_options'])) {
            $recommendations = $this->getDefaultRecommendations($studentData);
        }

        // Profile object for views
        $profile = (object)[
            'carrergoal' => $student->carrergoal,
            'qualification_name' => $student->qualification->qualification_name ?? null,
            'branch_name' => $student->branch->branch_name ?? null,
            'collegename' => $student->collegename,
            'cgpa' => $student->cgpa,
            'graduation_year' => $student->graduation_year,
            'interest' => $student->interest,
        ];

        // 6. Return the Blade view with real dynamic AI data
        return view('student.recommendations', compact('student', 'profile', 'skills', 'recommendations'));
    }

    /**
     * Fallback structured recommendations based on student qualification and branch.
     */
    private function getDefaultRecommendations(array $studentData): array
    {
        $qual = $studentData['qualification'] ?? 'Degree';
        $branch = $studentData['branch'] ?? 'Specialization';
        $skills = !empty($studentData['skills']) ? array_slice($studentData['skills'], 0, 4) : ['Technical Problem Solving', 'Communication'];
        $interest = $studentData['areas_of_interest'] ?? 'Professional Growth';

        return [
            'profile_summary' => "Based on your academic qualification in {$qual} ({$branch}) and interest in {$interest}, here are tailored career paths and higher study programs aligned with your background and goals.",
            'job_options' => [
                [
                    'job_role' => "Associate Professional in {$branch}",
                    'match_score' => 95,
                    'icon' => '💻',
                    'badge' => '95% Match',
                    'qualification_fit' => "Directly builds on {$qual} ({$branch})",
                    'description' => "Leverage your core academic foundation in {$qual} ({$branch}) alongside your skills in " . implode(', ', $skills) . " to deliver industry solutions.",
                    'skills' => !empty($skills) ? $skills : [$branch, 'Analysis', 'Project Execution'],
                    'avg_salary' => '$65,000 - $95,000 / ₹6 - 11 LPA',
                    'demand' => 'Very High'
                ],
                [
                    'job_role' => "Technical Specialist & Consultant",
                    'match_score' => 90,
                    'icon' => '⚙️',
                    'badge' => '90% Match',
                    'qualification_fit' => "Leverages {$qual} domain expertise",
                    'description' => "Apply hands-on skills and domain methods to design, optimize, and oversee specialized processes and applications.",
                    'skills' => ['Domain Analysis', 'Process Design', 'Problem Solving'],
                    'avg_salary' => '$75,000 - $110,000 / ₹8 - 14 LPA',
                    'demand' => 'High'
                ]
            ],
            'higher_studies' => [
                [
                    'program_name' => "Master's Degree Program in {$branch}",
                    'specialization' => "Advanced {$branch} & Applied Systems",
                    'icon' => '🎓',
                    'badge' => 'Top Choice',
                    'description' => "Advanced post-graduate coursework that deepens your mastery beyond {$qual}, preparing you for senior technical and leadership roles.",
                    'skills_or_duration' => ['2 Years', 'Top Universities', 'Industry Aligned'],
                    'eligibility' => "Bachelor's degree in {$qual} / {$branch} or equivalent",
                    'exam' => 'GATE / GRE / CUET-PG / University CETs'
                ],
                [
                    'program_name' => 'MBA in Technology / Operations Management',
                    'specialization' => 'Strategy & Leadership',
                    'icon' => '💼',
                    'badge' => 'Management Path',
                    'description' => "Combines your {$qual} technical foundation with business strategy, product leadership, and executive decision-making.",
                    'skills_or_duration' => ['2 Years', 'Leading B-Schools', 'Leadership Focus'],
                    'eligibility' => "Recognized Graduation in {$qual}",
                    'exam' => 'CAT / GMAT / CMAT'
                ]
            ]
        ];
    }
}