<style>
    /* Screen Outer Container */
    .resume-wrapper {
        padding: 130px 15px 60px 15px;
        background: #0f172a;
        min-height: 100vh;
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .resume-actions-bar {
        max-width: 820px;
        margin: 0 auto 20px auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .btn-edit-resume {
        background: #2563eb;
        color: #ffffff;
        padding: 10px 22px;
        border-radius: 6px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-edit-resume:hover {
        background: #1d4ed8;
        color: #ffffff;
    }

    .btn-print {
        background: #0284c7;
        color: #ffffff;
        padding: 10px 22px;
        border-radius: 6px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
        text-decoration: none;
    }

    .btn-print:hover {
        background: #0369a1;
        color: #ffffff;
    }

    /* Resume Sheet (A4 Proportion) */
    .standard-resume {
        max-width: 820px;
        margin: 0 auto;
        background: #ffffff;
        padding: 45px 50px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
        color: #334155;
        border-radius: 4px;
    }

    /* Top Header */
    .sr-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .sr-header-left {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    /* Crescent Teal Avatar */
    .sr-avatar-container {
        position: relative;
        width: 105px;
        height: 105px;
        border-radius: 50%;
        padding: 4px;
        border: 4px solid #06b6d4;
        border-top-color: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .sr-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .sr-name-title h1 {
        font-size: 30px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 4px 0;
        line-height: 1.1;
    }

    .sr-name-title p {
        font-size: 14.5px;
        color: #06b6d4;
        font-weight: 600;
        margin: 0;
    }

    /* Header Contact Info (Right) */
    .sr-contact-info {
        text-align: right;
        font-size: 13px;
        color: #475569;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .sr-contact-info span {
        color: #475569;
        display: inline-flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
    }

    .sr-contact-icon {
        color: #0284c7;
        font-size: 14px;
    }

    /* Double Cyan Divider framing the Summary */
    .sr-summary-box {
        border-top: 3px solid #38bdf8;
        border-bottom: 3px solid #38bdf8;
        padding: 16px 0;
        margin: 22px 0 26px 0;
        font-size: 13.5px;
        line-height: 1.65;
        color: #334155;
    }

    /* Section Headers with Concentric Bullseye Icon */
    .sr-section {
        margin-bottom: 24px;
    }

    .sr-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        font-weight: 700;
        color: #0284c7;
        margin-bottom: 14px;
    }

    /* Target / Bullseye Icon */
    .bullseye-icon {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 2px solid #06b6d4;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .bullseye-icon::after {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: #06b6d4;
    }

    /* Date Pill Badge (Blue) */
    .date-pill {
        background-color: #3b82f6;
        color: #ffffff;
        font-size: 11.5px;
        font-weight: 600;
        padding: 3px 14px;
        border-radius: 9999px;
        float: right;
    }

    /* Item Subheadings */
    .sr-item-title {
        font-size: 14.5px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 2px;
    }

    .sr-item-subtitle {
        font-size: 13px;
        font-weight: 600;
        color: #0284c7;
        margin-bottom: 6px;
    }

    /* Dashed Vertical Timeline Line */
    .sr-timeline-block {
        position: relative;
        border-left: 2px dashed #93c5fd;
        padding-left: 18px;
        margin-left: 8px;
        margin-bottom: 20px;
    }

    .sr-timeline-block::before {
        content: '';
        position: absolute;
        left: -6px;
        top: 4px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #3b82f6;
    }

    /* Bullet Points */
    .sr-bullets {
        margin: 6px 0 0 0;
        padding-left: 18px;
        font-size: 13px;
        line-height: 1.6;
        color: #475569;
    }

    .sr-bullets li {
        margin-bottom: 5px;
    }

    /* Skills Pill Tags */
    .sr-skill-badge {
        display: inline-block;
        background-color: #0ea5e9;
        color: #ffffff;
        font-size: 12px;
        font-weight: 500;
        padding: 5px 12px;
        border-radius: 6px;
        margin: 3px 4px 4px 0;
    }

    /* Print View Setup */
    @media print {
        header, footer, .header-area, .resume-actions-bar, .footer {
            display: none !important;
        }
        body {
            background: #ffffff !important;
            margin: 0;
            padding: 0;
        }
        .resume-wrapper {
            padding: 0 !important;
            background: #ffffff !important;
        }
        .standard-resume {
            box-shadow: none !important;
            max-width: 100% !important;
            width: 100% !important;
            padding: 20px 30px !important;
        }
    }
</style>

<div class="resume-wrapper">

    <!-- Action Bar -->
    <div class="resume-actions-bar">
        <a href="{{ route('student.resume.template1') }}" style="color: #94a3b8; text-decoration: none; font-size: 14px; cursor: pointer;">
            ← Back to Resume Templates
        </a>
        <div class="d-flex gap-2">
            @if(isset($resume))
                <a href="{{ route('student.resume.edit', $resume->id) }}" class="btn-edit-resume">
                    ✏️ Edit Resume
                </a>
            @elseif(isset($template))
                <a href="{{ route('student.resume.start', $template->id) }}" class="btn-edit-resume">
                    ✏️ Edit / Customize
                </a>
            @endif
            <button onclick="window.print()" class="btn-print">
                🖨️ Print / Download PDF
            </button>
        </div>
    </div>

    <!-- Resume Paper -->
    <div class="standard-resume">
        
        <!-- Header -->
        <div class="sr-header">
            <div class="sr-header-left">
                <!-- Crescent Avatar -->
                <div class="sr-avatar-container">
                    @php
                        $avatarUrl = !empty($student->photo) 
                            ? asset('storage/' . $student->photo) 
                            : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=256&auto=format&fit=crop';
                    @endphp
                    <img src="{{ $avatarUrl }}" 
                         alt="Profile Photo" 
                         class="sr-avatar"
                         onerror="this.src='https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=256&auto=format&fit=crop'">
                </div>
                <!-- Name & Title -->
                <div class="sr-name-title">
                    <h1>{{ !empty($resume->full_name) ? $resume->full_name : ($user->name ?? 'Candidate Name') }}</h1>
                    <p>{{ !empty($resume->title) ? $resume->title : ($student->carrergoal ?? 'Software Development Professional') }}</p>
                </div>
            </div>

            <!-- Contact Information (Right) -->
            <div class="sr-contact-info">
                @php
                    $dispStdPhone = !empty($resume->phone) ? $resume->phone : ($student->phone ?? '');
                    $dispStdEmail = !empty($resume->email) ? $resume->email : ($user->email ?? 'candidate@example.com');
                    $dispStdLocation = !empty($resume->location) ? $resume->location : ($student->collegename ?? '');
                @endphp
                @if(!empty($dispStdPhone))
                    <span>{{ $dispStdPhone }} <i class="fa fa-phone sr-contact-icon"></i></span>
                @endif
                <span>{{ $dispStdEmail }} <i class="fa fa-envelope sr-contact-icon"></i></span>
                @if(!empty($dispStdLocation))
                    <span>{{ $dispStdLocation }} <i class="fa fa-map-marker sr-contact-icon"></i></span>
                @endif
            </div>
        </div>

        <!-- Career Summary Box with Double Cyan Line -->
        <div class="sr-summary-box" style="white-space: pre-line;">
            {{ isset($resume) && !empty($resume->objective) ? $resume->objective : ($student->carrergoal ?? 'Highly motivated and result-oriented candidate with a solid academic foundation. Proven ability to analyze complex requirements and collaborate in high-performing teams to deliver impactful solutions.') }}
        </div>

        <!-- 1. Education Section -->
        <div class="sr-section">
            <div class="sr-section-title">
                <span class="bullseye-icon"></span>
                <span>Education</span>
            </div>

            @if($student && $student->educations && $student->educations->isNotEmpty())
                @foreach($student->educations as $edu)
                    <div style="margin-left: 28px; margin-bottom: 14px;">
                        @if($edu->start_year || $edu->end_year)
                            <span class="date-pill">{{ $edu->start_year }} - {{ $edu->end_year ?: 'Present' }}</span>
                        @endif
                        <div class="sr-item-title">{{ $edu->institution_name }}</div>
                        <div class="sr-item-subtitle">
                            {{ $edu->qualification_name }} {{ $edu->branch_name ? '| ' . $edu->branch_name : '' }} 
                            {{ $edu->cgpa ? '| CGPA: ' . $edu->cgpa : '' }}
                        </div>
                    </div>
                @endforeach
            @else
                <div style="margin-left: 28px;">
                    @if(!empty($student->graduation_year))
                        <span class="date-pill">Graduation: {{ $student->graduation_year }}</span>
                    @endif
                    <div class="sr-item-title">{{ $student->collegename ?? 'Higher Education Institution' }}</div>
                    <div class="sr-item-subtitle">
                        {{ $student->qualification->qualification_name ?? 'Degree' }} 
                        {{ $student->branch ? '| ' . $student->branch->branch_name : '' }} 
                        {{ !empty($student->cgpa) ? '| CGPA: ' . $student->cgpa : '' }}
                    </div>
                </div>
            @endif
        </div>

        <!-- 2. Professional Experience & Projects -->
        <div class="sr-section">
            <div class="sr-section-title">
                <span class="bullseye-icon"></span>
                <span>Experience & Projects</span>
            </div>

            <div style="margin-left: 28px; font-size: 13.5px; line-height: 1.6; color: #475569; white-space: pre-line;">
                {{ isset($resume) && !empty($resume->experience) ? $resume->experience : 'Academic projects and development experience applying contemporary engineering methodologies and frameworks.' }}
            </div>
        </div>

        <!-- 3. Technical Skills -->
        <div class="sr-section">
            <div class="sr-section-title">
                <span class="bullseye-icon"></span>
                <span>Skills</span>
            </div>

            <div style="margin-left: 28px;">
                @if($student && $student->skills && $student->skills->isNotEmpty())
                    @foreach($student->skills as $skill)
                        <span class="sr-skill-badge">{{ $skill->skill_name }}</span>
                    @endforeach
                @else
                    <span class="sr-skill-badge">Software Development</span>
                    <span class="sr-skill-badge">Database Design</span>
                    <span class="sr-skill-badge">Web Engineering</span>
                    <span class="sr-skill-badge">API Architecture</span>
                    <span class="sr-skill-badge">Team Collaboration</span>
                @endif
            </div>
        </div>

        <!-- 4. Certifications & Achievements -->
        <div class="sr-section">
            <div class="sr-section-title">
                <span class="bullseye-icon"></span>
                <span>Awards & Certifications</span>
            </div>

            <div style="margin-left: 28px; font-size: 13.5px; line-height: 1.6; color: #475569; white-space: pre-line;">
                {{ isset($resume) && !empty($resume->achievements) ? $resume->achievements : 'Recognized for consistent academic achievement, technical certifications, and project participation.' }}
            </div>
        </div>

        <!-- 5. Languages -->
        <div class="sr-section">
            <div class="sr-section-title">
                <span class="bullseye-icon"></span>
                <span>Languages</span>
            </div>

            <div style="margin-left: 28px; font-size: 13.5px; color: #475569; line-height: 1.6;">
                {{ isset($resume) && !empty($resume->language) ? $resume->language : 'English' }}
            </div>
        </div>

        <!-- 6. Areas of Interest -->
        <div class="sr-section">
            <div class="sr-section-title">
                <span class="bullseye-icon"></span>
                <span>Areas of Interest & Hobbies</span>
            </div>

            <div style="margin-left: 28px;">
                <p style="font-size: 13px; color: #475569; margin: 0; line-height: 1.6;">
                    {{ isset($resume) && !empty($resume->hobbies) ? $resume->hobbies : ($student->interest ?? 'Enterprise Cloud Architecture, Scalable Distributed Systems, AI-Assisted Development.') }}
                </p>
            </div>
        </div>

    </div>

</div>