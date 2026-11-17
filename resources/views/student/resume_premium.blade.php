<style>
    /* Screen Wrapper */
    .premium-wrapper {
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
        background: #488b8f;
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
        background: #377074;
        color: #ffffff;
    }

    /* Resume Sheet */
    .premium-resume-sheet {
        max-width: 820px;
        margin: 0 auto;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
        border-radius: 4px;
        overflow: hidden;
        color: #2d3748;
    }

    /* Top Teal Header Banner */
    .pr-header-banner {
        background-color: #488b8f;
        padding: 40px 30px;
        text-align: center;
    }

    .pr-header-banner h1 {
        color: #ffffff;
        font-size: 36px;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin: 0;
    }

    /* Caramel / Ochre Contact Bar */
    .pr-contact-bar {
        background-color: #ca9e67;
        padding: 10px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        font-size: 12.5px;
        color: #ffffff;
        font-weight: 500;
        gap: 15px;
    }

    .pr-contact-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Main Resume Content Area */
    .pr-body {
        padding: 35px 45px 50px 45px;
    }

    /* Section Styling */
    .pr-section {
        margin-bottom: 26px;
    }

    .pr-section-title {
        color: #ca9e67;
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }

    .pr-summary-text {
        font-size: 13px;
        line-height: 1.65;
        color: #2d3748;
        margin: 0;
    }

    /* Teal Date Badges */
    .pr-date-pill {
        background-color: #488b8f;
        color: #ffffff;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 12px;
        border-radius: 4px;
        float: right;
    }

    .pr-item-title {
        font-size: 14.5px;
        font-weight: 700;
        color: #1a202c;
    }

    .pr-item-sub {
        font-size: 13.5px;
        font-weight: 600;
        color: #2d3748;
        margin-top: 2px;
    }

    .pr-item-location {
        font-size: 12px;
        color: #488b8f;
        margin-top: 2px;
    }

    /* Bullet Points */
    .pr-bullets {
        margin: 8px 0 0 0;
        padding-left: 18px;
        font-size: 12.8px;
        line-height: 1.6;
        color: #2d3748;
    }

    .pr-bullets li {
        margin-bottom: 5px;
    }

    /* Skill Tags (White box with gold border) */
    .pr-skill-tag {
        display: inline-block;
        background-color: #ffffff;
        border: 1px solid #ca9e67;
        color: #2d3748;
        font-size: 12px;
        font-weight: 500;
        padding: 4px 12px;
        border-radius: 4px;
        margin: 3px 3px 3px 0;
    }

    /* Print Optimization */
    @media print {
        header, footer, .header-area, .resume-actions-bar, .footer {
            display: none !important;
        }
        body {
            background: #ffffff !important;
            margin: 0;
            padding: 0;
        }
        .premium-wrapper {
            padding: 0 !important;
            background: #ffffff !important;
        }
        .premium-resume-sheet {
            box-shadow: none !important;
            max-width: 100% !important;
            width: 100% !important;
            border-radius: 0 !important;
        }
        .pr-body {
            padding: 25px 30px !important;
        }
    }
</style>

<div class="premium-wrapper">

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

    <!-- Resume Document -->
    <div class="premium-resume-sheet">
        
        <!-- 1. Top Teal Header -->
        <div class="pr-header-banner">
            <h1>{{ !empty($resume->full_name) ? $resume->full_name : ($user->name ?? 'Candidate Name') }}</h1>
            <p style="color: #e6fffa; margin-top: 6px; font-size: 16px; font-weight: 500;">
                {{ !empty($resume->title) ? $resume->title : ($student->carrergoal ?? 'Senior Cloud & Software Professional') }}
            </p>
        </div>

        <!-- 2. Caramel Contact Bar -->
        <div class="pr-contact-bar">
            @php
                $dispLocation = !empty($resume->location) ? $resume->location : ($student->collegename ?? '');
                $dispPhone = !empty($resume->phone) ? $resume->phone : ($student->phone ?? '');
                $dispEmail = !empty($resume->email) ? $resume->email : ($user->email ?? 'candidate@example.com');
            @endphp
            @if(!empty($dispLocation))
                <div class="pr-contact-item">
                    <i class="fa fa-map-marker"></i>
                    <span>{{ $dispLocation }}</span>
                </div>
            @endif
            
            @if(!empty($dispPhone))
                <div class="pr-contact-item">
                    <i class="fa fa-phone"></i>
                    <span>{{ $dispPhone }}</span>
                </div>
            @endif

            <div class="pr-contact-item">
                <i class="fa fa-envelope"></i>
                <span>{{ $dispEmail }}</span>
            </div>
        </div>

        <!-- 3. Resume Body -->
        <div class="pr-body">

            <!-- Summary Section -->
            <div class="pr-section">
                <div class="pr-section-title">
                    <i class="fa fa-user"></i> Professional Summary &amp; Objective
                </div>
                <div class="pr-summary-text" style="white-space: pre-line;">
                    {{ !empty($resume->objective) ? $resume->objective : ($student->carrergoal ?? 'Highly motivated candidate with deep domain foundations and a strong collaborative mindset, seeking to deliver modern technology solutions.') }}
                </div>
            </div>

            <!-- Education Section -->
            <div class="pr-section">
                <div class="pr-section-title">
                    <i class="fa fa-graduation-cap"></i> Education
                </div>
                @if(!empty($resume->education))
                    <div style="font-size: 13.5px; line-height: 1.7; color: #2d3748; white-space: pre-line;">
                        {{ $resume->education }}
                    </div>
                @elseif($student && $student->educations && $student->educations->isNotEmpty())
                    @foreach($student->educations as $edu)
                        <div style="margin-bottom: 14px;">
                            @if($edu->start_year || $edu->end_year)
                                <span class="pr-date-pill">{{ $edu->start_year }} - {{ $edu->end_year ?: 'Present' }}</span>
                            @endif
                            <div class="pr-item-title">{{ $edu->institution_name }}</div>
                            <div class="pr-item-sub">
                                {{ $edu->qualification_name }} {{ $edu->branch_name ? '| ' . $edu->branch_name : '' }} 
                                {{ $edu->cgpa ? '| CGPA: ' . $edu->cgpa : '' }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div>
                        @if(!empty($student->graduation_year))
                            <span class="pr-date-pill">Graduation: {{ $student->graduation_year }}</span>
                        @endif
                        <div class="pr-item-title">{{ $student->collegename ?? 'Higher Education Institution' }}</div>
                        <div class="pr-item-sub">
                            {{ $student->qualification->qualification_name ?? 'Degree' }} 
                            {{ $student->branch ? '| ' . $student->branch->branch_name : '' }} 
                            {{ !empty($student->cgpa) ? '| CGPA: ' . $student->cgpa : '' }}
                        </div>
                    </div>
                @endif
            </div>

            <!-- Experience & Projects Section -->
            <div class="pr-section">
                <div class="pr-section-title">
                    <i class="fa fa-briefcase"></i> Experience &amp; Featured Projects
                </div>

                <div style="font-size: 13.5px; line-height: 1.6; color: #475569; white-space: pre-line;">
                    {{ !empty($resume->experience) ? $resume->experience : 'Academic projects, industry coursework, and software labs focused on engineering quality and scalable design.' }}
                </div>
            </div>

            <!-- Skills Section -->
            <div class="pr-section">
                <div class="pr-section-title">
                    <i class="fa fa-bar-chart"></i> Skills
                </div>
                <div>
                    @if(!empty($resume->skills))
                        @php
                            $skillsList = preg_split('/[,;\n]+/', $resume->skills);
                        @endphp
                        @foreach($skillsList as $sk)
                            @if(trim($sk))
                                <span class="pr-skill-tag">{{ trim($sk) }}</span>
                            @endif
                        @endforeach
                    @elseif($student && $student->skills && $student->skills->isNotEmpty())
                        @foreach($student->skills as $skill)
                            <span class="pr-skill-tag">{{ $skill->skill_name }}</span>
                        @endforeach
                    @else
                        <span class="pr-skill-tag">Software Engineering</span>
                        <span class="pr-skill-tag">Full Stack Development</span>
                        <span class="pr-skill-tag">Database Management</span>
                        <span class="pr-skill-tag">Cloud Services</span>
                        <span class="pr-skill-tag">DevOps &amp; CI/CD</span>
                        <span class="pr-skill-tag">Agile Methodology</span>
                    @endif
                </div>
            </div>

            <!-- Awards & Certifications Section -->
            <div class="pr-section">
                <div class="pr-section-title">
                    <i class="fa fa-trophy"></i> Awards &amp; Certifications
                </div>
                <div style="font-size: 13.5px; line-height: 1.6; color: #475569; white-space: pre-line;">
                    {{ !empty($resume->achievements) ? $resume->achievements : 'Recognized for excellent academic performance, technical participation, and software problem-solving.' }}
                </div>
            </div>

            <!-- Languages Section -->
            <div class="pr-section">
                <div class="pr-section-title">
                    <i class="fa fa-language"></i> Languages
                </div>
                <div style="font-size: 13.5px; color: #475569; line-height: 1.6;">
                    {{ !empty($resume->language) ? $resume->language : 'English' }}
                </div>
            </div>

            <!-- Areas of Interest / Hobbies -->
            <div class="pr-section">
                <div class="pr-section-title">
                    <i class="fa fa-star"></i> Areas of Interest &amp; Hobbies
                </div>
                <p class="pr-summary-text">
                    {{ !empty($resume->hobbies) ? $resume->hobbies : ($student->interest ?? 'Enterprise Cloud Architecture, Artificial Intelligence, Open Source Systems.') }}
                </p>
            </div>

        </div>

    </div>

</div>