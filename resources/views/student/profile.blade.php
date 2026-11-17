<style>
    /* =========================================================
       CAREER MENTOR — PROFILE PAGE
       (design tokens matched to the CareerMentor homepage)
    ========================================================= */

    .cm-page {
        font-family: 'Poppins', sans-serif;
        background: #f8fafc;
        color: #0f172a;
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        overflow-x: hidden;
    }

    .cm-page .container {
        width: 100%;
        max-width: 1140px;
        margin-left: auto;
        margin-right: auto;
        padding-left: 20px;
        padding-right: 20px;
        box-sizing: border-box;
    }


    /* =========================================================
       NAVBAR (redesigned, same content as before)
    ========================================================= */

    .cm-navbar {
        position: relative;
        z-index: 2;
        padding: 22px 0;
    }

    .cm-navbar-inner {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        gap: 20px;
    }

    .cm-navbar-logo {
        justify-self: start;
    }

    .cm-navbar-links {
        justify-self: center;
    }

    .cm-navbar-inner > form {
        justify-self: end;
    }

    .cm-navbar-logo a {
        display: inline-block;
        color: #ffffff;
        font-size: 25px;
        font-weight: 700;
        text-decoration: none !important;
    }

    .cm-navbar-logo .cm-highlight {
        color: #22c55e;
    }

    .cm-navbar-links {
        display: flex;
        align-items: center;
        gap: 34px;
    }

    .cm-navbar-links a {
        color: #dbe4ee;
        font-size: 16px;
        font-weight: 500;
        text-decoration: none !important;
        transition: color .15s ease;
    }

    .cm-navbar-links a:hover,
    .cm-navbar-links a.is-active {
        color: #4ade80;
    }

    .cm-navbar-logout {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        border: 1px solid rgba(255, 255, 255, .45);
        border-radius: 7px;
        background: rgba(255, 255, 255, .06);
        color: #ffffff;
        font-size: 14.5px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: .2s ease;
    }

    .cm-navbar-logout:hover {
        background: rgba(255, 255, 255, .14);
        color: #ffffff;
    }

    @media (max-width: 576px) {

        .cm-navbar-inner {
            grid-template-columns: 1fr;
            justify-items: center;
            text-align: center;
            gap: 14px;
        }

        .cm-navbar-logo,
        .cm-navbar-links,
        .cm-navbar-inner > form {
            justify-self: center;
        }

        .cm-navbar-links {
            gap: 18px;
        }
    }


    /* =========================================================
       PROFILE PAGE HEADER (dark banner — nav only)
    ========================================================= */

    .cm-profile-topbar {
        position: relative;
        overflow: hidden;
        padding: 0;
        background: linear-gradient(135deg, #0f172a, #1e293b);
    }

    .cm-profile-topbar::after {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        right: -90px;
        top: -110px;
        border-radius: 50%;
        background: rgba(34, 197, 94, .10);
    }


    /* =========================================================
       PAGE TITLE BLOCK (on light background, below the banner)
    ========================================================= */

    .cm-profile-title-block {
        padding: 42px 0 0;
        display: flex;
        justify-content: center;
        text-align: center;
    }

    .cm-profile-title-block > div {
        max-width: 640px;
        margin: 0 auto;
    }

    .cm-profile-label {
        display: inline-block;
        margin-bottom: 10px;
        color: #16a34a;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .cm-profile-title-block h1 {
        margin: 0 0 8px;
        color: #0f172a;
        font-size: 30px;
        font-weight: 700;
    }

    .cm-profile-title-block p {
        margin: 0 auto;
        color: #64748b;
        font-size: 13.5px;
        line-height: 1.7;
    }


    /* =========================================================
       CONTENT WRAPPER (card pulled up over the banner)
    ========================================================= */

    .cm-profile-body {
        padding: 0 0 80px;
    }

    .cm-profile-card {
        margin-top: 35px;
        padding: 34px 34px 8px;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 8px 30px rgba(15, 23, 42, .08);
    }


    /* =========================================================
       ALERTS
    ========================================================= */

    .cm-alert-success {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 22px;
        font-size: 13.5px;
        font-weight: 500;
    }

    .cm-alert-error {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
        padding: 16px 20px;
        border-radius: 10px;
        margin-bottom: 22px;
    }

    .cm-alert-error strong {
        display: block;
        color: #c2410c;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .cm-alert-error ul {
        margin: 0;
        padding-left: 18px;
        font-size: 13px;
    }


    /* =========================================================
       PHOTO UPLOAD BLOCK
    ========================================================= */

    .cm-photo-block {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 18px 20px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 13px;
        margin-bottom: 30px;
    }

    .cm-photo-preview {
        width: 82px;
        height: 82px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ffffff;
        box-shadow: 0 4px 14px rgba(15, 23, 42, .12);
        background: #ffffff;
        flex-shrink: 0;
    }

    .cm-photo-block label.cm-photo-title {
        display: block;
        font-weight: 600;
        font-size: 13.5px;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .cm-photo-help {
        display: block;
        font-size: 12px;
        color: #64748b;
        margin-top: 6px;
    }


    /* =========================================================
       SECTION HEADINGS
    ========================================================= */

    .cm-profile-section {
        margin-top: 34px;
        padding-top: 6px;
    }

    .cm-section-label {
        display: inline-block;
        margin-bottom: 6px;
        color: #16a34a;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .cm-profile-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 19px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e2e8f0;
    }


    /* =========================================================
       FORM FIELDS
    ========================================================= */

    .form-row {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .form-row .form-group {
        flex: 1;
        min-width: 220px;
        margin-bottom: 0;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 7px;
    }

    .student-input,
    .student-select,
    textarea.student-input {
        width: 100%;
        padding: 11px 14px;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        transition: .15s ease;
    }

    .student-input[readonly],
    .student-select:disabled,
    .student-file-input:disabled {
        background-color: #f1f5f9 !important;
        color: #334155 !important;
        border: 1px solid #e2e8f0 !important;
        cursor: not-allowed !important;
        opacity: 1 !important;
        -webkit-text-fill-color: #334155;
    }

    .student-input:not([readonly]),
    .student-select:not(:disabled) {
        background-color: #ffffff !important;
        color: #0f172a !important;
        border: 1px solid #16a34a !important;
        cursor: text !important;
        box-shadow: 0 0 0 3px rgba(22, 163, 74, .12);
    }

    .student-select:not(:disabled) {
        cursor: pointer !important;
    }


    /* =========================================================
       REPEATED ITEM CARDS
    ========================================================= */

    .profile-repeat-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
    }

    .profile-repeat-title {
        font-size: 14px;
        font-weight: 700;
        color: #16a34a;
        letter-spacing: .3px;
        margin-bottom: 16px;
    }

    .empty-item-message {
        color: #64748b;
        font-size: 13px;
        margin-bottom: 10px;
    }


    /* =========================================================
       ADD / REMOVE BUTTONS
    ========================================================= */

    .add-item-btn {
        margin-top: 4px;
        margin-bottom: 6px;
        padding: 11px 18px;
        border: 1px dashed #16a34a;
        background: #f0fdf4;
        color: #16a34a;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        transition: .15s ease;
    }

    .add-item-btn:hover {
        background: #dcfce7;
    }

    .remove-item-btn {
        border: 1px solid #ef4444;
        background: #ffffff;
        color: #ef4444;
        border-radius: 7px;
        padding: 7px 14px;
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 4px;
        font-family: 'Poppins', sans-serif;
        transition: .15s ease;
    }

    .remove-item-btn:hover {
        background: #fef2f2;
    }


    /* =========================================================
       ACTION BUTTONS
    ========================================================= */

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 36px;
        padding-top: 26px;
        padding-bottom: 30px;
        border-top: 1px solid #e2e8f0;
    }

    .btn-edit-toggle {
        flex: 1;
        padding: 14px 20px;
        font-size: 14.5px;
        font-weight: 600;
        border-radius: 8px;
        border: 1px solid #16a34a;
        background-color: #16a34a;
        color: #ffffff;
        cursor: pointer;
        transition: .2s ease;
        font-family: 'Poppins', sans-serif;
        text-align: center;
    }

    .btn-edit-toggle:hover {
        background-color: #15803d;
        border-color: #15803d;
    }

    .btn-edit-toggle.cancel-mode {
        background-color: #ffffff !important;
        border-color: #ef4444 !important;
        color: #ef4444 !important;
    }

    .btn-edit-toggle.cancel-mode:hover {
        background-color: #fef2f2 !important;
    }

    .btn-save-toggle {
        flex: 1;
        padding: 14px 20px;
        font-size: 14.5px;
        font-weight: 600;
        border-radius: 8px;
        border: 1px solid #2563eb;
        background-color: #2563eb;
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
        transition: .2s ease;
        box-shadow: 0 4px 14px rgba(37, 99, 235, .25);
    }

    .btn-save-toggle:not(:disabled):hover {
        background-color: #1d4ed8;
        border-color: #1d4ed8;
    }

    .btn-save-toggle:disabled {
        opacity: .5;
        cursor: not-allowed;
        background-color: #94a3b8;
        border-color: #94a3b8;
        box-shadow: none;
        pointer-events: none;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .form-actions {
            flex-direction: column;
        }

        .cm-photo-block {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .cm-profile-card {
            margin-top: 22px;
            padding: 24px 20px 6px;
        }

        .cm-profile-title-block {
            padding: 28px 0 0;
        }

        .cm-profile-title-block h1 {
            font-size: 24px;
        }
    }
</style>


<div class="cm-page">


    <!-- =====================================================
         PAGE HEADER (dark, nav only)
    ====================================================== -->

    <section class="cm-profile-topbar">

        <div class="container">

            <header class="cm-navbar">

                <div class="cm-navbar-inner">

                    <div class="cm-navbar-logo">

                        <a href="{{ route('studenthome') }}">
                            Career<span class="cm-highlight">Mentor</span>
                        </a>

                    </div>


                    <nav class="cm-navbar-links">

                        <a href="{{ route('studenthome') }}">
                            Home
                        </a>

                        <a href="{{ route('student.profile') }}" class="is-active">
                            Profile
                        </a>

                    </nav>


                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button type="submit" class="cm-navbar-logout">
                            Logout
                        </button>

                    </form>

                </div>

            </header>

        </div>

    </section>


    <!-- =====================================================
         PAGE TITLE (light background)
    ====================================================== -->

    <section class="cm-profile-title-block">

        <div class="container">

            <div>

                <span class="cm-profile-label">
                    YOUR CAREER PROFILE
                </span>

                <h1>
                    Complete Your Student Profile
                </h1>

                <p>
                    Keep your academic records and career choices
                    up to date so CareerMentor can give you accurate,
                    personalized AI guidance.
                </p>

            </div>

        </div>

    </section>


    <!-- =====================================================
         FORM CARD
    ====================================================== -->

    <section class="cm-profile-body">

        <div class="container" style="max-width: 900px;">

            <div class="cm-profile-card">


                <!-- =============================================
                     SUCCESS MESSAGE
                ============================================== -->

                @if (session('success'))

                    <div class="cm-alert-success">
                        {{ session('success') }}
                    </div>

                @endif


                <!-- =============================================
                     ERRORS
                ============================================== -->

                @if ($errors->any())

                    <div class="cm-alert-error">

                        <strong>Please fix the following:</strong>

                        <ul>

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <!-- =============================================
                     FORM
                ============================================== -->

                <form
                    method="POST"
                    action="{{ route('student.profile.update') }}"
                    class="auth-form"
                    id="profileForm"
                    enctype="multipart/form-data"
                >

                    @csrf


                    <!-- =========================================
                         PROFILE PHOTO
                    ========================================== -->

                    <div class="cm-photo-block">

                        <div style="position: relative; flex-shrink: 0;">

                            @php
                                if (
                                    !empty($student?->photo) &&
                                    file_exists(public_path($student->photo))
                                ) {
                                    $photoUrl = asset($student->photo);
                                } else {
                                    $photoUrl =
                                        'https://ui-avatars.com/api/?name=' .
                                        urlencode($user->name ?? 'Student') .
                                        '&size=120&background=16a34a&color=fff';
                                }
                            @endphp

                            <img
                                id="photoPreview"
                                src="{{ $photoUrl }}"
                                alt="Profile Photo"
                                class="cm-photo-preview"
                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'Student') }}&size=120&background=16a34a&color=fff';"
                            >

                        </div>


                        <div style="flex: 1;">

                            <label for="photoInput" class="cm-photo-title">
                                Profile Photo
                            </label>


                            <input
                                type="file"
                                id="photoInput"
                                name="photo"
                                accept="image/png, image/jpeg, image/jpg, image/webp"
                                class="student-file-input"
                                disabled
                                style="font-size: 13px; color: #475569; width: 100%;"
                            >


                            <small id="photoHelpText" class="cm-photo-help">
                                🔒 Read-only. Click "Edit Details" to change photo
                                (JPG, PNG, max 2MB).
                            </small>

                        </div>

                    </div>


                    <!-- =========================================
                         PERSONAL INFORMATION
                    ========================================== -->

                    <div class="cm-profile-section">

                        

                        <div class="cm-profile-section-title">
                            👤 Personal Information
                        </div>


                        <div class="form-row">

                            <div class="form-group">

                                <label>Name</label>

                                <input
                                    type="text"
                                    value="{{ $user->name ?? '' }}"
                                    readonly
                                    class="student-input"
                                >

                            </div>


                            <div class="form-group">

                                <label>Email Address</label>

                                <input
                                    type="email"
                                    value="{{ $user->email ?? '' }}"
                                    readonly
                                    class="student-input"
                                >

                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group">

                                <label>Username</label>

                                <input
                                    type="text"
                                    value="{{ $user->username ?? '' }}"
                                    readonly
                                    class="student-input"
                                >

                            </div>


                            <div class="form-group">

                                <label>Password</label>

                                <input
                                    type="password"
                                    value="********"
                                    disabled
                                    class="student-input"
                                >

                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group">

                                <label for="phone">
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    class="student-input"
                                    value="{{ old('phone', $student->phone ?? '') }}"
                                    placeholder="Enter phone number"
                                    readonly
                                >

                            </div>


                            <div class="form-group">

                                <label for="gender">
                                    Gender
                                </label>

                                <select
                                    id="gender"
                                    name="gender"
                                    class="student-select"
                                    required
                                    disabled
                                >

                                    <option value="">
                                        Select Gender
                                    </option>

                                    <option
                                        value="Male"
                                        {{ old('gender', $student->gender ?? '') == 'Male' ? 'selected' : '' }}
                                    >
                                        Male
                                    </option>

                                    <option
                                        value="Female"
                                        {{ old('gender', $student->gender ?? '') == 'Female' ? 'selected' : '' }}
                                    >
                                        Female
                                    </option>

                                    <option
                                        value="Other"
                                        {{ old('gender', $student->gender ?? '') == 'Other' ? 'selected' : '' }}
                                    >
                                        Other
                                    </option>

                                </select>

                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group">

                                <label for="dob">
                                    Date of Birth
                                </label>

                                <input
                                    type="date"
                                    id="dob"
                                    name="dob"
                                    class="student-input"
                                    value="{{ old('dob', $student->dob ?? '') }}"
                                    readonly
                                >

                            </div>


                            <div class="form-group">

                                <label for="collegename">
                                    College Name
                                </label>

                                <input
                                    type="text"
                                    id="collegename"
                                    name="collegename"
                                    class="student-input"
                                    value="{{ old('collegename', $student->collegename ?? '') }}"
                                    placeholder="Enter college name"
                                    readonly
                                >

                            </div>

                        </div>

                    </div>


                    <!-- =========================================
                         ACADEMIC INFORMATION
                    ========================================== -->

                    <div class="cm-profile-section">

                        

                        <div class="cm-profile-section-title">
                            🎓 Academic Information
                        </div>


                        <div class="form-row">

                            <div class="form-group">

                                <label for="qid">
                                    Qualification
                                </label>

                                <select
                                    id="qid"
                                    name="qid"
                                    class="student-select"
                                    required
                                    disabled
                                >

                                    <option value="">
                                        Select Qualification
                                    </option>

                                    @foreach ($qualifications as $qualification)

                                        <option
                                            value="{{ $qualification->qualification_id }}"
                                            {{ old('qid', $student->qualification_id ?? '') == $qualification->qualification_id ? 'selected' : '' }}
                                        >
                                            {{ $qualification->qualification_name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <div class="form-group">

                                <label for="branchid">
                                    Branch / Specialization
                                </label>

                                <select
                                    id="branchid"
                                    name="branchid"
                                    class="student-select"
                                    required
                                    disabled
                                >
                                    <option value="">
                                        Select Branch
                                    </option>
                                    @foreach ($branches as $branch)
                                        <option
                                            value="{{ $branch->branch_id }}"
                                            data-qid="{{ $branch->qualification_id }}"
                                            {{ old('branchid', $student->branch_id ?? '') == $branch->branch_id ? 'selected' : '' }}
                                        >
                                            {{ $branch->branch_name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group">

                                <label for="cgpa">
                                    CGPA / Percentage
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    id="cgpa"
                                    name="cgpa"
                                    class="student-input"
                                    value="{{ old('cgpa', $student->cgpa ?? '') }}"
                                    placeholder="e.g. 8.50"
                                    required
                                    readonly
                                >

                            </div>


                            <div class="form-group">

                                <label for="graduation_year">
                                    Graduation Year
                                </label>

                                <input
                                    type="number"
                                    id="graduation_year"
                                    name="graduation_year"
                                    class="student-input"
                                    value="{{ old('graduation_year', $student->graduation_year ?? '') }}"
                                    placeholder="e.g. 2026"
                                    required
                                    readonly
                                >

                            </div>

                        </div>

                    </div>


                    <!-- =========================================
                         CAREER INFORMATION
                    ========================================== -->

                    <div class="cm-profile-section">

                        

                        <div class="cm-profile-section-title">
                            🎯 Career Information
                        </div>


                        <div class="form-group">

                            <label for="interest">
                                Areas of Interest
                            </label>

                            <input
                                type="text"
                                id="interest"
                                name="interest"
                                class="student-input"
                                value="{{ old('interest', $student->interest ?? '') }}"
                                placeholder="e.g. AI, Web Development, Data Science"
                                required
                                readonly
                            >

                        </div>


                        <div class="form-group" style="margin-top: 15px;">

                            <label for="carrergoal">
                                Career Goal
                            </label>

                            <textarea
                                id="carrergoal"
                                name="carrergoal"
                                class="student-input"
                                rows="3"
                                placeholder="What are your long-term career or higher study goals?"
                                required
                                readonly
                            >{{ old('carrergoal', $student->carrergoal ?? '') }}</textarea>

                        </div>

                    </div>


                    <!-- =========================================
                         SKILLS
                    ========================================== -->

                    <div class="cm-profile-section">

                        

                        <div class="cm-profile-section-title">
                            💻 Skills
                        </div>

                        <div id="skillsContainer">

                            @forelse ($student?->skills ?? [] as $index => $skill)

                                <div class="profile-repeat-card skill-item">

                                    <div class="form-group">

                                        <label>
                                            Skill
                                        </label>

                                        <input
                                            type="text"
                                            name="skills[{{ $index }}][skill_name]"
                                            class="student-input"
                                            value="{{ old(
                                                'skills.' . $index . '.skill_name',
                                                $skill->skill_name
                                            ) }}"
                                            placeholder="e.g. Python"
                                            readonly
                                        >

                                    </div>

                                    <button
                                        type="button"
                                        class="remove-item-btn"
                                        onclick="removeItem(this)"
                                    >
                                        Remove
                                    </button>

                                </div>

                            @empty

                                <div class="profile-repeat-card skill-item">

                                    <div class="form-group">

                                        <label>
                                            Skill
                                        </label>

                                        <input
                                            type="text"
                                            name="skills[0][skill_name]"
                                            class="student-input"
                                            value="{{ old('skills.0.skill_name') }}"
                                            placeholder="e.g. Python"
                                            readonly
                                        >

                                    </div>

                                    <button
                                        type="button"
                                        class="remove-item-btn"
                                        onclick="removeItem(this)"
                                    >
                                        Remove
                                    </button>

                                </div>

                            @endforelse

                        </div>


                        <button
                            type="button"
                            class="add-item-btn"
                            id="addSkillBtn"
                        >
                            + Add Skill
                        </button>

                    </div>


                    <!-- =========================================
                         PROJECTS
                    ========================================== -->

                    <div class="cm-profile-section">

                        

                        <div class="cm-profile-section-title">
                            🚀 Projects
                        </div>


                        <div id="projectsContainer">

                            @forelse ($student?->projects ?? [] as $index => $project)

                                <div class="profile-repeat-card project-item">

                                    <div class="profile-repeat-title">
                                        Project
                                    </div>


                                    <div class="form-group">

                                        <label>
                                            Project Title
                                        </label>

                                        <input
                                            type="text"
                                            name="projects[{{ $index }}][project_title]"
                                            class="student-input"
                                            value="{{ old(
                                                'projects.' . $index . '.project_title',
                                                $project->project_title
                                            ) }}"
                                            placeholder="Enter project title"
                                            readonly
                                        >

                                    </div>


                                    <div class="form-group" style="margin-top: 12px;">

                                        <label>
                                            Description
                                        </label>

                                        <textarea
                                            name="projects[{{ $index }}][description]"
                                            class="student-input"
                                            rows="3"
                                            placeholder="Describe the project"
                                            readonly
                                        >{{ old(
                                            'projects.' . $index . '.description',
                                            $project->description
                                        ) }}</textarea>

                                    </div>


                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Technologies
                                            </label>

                                            <input
                                                type="text"
                                                name="projects[{{ $index }}][technologies]"
                                                class="student-input"
                                                value="{{ old(
                                                    'projects.' . $index . '.technologies',
                                                    $project->technologies
                                                ) }}"
                                                placeholder="e.g. Laravel, MySQL"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                Project URL
                                            </label>

                                            <input
                                                type="url"
                                                name="projects[{{ $index }}][project_url]"
                                                class="student-input"
                                                value="{{ old(
                                                    'projects.' . $index . '.project_url',
                                                    $project->project_url
                                                ) }}"
                                                placeholder="https://..."
                                                readonly
                                            >

                                        </div>

                                    </div>


                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Start Date
                                            </label>

                                            <input
                                                type="date"
                                                name="projects[{{ $index }}][start_date]"
                                                class="student-input"
                                                value="{{ old(
                                                    'projects.' . $index . '.start_date',
                                                    $project->start_date
                                                ) }}"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                End Date
                                            </label>

                                            <input
                                                type="date"
                                                name="projects[{{ $index }}][end_date]"
                                                class="student-input"
                                                value="{{ old(
                                                    'projects.' . $index . '.end_date',
                                                    $project->end_date
                                                ) }}"
                                                readonly
                                            >

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        class="remove-item-btn"
                                        onclick="removeItem(this)"
                                    >
                                        Remove Project
                                    </button>

                                </div>

                            @empty

                                <div class="profile-repeat-card project-item">

                                    <div class="profile-repeat-title">
                                        Project
                                    </div>


                                    <div class="form-group">

                                        <label>
                                            Project Title
                                        </label>

                                        <input
                                            type="text"
                                            name="projects[0][project_title]"
                                            class="student-input"
                                            placeholder="Enter project title"
                                            readonly
                                        >

                                    </div>


                                    <div class="form-group" style="margin-top: 12px;">

                                        <label>
                                            Description
                                        </label>

                                        <textarea
                                            name="projects[0][description]"
                                            class="student-input"
                                            rows="3"
                                            placeholder="Describe the project"
                                            readonly
                                        ></textarea>

                                    </div>


                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Technologies
                                            </label>

                                            <input
                                                type="text"
                                                name="projects[0][technologies]"
                                                class="student-input"
                                                placeholder="e.g. Laravel, MySQL"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                Project URL
                                            </label>

                                            <input
                                                type="url"
                                                name="projects[0][project_url]"
                                                class="student-input"
                                                placeholder="https://..."
                                                readonly
                                            >

                                        </div>

                                    </div>


                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Start Date
                                            </label>

                                            <input
                                                type="date"
                                                name="projects[0][start_date]"
                                                class="student-input"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                End Date
                                            </label>

                                            <input
                                                type="date"
                                                name="projects[0][end_date]"
                                                class="student-input"
                                                readonly
                                            >

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        class="remove-item-btn"
                                        onclick="removeItem(this)"
                                    >
                                        Remove Project
                                    </button>

                                </div>

                            @endforelse

                        </div>


                        <button
                            type="button"
                            class="add-item-btn"
                            id="addProjectBtn"
                        >
                            + Add Project
                        </button>

                    </div>


                    <!-- =========================================
                         CERTIFICATIONS
                    ========================================== -->

                    <div class="cm-profile-section">

                        

                        <div class="cm-profile-section-title">
                            📜 Certifications
                        </div>


                        <div id="certificationsContainer">

                            @forelse ($student?->certifications ?? [] as $index => $certification)

                                <div class="profile-repeat-card certification-item">

                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Certification Name
                                            </label>

                                            <input
                                                type="text"
                                                name="certifications[{{ $index }}][certification_name]"
                                                class="student-input"
                                                value="{{ old(
                                                    'certifications.' . $index . '.certification_name',
                                                    $certification->certification_name
                                                ) }}"
                                                placeholder="e.g. AWS Cloud Practitioner"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                Issuing Organization
                                            </label>

                                            <input
                                                type="text"
                                                name="certifications[{{ $index }}][issuing_organization]"
                                                class="student-input"
                                                value="{{ old(
                                                    'certifications.' . $index . '.issuing_organization',
                                                    $certification->issuing_organization
                                                ) }}"
                                                placeholder="e.g. Amazon Web Services"
                                                readonly
                                            >

                                        </div>

                                    </div>


                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Issue Date
                                            </label>

                                            <input
                                                type="date"
                                                name="certifications[{{ $index }}][issue_date]"
                                                class="student-input"
                                                value="{{ old(
                                                    'certifications.' . $index . '.issue_date',
                                                    $certification->issue_date
                                                ) }}"
                                                readonly
                                            >

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        class="remove-item-btn"
                                        onclick="removeItem(this)"
                                    >
                                        Remove Certification
                                    </button>

                                </div>

                            @empty

                                <div class="profile-repeat-card certification-item">

                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Certification Name
                                            </label>

                                            <input
                                                type="text"
                                                name="certifications[0][certification_name]"
                                                class="student-input"
                                                placeholder="e.g. AWS Cloud Practitioner"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                Issuing Organization
                                            </label>

                                            <input
                                                type="text"
                                                name="certifications[0][issuing_organization]"
                                                class="student-input"
                                                placeholder="e.g. Amazon Web Services"
                                                readonly
                                            >

                                        </div>

                                    </div>


                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Issue Date
                                            </label>

                                            <input
                                                type="date"
                                                name="certifications[0][issue_date]"
                                                class="student-input"
                                                readonly
                                            >

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        class="remove-item-btn"
                                        onclick="removeItem(this)"
                                    >
                                        Remove Certification
                                    </button>

                                </div>

                            @endforelse

                        </div>


                        <button
                            type="button"
                            class="add-item-btn"
                            id="addCertificationBtn"
                        >
                            + Add Certification
                        </button>

                    </div>


                    <!-- =========================================
                         LANGUAGES
                    ========================================== -->

                    <div class="cm-profile-section">

                        

                        <div class="cm-profile-section-title">
                            🌐 Languages
                        </div>


                        <div id="languagesContainer">

                            @forelse ($student?->languages ?? [] as $index => $language)

                                <div class="profile-repeat-card language-item">

                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Language
                                            </label>

                                            <input
                                                type="text"
                                                name="languages[{{ $index }}][language_name]"
                                                class="student-input"
                                                value="{{ old(
                                                    'languages.' . $index . '.language_name',
                                                    $language->language_name
                                                ) }}"
                                                placeholder="e.g. English"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                Proficiency
                                            </label>

                                            <select
                                                name="languages[{{ $index }}][proficiency]"
                                                class="student-select"
                                                disabled
                                            >

                                                <option value="">
                                                    Select Proficiency
                                                </option>

                                                <option
                                                    value="Basic"
                                                    {{ old(
                                                        'languages.' . $index . '.proficiency',
                                                        $language->proficiency
                                                    ) == 'Basic' ? 'selected' : '' }}
                                                >
                                                    Basic
                                                </option>

                                                <option
                                                    value="Intermediate"
                                                    {{ old(
                                                        'languages.' . $index . '.proficiency',
                                                        $language->proficiency
                                                    ) == 'Intermediate' ? 'selected' : '' }}
                                                >
                                                    Intermediate
                                                </option>

                                                <option
                                                    value="Fluent"
                                                    {{ old(
                                                        'languages.' . $index . '.proficiency',
                                                        $language->proficiency
                                                    ) == 'Fluent' ? 'selected' : '' }}
                                                >
                                                    Fluent
                                                </option>

                                                <option
                                                    value="Native"
                                                    {{ old(
                                                        'languages.' . $index . '.proficiency',
                                                        $language->proficiency
                                                    ) == 'Native' ? 'selected' : '' }}
                                                >
                                                    Native
                                                </option>

                                            </select>

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        class="remove-item-btn"
                                        onclick="removeItem(this)"
                                    >
                                        Remove Language
                                    </button>

                                </div>

                            @empty

                                <div class="profile-repeat-card language-item">

                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Language
                                            </label>

                                            <input
                                                type="text"
                                                name="languages[0][language_name]"
                                                class="student-input"
                                                placeholder="e.g. English"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                Proficiency
                                            </label>

                                            <select
                                                name="languages[0][proficiency]"
                                                class="student-select"
                                                disabled
                                            >

                                                <option value="">
                                                    Select Proficiency
                                                </option>

                                                <option value="Basic">
                                                    Basic
                                                </option>

                                                <option value="Intermediate">
                                                    Intermediate
                                                </option>

                                                <option value="Fluent">
                                                    Fluent
                                                </option>

                                                <option value="Native">
                                                    Native
                                                </option>

                                            </select>

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        class="remove-item-btn"
                                        onclick="removeItem(this)"
                                    >
                                        Remove Language
                                    </button>

                                </div>

                            @endforelse

                        </div>


                        <button
                            type="button"
                            class="add-item-btn"
                            id="addLanguageBtn"
                        >
                            + Add Language
                        </button>

                    </div>


                    <!-- =========================================
                         EDUCATION HISTORY
                    ========================================== -->

                    <div class="cm-profile-section">

                        

                        <div class="cm-profile-section-title">
                            🎓 Education History
                        </div>


                        <div id="educationsContainer">

                            @forelse ($student?->educations ?? [] as $index => $education)

                                <div class="profile-repeat-card education-item">

                                    <div class="profile-repeat-title">
                                        Education
                                    </div>


                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Qualification
                                            </label>

                                            <input
                                                type="text"
                                                name="educations[{{ $index }}][qualification_name]"
                                                class="student-input"
                                                value="{{ old(
                                                    'educations.' . $index . '.qualification_name',
                                                    $education->qualification_name
                                                ) }}"
                                                placeholder="e.g. BCA"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                Branch / Specialization
                                            </label>

                                            <input
                                                type="text"
                                                name="educations[{{ $index }}][branch_name]"
                                                class="student-input"
                                                value="{{ old(
                                                    'educations.' . $index . '.branch_name',
                                                    $education->branch_name
                                                ) }}"
                                                placeholder="e.g. Computer Applications"
                                                readonly
                                            >

                                        </div>

                                    </div>


                                    <div class="form-group">

                                        <label>
                                            Institution
                                        </label>

                                        <input
                                            type="text"
                                            name="educations[{{ $index }}][institution_name]"
                                            class="student-input"
                                            value="{{ old(
                                                'educations.' . $index . '.institution_name',
                                                $education->institution_name
                                            ) }}"
                                            placeholder="Enter institution name"
                                            readonly
                                        >

                                    </div>


                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Start Year
                                            </label>

                                            <input
                                                type="number"
                                                name="educations[{{ $index }}][start_year]"
                                                class="student-input"
                                                value="{{ old(
                                                    'educations.' . $index . '.start_year',
                                                    $education->start_year
                                                ) }}"
                                                placeholder="e.g. 2022"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                End Year
                                            </label>

                                            <input
                                                type="number"
                                                name="educations[{{ $index }}][end_year]"
                                                class="student-input"
                                                value="{{ old(
                                                    'educations.' . $index . '.end_year',
                                                    $education->end_year
                                                ) }}"
                                                placeholder="e.g. 2025"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                CGPA
                                            </label>

                                            <input
                                                type="number"
                                                step="0.01"
                                                name="educations[{{ $index }}][cgpa]"
                                                class="student-input"
                                                value="{{ old(
                                                    'educations.' . $index . '.cgpa',
                                                    $education->cgpa
                                                ) }}"
                                                placeholder="e.g. 8.50"
                                                readonly
                                            >

                                        </div>

                                    </div>


                                    


                                    <button
                                        type="button"
                                        class="remove-item-btn"
                                        onclick="removeItem(this)"
                                    >
                                        Remove Education
                                    </button>

                                </div>

                            @empty

                                <div class="profile-repeat-card education-item">

                                    <div class="profile-repeat-title">
                                        Education
                                    </div>


                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Qualification
                                            </label>

                                            <input
                                                type="text"
                                                name="educations[0][qualification_name]"
                                                class="student-input"
                                                placeholder="e.g. BCA"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                Branch / Specialization
                                            </label>

                                            <input
                                                type="text"
                                                name="educations[0][branch_name]"
                                                class="student-input"
                                                placeholder="e.g. Computer Applications"
                                                readonly
                                            >

                                        </div>

                                    </div>


                                    <div class="form-group">

                                        <label>
                                            Institution
                                        </label>

                                        <input
                                            type="text"
                                            name="educations[0][institution_name]"
                                            class="student-input"
                                            placeholder="Enter institution name"
                                            readonly
                                        >

                                    </div>


                                    <div class="form-row">

                                        <div class="form-group">

                                            <label>
                                                Start Year
                                            </label>

                                            <input
                                                type="number"
                                                name="educations[0][start_year]"
                                                class="student-input"
                                                placeholder="e.g. 2022"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                End Year
                                            </label>

                                            <input
                                                type="number"
                                                name="educations[0][end_year]"
                                                class="student-input"
                                                placeholder="e.g. 2025"
                                                readonly
                                            >

                                        </div>


                                        <div class="form-group">

                                            <label>
                                                CGPA
                                            </label>

                                            <input
                                                type="number"
                                                step="0.01"
                                                name="educations[0][cgpa]"
                                                class="student-input"
                                                placeholder="e.g. 8.50"
                                                readonly
                                            >

                                        </div>

                                    </div>

                                    <button
                                        type="button"
                                        class="remove-item-btn"
                                        onclick="removeItem(this)"
                                    >
                                        Remove Education
                                    </button>

                                </div>

                            @endforelse

                        </div>


                        <button
                            type="button"
                            class="add-item-btn"
                            id="addEducationBtn"
                        >
                            + Add Education
                        </button>

                    </div>


                    <!-- =========================================
                         ACTION BUTTONS
                    ========================================== -->

                    <div class="form-actions">

                        <button
                            type="button"
                            id="editBtn"
                            class="btn-edit-toggle"
                        >
                            ✏️ Edit Details
                        </button>


                        <button
                            type="submit"
                            id="saveBtn"
                            class="btn-save-toggle"
                            disabled
                        >
                            💾 Save Profile Details
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>


</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const editBtn = document.getElementById('editBtn');

    const saveBtn = document.getElementById('saveBtn');

    const profileForm = document.getElementById('profileForm');


    const photoInput =
        document.getElementById('photoInput');

    const photoPreview =
        document.getElementById('photoPreview');

    const photoHelpText =
        document.getElementById('photoHelpText');


    const originalPhotoSrc =
        photoPreview ? photoPreview.src : '';


    let isEditMode = false;


    /*
    |--------------------------------------------------------------------------
    | Maximum number of items
    |--------------------------------------------------------------------------
    */

    const MAX_SKILLS = 10;

    const MAX_PROJECTS = 5;

    const MAX_CERTIFICATIONS = 5;

    const MAX_LANGUAGES = 5;

    const MAX_EDUCATIONS = 5;


    /*
    |--------------------------------------------------------------------------
    | Get current form inputs
    |--------------------------------------------------------------------------
    */

    function refreshFormFields() {

        const inputs =
            document.querySelectorAll('.student-input');

        const selects =
            document.querySelectorAll('.student-select');


        return {
            inputs: inputs,
            selects: selects
        };
    }


    /*
    |--------------------------------------------------------------------------
    | Enable Edit Mode
    |--------------------------------------------------------------------------
    */

    function enableEditMode() {

        isEditMode = true;


        const fields = refreshFormFields();


        fields.inputs.forEach(function (input) {

            /*
             * Registration details should remain read-only.
             */

            if (
                input.id !== 'name' &&
                input.id !== 'email' &&
                input.id !== 'username'
            ) {

                input.removeAttribute('readonly');

            }

        });


        fields.selects.forEach(function (select) {

            select.removeAttribute('disabled');

        });


        saveBtn.removeAttribute('disabled');


        if (photoInput) {

            photoInput.removeAttribute('disabled');

            photoInput.style.cursor = 'pointer';

        }


        if (photoHelpText) {

            photoHelpText.textContent =
                '✏️ Choose a JPG or PNG file (Max 2MB). Preview updates instantly.';

            photoHelpText.style.color =
                '#16a34a';

        }


        editBtn.innerHTML =
            '✖ Cancel Edit';

        editBtn.classList.add(
            'cancel-mode'
        );


        const phoneInput =
            document.getElementById('phone');

        if (phoneInput) {

            phoneInput.focus();

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Disable Edit Mode
    |--------------------------------------------------------------------------
    */

    function disableEditMode() {

        isEditMode = false;


        const fields = refreshFormFields();


        fields.inputs.forEach(function (input) {

            input.setAttribute(
                'readonly',
                'readonly'
            );

        });


        fields.selects.forEach(function (select) {

            select.setAttribute(
                'disabled',
                'disabled'
            );

        });


        saveBtn.setAttribute(
            'disabled',
            'disabled'
        );


        if (photoInput) {

            photoInput.setAttribute(
                'disabled',
                'disabled'
            );

            photoInput.value = '';

            photoInput.style.cursor =
                'not-allowed';

        }


        if (photoPreview) {

            photoPreview.src =
                originalPhotoSrc;

        }


        if (photoHelpText) {

            photoHelpText.textContent =
                '🔒 Read-only. Click "Edit Details" to change photo (JPG, PNG, max 2MB).';

            photoHelpText.style.color =
                '#64748b';

        }


        editBtn.innerHTML =
            '✏️ Edit Details';

        editBtn.classList.remove(
            'cancel-mode'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Edit / Cancel
    |--------------------------------------------------------------------------
    */

    editBtn.addEventListener(
        'click',
        function () {

            if (!isEditMode) {

                enableEditMode();

            } else {

                profileForm.reset();

                disableEditMode();

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Photo Preview
    |--------------------------------------------------------------------------
    */

    if (photoInput) {

        photoInput.addEventListener(
            'change',
            function () {

                const file =
                    this.files[0];

                if (!file) {
                    return;
                }


                if (
                    file.size >
                    2 * 1024 * 1024
                ) {

                    alert(
                        'The selected image exceeds 2MB.'
                    );

                    photoInput.value = '';

                    if (photoPreview) {

                        photoPreview.src =
                            originalPhotoSrc;

                    }

                    return;

                }


                const reader =
                    new FileReader();


                reader.onload =
                    function (event) {

                        if (photoPreview) {

                            photoPreview.src =
                                event.target.result;

                        }

                    };


                reader.readAsDataURL(file);

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Add / Remove Helper
    |--------------------------------------------------------------------------
    */

    window.removeItem = function (button) {

        const card =
            button.closest(
                '.profile-repeat-card'
            );


        if (card) {

            card.remove();

        }

    };


    /*
    |--------------------------------------------------------------------------
    | Re-index fields
    |--------------------------------------------------------------------------
    */

    function reindexItems(
        container,
        itemClass,
        prefix
    ) {

        const items =
            container.querySelectorAll(
                '.' + itemClass
            );


        items.forEach(function (item, index) {

            const fields =
                item.querySelectorAll(
                    'input, textarea, select'
                );


            fields.forEach(function (field) {

                const name =
                    field.getAttribute('name');


                if (!name) {
                    return;
                }


                field.setAttribute(
                    'name',
                    name.replace(
                        new RegExp(
                            prefix + '\\[\\d+\\]'
                        ),
                        prefix + '[' + index + ']'
                    )
                );

            });

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Skills
    |--------------------------------------------------------------------------
    */

    const skillsContainer =
        document.getElementById(
            'skillsContainer'
        );


    document.getElementById(
        'addSkillBtn'
    ).addEventListener(
        'click',
        function () {

            const count =
                skillsContainer.querySelectorAll(
                    '.skill-item'
                ).length;


            if (count >= MAX_SKILLS) {

                alert(
                    'You can add a maximum of 10 skills.'
                );

                return;

            }


            const item =
                document.createElement('div');


            item.className =
                'profile-repeat-card skill-item';


            item.innerHTML = `
                <div class="form-group">

                    <label>
                        Skill
                    </label>

                    <input
                        type="text"
                        name="skills[${count}][skill_name]"
                        class="student-input"
                        placeholder="e.g. Python"
                        readonly
                    >

                </div>

                <button
                    type="button"
                    class="remove-item-btn"
                    onclick="removeItem(this)"
                >
                    Remove
                </button>
            `;


            skillsContainer.appendChild(item);


            reindexItems(
                skillsContainer,
                'skill-item',
                'skills'
            );


            if (isEditMode) {

                item.querySelector(
                    '.student-input'
                ).removeAttribute(
                    'readonly'
                );

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Projects
    |--------------------------------------------------------------------------
    */

    const projectsContainer =
        document.getElementById(
            'projectsContainer'
        );


    document.getElementById(
        'addProjectBtn'
    ).addEventListener(
        'click',
        function () {

            const count =
                projectsContainer.querySelectorAll(
                    '.project-item'
                ).length;


            if (count >= MAX_PROJECTS) {

                alert(
                    'You can add a maximum of 5 projects.'
                );

                return;

            }


            const item =
                document.createElement('div');


            item.className =
                'profile-repeat-card project-item';


            item.innerHTML = `
                <div class="profile-repeat-title">
                    Project
                </div>

                <div class="form-group">

                    <label>
                        Project Title
                    </label>

                    <input
                        type="text"
                        name="projects[${count}][project_title]"
                        class="student-input"
                        placeholder="Enter project title"
                        readonly
                    >

                </div>

                <div class="form-group" style="margin-top: 12px;">

                    <label>
                        Description
                    </label>

                    <textarea
                        name="projects[${count}][description]"
                        class="student-input"
                        rows="3"
                        placeholder="Describe the project"
                        readonly
                    ></textarea>

                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label>
                            Technologies
                        </label>

                        <input
                            type="text"
                            name="projects[${count}][technologies]"
                            class="student-input"
                            placeholder="e.g. Laravel, MySQL"
                            readonly
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            Project URL
                        </label>

                        <input
                            type="url"
                            name="projects[${count}][project_url]"
                            class="student-input"
                            placeholder="https://..."
                            readonly
                        >

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label>
                            Start Date
                        </label>

                        <input
                            type="date"
                            name="projects[${count}][start_date]"
                            class="student-input"
                            readonly
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            End Date
                        </label>

                        <input
                            type="date"
                            name="projects[${count}][end_date]"
                            class="student-input"
                            readonly
                        >

                    </div>

                </div>

                <button
                    type="button"
                    class="remove-item-btn"
                    onclick="removeItem(this)"
                >
                    Remove Project
                </button>
            `;


            projectsContainer.appendChild(item);


            reindexItems(
                projectsContainer,
                'project-item',
                'projects'
            );


            if (isEditMode) {

                item.querySelectorAll(
                    '.student-input'
                ).forEach(function (input) {

                    input.removeAttribute(
                        'readonly'
                    );

                });

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Certifications
    |--------------------------------------------------------------------------
    */

    const certificationsContainer =
        document.getElementById(
            'certificationsContainer'
        );


    document.getElementById(
        'addCertificationBtn'
    ).addEventListener(
        'click',
        function () {

            const count =
                certificationsContainer.querySelectorAll(
                    '.certification-item'
                ).length;


            if (
                count >=
                MAX_CERTIFICATIONS
            ) {

                alert(
                    'You can add a maximum of 5 certifications.'
                );

                return;

            }


            const item =
                document.createElement('div');


            item.className =
                'profile-repeat-card certification-item';


            item.innerHTML = `
                <div class="form-row">

                    <div class="form-group">

                        <label>
                            Certification Name
                        </label>

                        <input
                            type="text"
                            name="certifications[${count}][certification_name]"
                            class="student-input"
                            placeholder="e.g. AWS Cloud Practitioner"
                            readonly
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            Issuing Organization
                        </label>

                        <input
                            type="text"
                            name="certifications[${count}][issuing_organization]"
                            class="student-input"
                            placeholder="e.g. Amazon Web Services"
                            readonly
                        >

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label>
                            Issue Date
                        </label>

                        <input
                            type="date"
                            name="certifications[${count}][issue_date]"
                            class="student-input"
                            readonly
                        >

                    </div>

                </div>

                <button
                    type="button"
                    class="remove-item-btn"
                    onclick="removeItem(this)"
                >
                    Remove Certification
                </button>
            `;


            certificationsContainer.appendChild(
                item
            );


            reindexItems(
                certificationsContainer,
                'certification-item',
                'certifications'
            );


            if (isEditMode) {

                item.querySelectorAll(
                    '.student-input'
                ).forEach(function (input) {

                    input.removeAttribute(
                        'readonly'
                    );

                });

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Languages
    |--------------------------------------------------------------------------
    */

    const languagesContainer =
        document.getElementById(
            'languagesContainer'
        );


    document.getElementById(
        'addLanguageBtn'
    ).addEventListener(
        'click',
        function () {

            const count =
                languagesContainer.querySelectorAll(
                    '.language-item'
                ).length;


            if (
                count >=
                MAX_LANGUAGES
            ) {

                alert(
                    'You can add a maximum of 5 languages.'
                );

                return;

            }


            const item =
                document.createElement('div');


            item.className =
                'profile-repeat-card language-item';


            item.innerHTML = `
                <div class="form-row">

                    <div class="form-group">

                        <label>
                            Language
                        </label>

                        <input
                            type="text"
                            name="languages[${count}][language_name]"
                            class="student-input"
                            placeholder="e.g. English"
                            readonly
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            Proficiency
                        </label>

                        <select
                            name="languages[${count}][proficiency]"
                            class="student-select"
                            disabled
                        >

                            <option value="">
                                Select Proficiency
                            </option>

                            <option value="Basic">
                                Basic
                            </option>

                            <option value="Intermediate">
                                Intermediate
                            </option>

                            <option value="Fluent">
                                Fluent
                            </option>

                            <option value="Native">
                                Native
                            </option>

                        </select>

                    </div>

                </div>

                <button
                    type="button"
                    class="remove-item-btn"
                    onclick="removeItem(this)"
                >
                    Remove Language
                </button>
            `;


            languagesContainer.appendChild(item);


            reindexItems(
                languagesContainer,
                'language-item',
                'languages'
            );


            if (isEditMode) {

                item.querySelectorAll(
                    '.student-input'
                ).forEach(function (input) {

                    input.removeAttribute(
                        'readonly'
                    );

                });


                item.querySelectorAll(
                    '.student-select'
                ).forEach(function (select) {

                    select.removeAttribute(
                        'disabled'
                    );

                });

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Education
    |--------------------------------------------------------------------------
    */

    const educationsContainer =
        document.getElementById(
            'educationsContainer'
        );


    document.getElementById(
        'addEducationBtn'
    ).addEventListener(
        'click',
        function () {

            const count =
                educationsContainer.querySelectorAll(
                    '.education-item'
                ).length;


            if (
                count >=
                MAX_EDUCATIONS
            ) {

                alert(
                    'You can add a maximum of 5 education records.'
                );

                return;

            }


            const item =
                document.createElement('div');


            item.className =
                'profile-repeat-card education-item';


            item.innerHTML = `
                <div class="profile-repeat-title">
                    Education
                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label>
                            Qualification
                        </label>

                        <input
                            type="text"
                            name="educations[${count}][qualification_name]"
                            class="student-input"
                            placeholder="e.g. BCA"
                            readonly
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            Branch / Specialization
                        </label>

                        <input
                            type="text"
                            name="educations[${count}][branch_name]"
                            class="student-input"
                            placeholder="e.g. Computer Applications"
                            readonly
                        >

                    </div>

                </div>

                <div class="form-group">

                    <label>
                        Institution
                    </label>

                    <input
                        type="text"
                        name="educations[${count}][institution_name]"
                        class="student-input"
                        placeholder="Enter institution name"
                        readonly
                    >

                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label>
                            Start Year
                        </label>

                        <input
                            type="number"
                            name="educations[${count}][start_year]"
                            class="student-input"
                            placeholder="e.g. 2022"
                            readonly
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            End Year
                        </label>

                        <input
                            type="number"
                            name="educations[${count}][end_year]"
                            class="student-input"
                            placeholder="e.g. 2025"
                            readonly
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            CGPA
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="educations[${count}][cgpa]"
                            class="student-input"
                            placeholder="e.g. 8.50"
                            readonly
                        >

                    </div>

                </div>

                <button
                    type="button"
                    class="remove-item-btn"
                    onclick="removeItem(this)"
                >
                    Remove Education
                </button>
            `;


            educationsContainer.appendChild(item);


            reindexItems(
                educationsContainer,
                'education-item',
                'educations'
            );


            if (isEditMode) {

                item.querySelectorAll(
                    '.student-input'
                ).forEach(function (input) {

                    input.removeAttribute(
                        'readonly'
                    );

                });

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Validation Errors
    |--------------------------------------------------------------------------
    */

    @if ($errors->any())

        enableEditMode();

    @endif


    /*
    |--------------------------------------------------------------------------
    | Form Submit
    |--------------------------------------------------------------------------
    |
    | Disabled selects are not submitted by the browser.
    | Enable everything immediately before submission.
    |
    */

    profileForm.addEventListener(
        'submit',
        function () {

            const fields =
                refreshFormFields();


            fields.selects.forEach(
                function (select) {

                    select.removeAttribute(
                        'disabled'
                    );

                }
            );


            fields.inputs.forEach(
                function (input) {

                    /*
                     * Registration fields don't have names,
                     * so they don't need to be submitted.
                     */

                    input.removeAttribute(
                        'readonly'
                    );

                }
            );


            if (photoInput) {
                photoInput.removeAttribute(
                    'disabled'
                );
            }

        }
    );

    /*
    |--------------------------------------------------------------------------
    | Dynamic Qualification -> Branch Auto-Filtering
    |--------------------------------------------------------------------------
    */
    const qidElement = document.getElementById('qid');
    const branchidElement = document.getElementById('branchid');
    const allBranchOptions = branchidElement ? Array.from(branchidElement.querySelectorAll('option[data-qid]')) : [];
    const savedBranchId = "{{ old('branchid', $student->branch_id ?? '') }}";

    function filterBranchesByQualification(selectedQid, targetBranchId) {
        if (!branchidElement) return;

        const chosenId = targetBranchId !== undefined ? targetBranchId : branchidElement.value;

        branchidElement.innerHTML = '<option value="">Select Branch</option>';

        if (!selectedQid) {
            return;
        }

        const matchingOptions = allBranchOptions.filter(function (opt) {
            return String(opt.getAttribute('data-qid')) === String(selectedQid);
        });

        if (matchingOptions.length === 0) {
            const noOpt = document.createElement('option');
            noOpt.value = "";
            noOpt.textContent = "No branches added for this qualification";
            noOpt.disabled = true;
            branchidElement.appendChild(noOpt);
            return;
        }

        var hasSelected = false;
        matchingOptions.forEach(function (opt) {
            const clone = opt.cloneNode(true);
            if (chosenId && String(clone.value) === String(chosenId)) {
                clone.selected = true;
                hasSelected = true;
            }
            branchidElement.appendChild(clone);
        });

        if (matchingOptions.length === 1 && !hasSelected) {
            branchidElement.value = matchingOptions[0].value;
        }
    }

    if (qidElement) {
        qidElement.addEventListener('change', function () {
            filterBranchesByQualification(this.value, null);
        });

        // Initialize on page load
        filterBranchesByQualification(qidElement.value, savedBranchId);
    }

    // Lock browser back navigation on profile page
    (function () {
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function () {
            window.history.pushState(null, "", window.location.href);
        };
    })();

});

</script>
