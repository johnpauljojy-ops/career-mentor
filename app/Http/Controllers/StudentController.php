<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Qualification;
use App\Models\Branches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Student Dashboard
    |--------------------------------------------------------------------------
    */

    /*
|--------------------------------------------------------------------------
| Student Dashboard
|--------------------------------------------------------------------------
*/
    public function studenthome()
    {
        $user = Auth::user();

        $student = Student::where('userid', $user->userid)
            ->with([
                'skills',
                'projects',
                'certifications',
                'languages',
                'educations',
            ])
            ->first();

        $profileCompletion = 0;
        $profileComplete = false;
        $missingFields = [];

        if ($student) {

            /*
            |--------------------------------------------------------------------------
            | Required Profile Fields
            |--------------------------------------------------------------------------
            */

            $requiredFields = [

                'phone' => [
                    'value' => $student->phone,
                    'label' => 'Phone number',
                ],

                'gender' => [
                    'value' => $student->gender,
                    'label' => 'Gender',
                ],

                'dob' => [
                    'value' => $student->dob,
                    'label' => 'Date of birth',
                ],

                'qualification' => [
                    'value' => $student->qualification_id,
                    'label' => 'Qualification',
                ],

                'branch' => [
                    'value' => $student->branch_id,
                    'label' => 'Branch / Specialization',
                ],

                'college' => [
                    'value' => $student->collegename,
                    'label' => 'College name',
                ],

                'cgpa' => [
                    'value' => $student->cgpa,
                    'label' => 'CGPA',
                ],

                'graduation_year' => [
                    'value' => $student->graduation_year,
                    'label' => 'Graduation year',
                ],

                'interest' => [
                    'value' => $student->interest,
                    'label' => 'Career interest',
                ],

                'career_goal' => [
                    'value' => $student->carrergoal,
                    'label' => 'Career goal',
                ],

            ];


            /*
            |--------------------------------------------------------------------------
            | Count completed main fields
            |--------------------------------------------------------------------------
            */

            $completed = 0;

            foreach ($requiredFields as $field) {

                if (
                    $field['value'] !== null &&
                    trim((string) $field['value']) !== ''
                ) {

                    $completed++;

                } else {

                    $missingFields[] = $field['label'];

                }
            }


            /*
            |--------------------------------------------------------------------------
            | Skill Requirement
            |--------------------------------------------------------------------------
            |
            | Skills are now stored in student_skills.
            | At least one skill is required.
            |
            */

            $hasSkill = $student->skills()->exists();

            if ($hasSkill) {

                $completed++;

            } else {

                $missingFields[] = 'At least one skill';

            }


            /*
            |--------------------------------------------------------------------------
            | Calculate Completion
            |--------------------------------------------------------------------------
            */

            $totalFields = 11;

            $profileCompletion = round(
                ($completed / $totalFields) * 100
            );


            /*
            |--------------------------------------------------------------------------
            | Profile Complete
            |--------------------------------------------------------------------------
            */

            $profileComplete = ($completed === $totalFields);
        }


        return view('student.studenthome', [

            'student' => $student,

            'profileCompletion' => $profileCompletion,

            'profileComplete' => $profileComplete,

            'missingFields' => $missingFields,

        ]);
    }

    public function recommendations()
{
    $userId = Auth::id();
    // 1. Fetch student and join qualification
    $profile = DB::table('students')
        ->leftJoin('qualifications', 'students.qualification_id', '=', 'qualifications.qualification_id')
        ->where('students.userid', $userId)
        ->select('students.*', 'qualifications.qualification_name')
        ->first();
    // 2. Fetch skills using studentid
    $skills = [];
    if ($profile) {
        $skills = DB::table('student_skills')
            ->where('studentid', $profile->studentid)
            ->pluck('skill_name')
            ->toArray();
    }
    return view('student.recommendations', [
        'profile' => $profile,
        'skills'  => $skills,
        // (Add any other variables you are passing to this view)
    ]);
}

    public function edit()
    {
        $user = Auth::user();

        /*
         * Find the student's profile using the
         * authenticated user's userid.
         */
        $student = Student::where('userid', $user->userid)
            ->with([
                'qualification',
                'branch',
                'skills',
                'projects',
                'certifications',
                'languages',
                'educations',
            ])
            ->first();

        /*
         * Load master data required by the profile form.
         */
        $qualifications = Qualification::all();

        $branches = Branches::all();

        /*
         * Send all required data to the Blade view.
         */
        return view('student.profile', [
            'user' => $user,
            'student' => $student,
            'qualifications' => $qualifications,
            'branches' => $branches,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Update Student Profile
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Validate all submitted data
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            // Main student profile
            'phone' => 'required|string|max:20',

            'gender' => 'required|in:Male,Female,Other',

            'dob' => 'required|date',

            'qid' => 'required|exists:qualifications,qualification_id',

            'branchid' => 'required|exists:branches,branch_id',

            'collegename' => 'required|string|max:255',

            'cgpa' => 'required|numeric|min:0|max:100',

            'graduation_year' => 'required|integer|min:2000|max:2100',

            'interest' => 'required|string|max:1000',

            'carrergoal' => 'required|string|max:2000',

            // Profile photo
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',


            // Skills
            'skills' => 'nullable|array|max:10',

            'skills.*.skill_name' =>
                'nullable|string|max:255',


            // Projects
            'projects' => 'nullable|array|max:5',

            'projects.*.project_title' =>
                'nullable|string|max:255',

            'projects.*.description' =>
                'nullable|string|max:5000',

            'projects.*.technologies' =>
                'nullable|string|max:1000',

            'projects.*.project_url' =>
                'nullable|url|max:500',

            'projects.*.start_date' =>
                'nullable|date',

            'projects.*.end_date' =>
                'nullable|date|after_or_equal:projects.*.start_date',


            // Certifications
            'certifications' => 'nullable|array|max:5',

            'certifications.*.certification_name' =>
                'nullable|string|max:255',

            'certifications.*.issuing_organization' =>
                'nullable|string|max:255',

            'certifications.*.issue_date' =>
                'nullable|date',

            // Languages
            'languages' => 'nullable|array|max:5',

            'languages.*.language_name' =>
                'nullable|string|max:100',

            'languages.*.proficiency' =>
                'nullable|in:Basic,Intermediate,Fluent,Native',


            // Education
            'educations' => 'nullable|array|max:5',

            'educations.*.qualification_name' =>
                'nullable|string|max:255',

            'educations.*.branch_name' =>
                'nullable|string|max:255',

            'educations.*.institution_name' =>
                'nullable|string|max:255',

            'educations.*.start_year' =>
                'nullable|integer|min:1900|max:2100',

            'educations.*.end_year' =>
                'nullable|integer|min:1900|max:2100',

            'educations.*.cgpa' =>
                'nullable|numeric|min:0|max:100',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 2. Get logged-in user
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        $userid = $user->userid;


        /*
        |--------------------------------------------------------------------------
        | 3. Save everything inside a database transaction
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($request, $validated, $userid) {

            /*
            |--------------------------------------------------------------------------
            | Find existing student or create one
            |--------------------------------------------------------------------------
            */

            $student = Student::firstOrNew([
                'userid' => $userid
            ]);


            /*
            |--------------------------------------------------------------------------
            | Main student information
            |--------------------------------------------------------------------------
            */

            $student->phone =
                $validated['phone'];

            $student->gender =
                $validated['gender'];

            $student->dob =
                $validated['dob'];

            $student->qualification_id =
                $validated['qid'];

            $student->branch_id =
                $validated['branchid'];

            $student->collegename =
                $validated['collegename'];

            $student->cgpa =
                $validated['cgpa'];

            $student->graduation_year =
                $validated['graduation_year'];

            $student->interest =
                $validated['interest'];

            $student->carrergoal =
                $validated['carrergoal'];


            /*
            |--------------------------------------------------------------------------
            | Profile photo
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('photo')) {

                $photo =
                    $request->file('photo');

                $uploadPath =
                    public_path('uploads/students');


                /*
                 * Create directory if it doesn't exist.
                 */

                if (!file_exists($uploadPath)) {

                    mkdir(
                        $uploadPath,
                        0755,
                        true
                    );

                }


                /*
                 * Generate unique filename.
                 */

                $filename =
                    time() . '_' .
                    uniqid() . '.' .
                    $photo->getClientOriginalExtension();


                /*
                 * Move uploaded image.
                 */

                $photo->move(
                    $uploadPath,
                    $filename
                );


                /*
                 * Store relative path in database.
                 */

                $student->photo =
                    'uploads/students/' . $filename;
            }


            /*
            |--------------------------------------------------------------------------
            | Save student
            |--------------------------------------------------------------------------
            */

            $student->save();


            /*
            |--------------------------------------------------------------------------
            | Delete old child records
            |--------------------------------------------------------------------------
            |
            | We are using the simple and reliable approach:
            |
            | Delete existing child records
            | ↓
            | Insert currently submitted records
            |
            */

            $student->skills()->delete();

            $student->projects()->delete();

            $student->certifications()->delete();

            $student->languages()->delete();

            $student->educations()->delete();


            /*
            |--------------------------------------------------------------------------
            | Save Skills
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['skills'])) {

                foreach ($validated['skills'] as $skill) {

                    /*
                     * Ignore completely empty rows.
                     */

                    if (
                        empty(
                        trim(
                            $skill['skill_name'] ?? ''
                        )
                    )
                    ) {
                        continue;
                    }


                    $student->skills()->create([

                        'skill_name' =>
                            trim(
                                $skill['skill_name']
                            ),

                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Save Projects
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['projects'])) {

                foreach ($validated['projects'] as $project) {

                    /*
                     * Ignore completely empty project rows.
                     */

                    if (
                        empty(
                        trim(
                            $project['project_title'] ?? ''
                        )
                    ) &&
                        empty(
                        trim(
                            $project['description'] ?? ''
                        )
                    )
                    ) {
                        continue;
                    }


                    $student->projects()->create([

                        'project_title' =>
                            trim(
                                $project['project_title'] ?? ''
                            ),

                        'description' =>
                            trim(
                                $project['description'] ?? ''
                            ),

                        'technologies' =>
                            trim(
                                $project['technologies'] ?? ''
                            ),

                        'project_url' =>
                            $project['project_url'] ?? null,

                        'start_date' =>
                            $project['start_date'] ?? null,

                        'end_date' =>
                            $project['end_date'] ?? null,

                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Save Certifications
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['certifications'])) {

                foreach (
                    $validated['certifications']
                    as $certification
                ) {

                    /*
                     * Ignore completely empty rows.
                     */

                    if (
                        empty(
                        trim(
                            $certification['certification_name'] ?? ''
                        )
                    )
                    ) {
                        continue;
                    }


                    $student->certifications()->create([

                        'certification_name' =>
                            trim(
                                $certification['certification_name']
                            ),

                        'issuing_organization' =>
                            trim(
                                $certification['issuing_organization'] ?? ''
                            ),

                        'issue_date' =>
                            $certification['issue_date'] ?? null,

                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Save Languages
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['languages'])) {

                foreach ($validated['languages'] as $language) {

                    /*
                     * Ignore completely empty rows.
                     */

                    if (
                        empty(
                        trim(
                            $language['language_name'] ?? ''
                        )
                    )
                    ) {
                        continue;
                    }


                    $student->languages()->create([

                        'language_name' =>
                            trim(
                                $language['language_name']
                            ),

                        'proficiency' =>
                            $language['proficiency'] ?? '',

                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Save Education History
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['educations'])) {

                foreach ($validated['educations'] as $education) {

                    /*
                     * Ignore completely empty rows.
                     */

                    if (
                        empty(
                        trim(
                            $education['qualification_name'] ?? ''
                        )
                    ) &&
                        empty(
                        trim(
                            $education['institution_name'] ?? ''
                        )
                    )
                    ) {
                        continue;
                    }


                    $student->educations()->create([

                        'qualification_name' =>
                            trim(
                                $education['qualification_name'] ?? ''
                            ),

                        'branch_name' =>
                            !empty($education['branch_name'])
                            ? trim($education['branch_name'])
                            : null,

                        'institution_name' =>
                            trim(
                                $education['institution_name'] ?? ''
                            ),

                        'start_year' =>
                            $education['start_year'] ?? null,

                        'end_year' =>
                            $education['end_year'] ?? null,

                        'cgpa' =>
                            $education['cgpa'] ?? null,

                    ]);
                }
            }

        });


        /*
        |--------------------------------------------------------------------------
        | 4. Redirect after successful save
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('student.profile')
            ->with(
                'success',
                'Profile updated successfully.'
            );
    }
}