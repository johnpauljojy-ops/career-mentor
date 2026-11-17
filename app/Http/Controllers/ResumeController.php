<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\ResumeTemplate;
use App\Models\Student;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ResumeController extends Controller
{
    /**
     * Display the Resume Builder catalog with templates and existing user resumes
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('loginn');
        }

        $userId = Auth::id();
        $user = Auth::user();

        // Check active subscription
        $hasActiveSubscription = Subscription::where('user_id', $userId)
            ->where('status', 'active')
            ->whereNotNull('end_date')
            ->where('end_date', '>=', now())
            ->exists();

        if (!$hasActiveSubscription) {
            return redirect()->route('student.subscription')
                ->with('warning', '⭐ A valid subscription is required to access the Resume Builder. Please choose and subscribe to a plan to continue.');
        }

        $student = Student::where('userid', $userId)
            ->with(['skills', 'projects', 'certifications', 'languages', 'educations', 'qualification', 'branch'])
            ->first();

        $resumeTemplates = ResumeTemplate::where('status', 'active')->orderBy('id', 'asc')->get();

        // Fetch all resumes created by this user, keyed by template_id for quick template card check
        $savedResumes = Resume::where('user_id', $userId)
            ->with('template')
            ->latest()
            ->get();

        $userResumesByTemplate = $savedResumes->keyBy('template_id');

        return view('student.resume_template1', compact(
            'user',
            'student',
            'resumeTemplates',
            'savedResumes',
            'userResumesByTemplate',
            'hasActiveSubscription'
        ));
    }

    /**
     * Start/Use a template: Load student details into the resumes table if not exists, then redirect to edit page
     */
    public function startOrEdit($templateId)
    {
        if (!Auth::check()) {
            return redirect()->route('loginn');
        }

        $userId = Auth::id();
        $user = Auth::user();

        $template = ResumeTemplate::where('id', $templateId)
            ->where('status', 'active')
            ->firstOrFail();

        // Subscription check for premium templates
        if ($template->isPremium()) {
            $hasActiveSubscription = Subscription::where('user_id', $userId)
                ->where('status', 'active')
                ->whereNotNull('end_date')
                ->where('end_date', '>=', now())
                ->exists();

            if (!$hasActiveSubscription) {
                return redirect()->route('student.subscription')
                    ->with('warning', '⭐ ' . $template->template_name . ' is an exclusive premium feature! Please activate a subscription plan to unlock.');
            }
        }

        // Check if user already has a resume for this template
        $resume = Resume::where('user_id', $userId)
            ->where('template_id', $templateId)
            ->first();

        // Normal resume should only be displayed and downloaded, not editable
        if ($template->isNormal()) {
            if (!$resume) {
                $student = Student::where('userid', $userId)
                    ->with(['skills', 'projects', 'certifications', 'languages', 'educations', 'qualification', 'branch'])
                    ->first();
                $resume = $this->createResumeFromStudentProfile($userId, $template, $student, $user);
            }
            return redirect()->route('student.resume.preview', $resume->id);
        }

        if ($resume) {
            return redirect()->route('student.resume.edit', $resume->id)
                ->with('info', 'Loaded your previously saved resume for ' . $template->template_name . '.');
        }

        // Load student details to populate the resume
        $student = Student::where('userid', $userId)
            ->with(['skills', 'projects', 'certifications', 'languages', 'educations', 'qualification', 'branch'])
            ->first();

        $resume = $this->createResumeFromStudentProfile($userId, $template, $student, $user);

        return redirect()->route('student.resume.edit', $resume->id)
            ->with('success', '✨ Resume created and populated with your profile details! You can now customize, save, and preview it.');
    }

    /**
     * Show the edit page for an already created resume
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('loginn');
        }

        $userId = Auth::id();
        $user = Auth::user();

        $resume = Resume::with('template')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $template = $resume->template;

        // Normal Resume cannot be edited: redirect directly to preview/display
        if ($template && $template->isNormal()) {
            return redirect()->route('student.resume.preview', $resume->id)
                ->with('info', 'The Normal Resume is display-and-download only and cannot be edited.');
        }

        if ($template && $template->isPremium()) {
            $hasActiveSubscription = Subscription::where('user_id', $userId)
                ->where('status', 'active')
                ->whereNotNull('end_date')
                ->where('end_date', '>=', now())
                ->exists();

            if (!$hasActiveSubscription) {
                return redirect()->route('student.subscription')
                    ->with('warning', '⭐ ' . $template->template_name . ' requires an active subscription to access and edit.');
            }
        }

        $student = Student::where('userid', $userId)
            ->with(['skills', 'projects', 'certifications', 'languages', 'educations', 'qualification', 'branch'])
            ->first();

        return view('student.resume_edit', compact('resume', 'template', 'student', 'user'));
    }

    /**
     * Save/update resume changes
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('loginn');
        }

        $userId = Auth::id();

        $resume = Resume::with('template')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $template = $resume->template;

        // Normal Resume cannot be edited
        if ($template && $template->isNormal()) {
            return redirect()->route('student.resume.preview', $resume->id)
                ->with('error', 'The Normal Resume is display-and-download only and cannot be edited.');
        }

        $isStandard = $template && $template->isStandard();

        if ($isStandard) {
            // Standard Resume: ONLY Work Experience & Featured Projects and Achievements & Certifications can be edited
            $validated = $request->validate([
                'experience'   => 'nullable|string',
                'achievements' => 'nullable|string',
            ]);

            $resume->update([
                'experience'   => $validated['experience'] ?? null,
                'achievements' => $validated['achievements'] ?? null,
            ]);
        } else {
            // Premium resume: ALL details that occur in the resume are manually editable
            // If title is not provided but designation is submitted, fallback gracefully to designation
            if (empty($request->input('title')) && !empty($request->input('designation'))) {
                $request->merge(['title' => $request->input('designation')]);
            }

            $validated = $request->validate([
                'title'        => 'required|string|max:255',
                'designation'  => 'nullable|string|max:255',
                'full_name'    => 'nullable|string|max:255',
                'email'        => 'nullable|email|max:255',
                'phone'        => 'nullable|string|max:50',
                'location'     => 'nullable|string|max:255',
                'objective'    => 'nullable|string',
                'education'    => 'nullable|string',
                'experience'   => 'nullable|string',
                'skills'       => 'nullable|string',
                'achievements' => 'nullable|string',
                'language'     => 'nullable|string',
                'hobbies'      => 'nullable|string',
            ]);

            // Note: 'designation' is NOT a column on the 'resumes' table.
            // It is a form field used exclusively for AI suggestions search.
            $designation = $validated['designation'] ?? null;
            unset($validated['designation']);

            // Retain designation inside ai_suggestions JSON so it remains pre-filled in the search field
            if (!empty($designation)) {
                $suggestions = is_array($resume->ai_suggestions) ? $resume->ai_suggestions : [];
                $suggestions['designation'] = $designation;
                $validated['ai_suggestions'] = $suggestions;
            }

            $resume->update($validated);
        }

        if ($request->input('action') === 'preview') {
            return redirect()->route('student.resume.preview', $resume->id)
                ->with('success', 'Resume saved successfully! Here is your updated live preview.');
        }

        return redirect()->route('student.resume.edit', $resume->id)
            ->with('success', 'Resume details updated and saved successfully.');
    }

    /**
     * Re-fetch student details from profile and overwrite resume fields
     */
    public function resetFromProfile($id)
    {
        if (!Auth::check()) {
            return redirect()->route('loginn');
        }

        $userId = Auth::id();
        $user = Auth::user();

        $resume = Resume::with('template')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        if ($resume->template && $resume->template->isNormal()) {
            return redirect()->route('student.resume.preview', $resume->id);
        }

        $student = Student::where('userid', $userId)
            ->with(['skills', 'projects', 'certifications', 'languages', 'educations', 'qualification', 'branch'])
            ->first();

        $freshData = $this->buildResumeDataFromStudent($student, $user);
        $resume->update($freshData);

        return redirect()->route('student.resume.edit', $resume->id)
            ->with('success', 'All resume fields have been reloaded from your latest student profile details.');
    }

    /**
     * Preview the resume with print and download capability
     */
    public function preview($id)
    {
        if (!Auth::check()) {
            return redirect()->route('loginn');
        }

        $userId = Auth::id();
        $user = Auth::user();

        $resume = Resume::with('template')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $template = $resume->template;

        if ($template && $template->isPremium()) {
            $hasActiveSubscription = Subscription::where('user_id', $userId)
                ->where('status', 'active')
                ->whereNotNull('end_date')
                ->where('end_date', '>=', now())
                ->exists();

            if (!$hasActiveSubscription) {
                return redirect()->route('student.subscription')
                    ->with('warning', '⭐ ' . $template->template_name . ' requires an active subscription to preview.');
            }
        }

        $student = Student::where('userid', $userId)
            ->with(['skills', 'projects', 'certifications', 'languages', 'educations', 'qualification', 'branch'])
            ->first();

        $bladeFile = $template ? $template->blade_file : 'student.resume_normal';

        if (!view()->exists($bladeFile)) {
            $bladeFile = 'student.resume_normal';
        }

        return view($bladeFile, compact('user', 'student', 'template', 'resume'));
    }

    /**
     * Delete an existing resume draft
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('loginn');
        }

        $userId = Auth::id();

        $resume = Resume::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $resume->delete();

        return redirect()->route('student.resume.template1')
            ->with('success', 'Resume deleted successfully.');
    }

    /**
     * Helper to create a Resume record from student profile
     */
    protected function createResumeFromStudentProfile($userId, $template, $student, $user): Resume
    {
        $data = $this->buildResumeDataFromStudent($student, $user);
        $data['user_id'] = $userId;
        $data['template_id'] = $template->id;

        return Resume::create($data);
    }

    /**
     * Helper to format student profile fields into Resume fields
     */
    protected function buildResumeDataFromStudent($student, $user): array
    {
        // 1. Designation (stored in title)
        $title = 'Software Developer';
        if ($student && !empty($student->carrergoal)) {
            $title = trim($student->carrergoal);
        }

        // Full Name
        $fullName = $user->name ?? 'Candidate Name';

        // Email
        $email = $user->email ?? '';

        // Phone
        $phone = $student->phone ?? '';

        // Location / College
        $location = $student->collegename ?? '';

        // 2. Career Objective
        $objective = '';
        if ($student && !empty($student->carrergoal)) {
            $objective = trim($student->carrergoal);
        } elseif ($student && !empty($student->interest)) {
            $objective = "Passionate and motivated candidate with deep interests in {$student->interest}. Eager to apply academic foundations and problem-solving skills to high-impact projects.";
        } else {
            $objective = "Results-driven, motivated candidate seeking an opportunity to leverage academic knowledge, technical proficiencies, and strong collaboration skills to add value to organizational goals.";
        }

        // 3. Education
        $eduLines = [];
        if ($student && $student->educations && $student->educations->isNotEmpty()) {
            foreach ($student->educations as $e) {
                $years = ($e->start_year || $e->end_year) ? ' (' . $e->start_year . ' - ' . ($e->end_year ?: 'Present') . ')' : '';
                $cg = $e->cgpa ? ' | CGPA: ' . $e->cgpa : '';
                $eduLines[] = '• ' . $e->qualification_name . ($e->branch_name ? ' in ' . $e->branch_name : '') . ' - ' . $e->institution_name . $years . $cg;
            }
        } elseif ($student) {
            $qual = $student->qualification->qualification_name ?? 'Degree';
            $branch = $student->branch ? ' in ' . $student->branch->branch_name : '';
            $college = $student->collegename ? ' - ' . $student->collegename : '';
            $grad = $student->graduation_year ? ' (Class of ' . $student->graduation_year . ')' : '';
            $cg = $student->cgpa ? ' | CGPA: ' . $student->cgpa : '';
            $eduLines[] = '• ' . $qual . $branch . $college . $grad . $cg;
        }
        $education = implode("\n", $eduLines);

        // 4. Work Experience / Projects
        $expLines = [];
        if ($student && $student->projects && $student->projects->isNotEmpty()) {
            foreach ($student->projects as $p) {
                $tech = !empty($p->technologies) ? " (Tech: {$p->technologies})" : '';
                $dates = ($p->start_date || $p->end_date) ? " [" . ($p->start_date ?: '') . " - " . ($p->end_date ?: 'Present') . "]" : '';
                $block = "• {$p->project_title}{$tech}{$dates}";
                if (!empty($p->description)) {
                    $block .= "\n  " . trim($p->description);
                }
                $expLines[] = $block;
            }
        }
        if (empty($expLines)) {
            $college = ($student && !empty($student->collegename)) ? " at {$student->collegename}" : "";
            $expLines[] = "• Academic & Coursework Projects{$college}\n  Participated in technical coursework projects, hands-on software design laboratories, and collaborative assignments focused on quality development and problem solving.";
        }
        $experience = implode("\n\n", $expLines);

        // 5. Skills
        $skills = ($student && $student->skills && $student->skills->isNotEmpty())
            ? $student->skills->pluck('skill_name')->implode(', ')
            : 'Software Engineering, Full Stack Development, Database Management, Problem Solving';

        // 6. Achievements / Certifications
        $achLines = [];
        if ($student && $student->certifications && $student->certifications->isNotEmpty()) {
            foreach ($student->certifications as $c) {
                $org = !empty($c->issuing_organization) ? " - {$c->issuing_organization}" : '';
                $date = !empty($c->issue_date) ? " ({$c->issue_date})" : '';
                $achLines[] = "• {$c->certification_name}{$org}{$date}";
            }
        }
        if ($student && !empty($student->cgpa)) {
            $achLines[] = "• Academic Merit: Secured CGPA of {$student->cgpa}" . (!empty($student->collegename) ? " from {$student->collegename}" : "") . ".";
        }
        if (empty($achLines)) {
            $achLines[] = "• Successfully completed academic requirements with commendable grades and active co-curricular participation.";
        }
        $achievements = implode("\n", $achLines);

        // 7. Languages
        $langItems = [];
        if ($student && $student->languages && $student->languages->isNotEmpty()) {
            foreach ($student->languages as $l) {
                $prof = !empty($l->proficiency) ? " ({$l->proficiency})" : '';
                $langItems[] = "{$l->language_name}{$prof}";
            }
        }
        $language = !empty($langItems) ? implode(', ', $langItems) : 'English (Fluent), Hindi (Conversational)';

        // 8. Hobbies
        $hobbies = ($student && !empty($student->interest))
            ? $student->interest
            : 'Software Development, Open Source Contributions, Technology Research, Reading';

        return [
            'full_name'    => $fullName,
            'email'        => $email,
            'phone'        => $phone,
            'location'     => $location,
            'title'        => $title,
            'objective'    => $objective,
            'education'    => $education,
            'experience'   => $experience,
            'skills'       => $skills,
            'achievements' => $achievements,
            'language'     => $language,
            'hobbies'      => $hobbies,
        ];
    }
}
