<style>
    /* Screen Styles */
    .resume-container {
        padding: 130px 15px 60px 15px;
        background: #0f172a;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .resume-paper {
        max-width: 850px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        color: #334155;
    }

    .resume-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        color: #ffffff;
        padding: 35px 40px;
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .resume-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #ffffff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        flex-shrink: 0;
    }

    .resume-header-info h1 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
        color: #ffffff;
    }

    .resume-header-info p {
        font-size: 15px;
        opacity: 0.9;
        margin-bottom: 12px;
        color: #e2e8f0;
    }

    .resume-contact-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        font-size: 13px;
        color: #cbd5e1;
    }

    .resume-contact-bar span {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .resume-body {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        padding: 40px;
    }

    .resume-section {
        margin-bottom: 28px;
    }

    .section-title {
        font-size: 15px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #1e3a8a;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 6px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .resume-item {
        margin-bottom: 18px;
    }

    .resume-item-header {
        display: flex;
        justify-content: space-between;
        font-weight: 600;
        font-size: 14.5px;
        color: #0f172a;
    }

    .resume-item-sub {
        font-size: 12.5px;
        color: #64748b;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .resume-item p {
        font-size: 13px;
        line-height: 1.6;
        color: #475569;
        margin: 0;
    }

    .badge-pill-custom {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
        padding: 5px 11px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 500;
        margin: 3px 4px 3px 0;
    }

    .actions-bar {
        max-width: 850px;
        margin: 0 auto 25px auto;
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
        border: none;
        font-weight: 600;
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

    .btn-download-pdf {
        background: #22c55e;
        color: #ffffff;
        padding: 10px 22px;
        border-radius: 6px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-download-pdf:hover {
        background: #16a34a;
        color: #ffffff;
    }

    /* Print Setup */
    @media print {
        header, footer, .header-area, .actions-bar, .footer {
            display: none !important;
        }
        body {
            background: #ffffff !important;
            margin: 0;
            padding: 0;
        }
        .resume-container {
            padding: 0 !important;
            background: #ffffff !important;
        }
        .resume-paper {
            box-shadow: none !important;
            border-radius: 0 !important;
            max-width: 100% !important;
            width: 100% !important;
        }
    }
</style>

<div class="resume-container">
    
    <!-- Action Bar -->
    <div class="actions-bar">
        <a href="{{ route('student.resume.template1') }}" style="color: #94a3b8; text-decoration: none; font-size: 14px; cursor: pointer;">
            ← Back to Resume Templates
        </a>
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn-download-pdf">
                🖨️ Print / Download PDF
            </button>
        </div>
    </div>

    <!-- Resume Model Sheet -->
    <div class="resume-paper" id="printableResume">
        
        <!-- Header -->
        <div class="resume-header">
            @php
                $avatarUrl = !empty($student->photo) 
                    ? asset('storage/' . $student->photo) 
                    : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=256&auto=format&fit=crop';
            @endphp
            <img src="{{ $avatarUrl }}" 
                 alt="Profile Photo" 
                 class="resume-avatar"
                 onerror="this.src='https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=256&auto=format&fit=crop'">
            
            <div class="resume-header-info">
                <h1>{{ !empty($resume->full_name) ? $resume->full_name : ($user->name ?? 'Student Name') }}</h1>
                <p>{{ !empty($resume->title) ? $resume->title : ($student->carrergoal ?? 'Software Engineer & Candidate') }}</p>
                <div class="resume-contact-bar">
                    <span>✉️ {{ !empty($resume->email) ? $resume->email : ($user->email ?? 'email@example.com') }}</span>
                    <span>📞 {{ !empty($resume->phone) ? $resume->phone : ($student->phone ?? '+1 (555) 234-5678') }}</span>
                    @php $dispNormLoc = !empty($resume->location) ? $resume->location : ($student->collegename ?? ''); @endphp
                    @if(!empty($dispNormLoc))
                        <span>📍 {{ $dispNormLoc }}</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="resume-body">
            
            <!-- Left Main Column -->
            <div class="resume-left-col">
                
                <!-- Career Objective -->
                <div class="resume-section">
                    <div class="section-title">Professional Summary</div>
                    <div style="font-size: 13px; line-height: 1.6; color: #475569; white-space: pre-line;">
                        {{ isset($resume) && !empty($resume->objective) ? $resume->objective : ($student->carrergoal ?? 'Results-driven candidate with solid foundation in problem solving and development practices, eager to contribute to innovative organizational projects.') }}
                    </div>
                </div>

                <!-- Work Experience / Projects -->
                <div class="resume-section">
                    <div class="section-title">Experience & Featured Projects</div>
                    <div style="font-size: 13px; line-height: 1.6; color: #475569; white-space: pre-line;">
                        {{ isset($resume) && !empty($resume->experience) ? $resume->experience : 'Academic coursework and hands-on projects applying modern technical concepts and best practices.' }}
                    </div>
                </div>

                <!-- Certifications & Achievements -->
                <div class="resume-section">
                    <div class="section-title">Certifications & Achievements</div>
                    <div style="font-size: 13px; line-height: 1.6; color: #475569; white-space: pre-line;">
                        {{ isset($resume) && !empty($resume->achievements) ? $resume->achievements : 'Recognized for academic dedication and participation in technical workshops and seminars.' }}
                    </div>
                </div>

            </div>

            <!-- Right Sidebar Column -->
            <div class="resume-right-col">
                
                <!-- Education -->
                <div class="resume-section">
                    <div class="section-title">Education</div>
                    
                    @if($student && $student->educations && $student->educations->isNotEmpty())
                        @foreach($student->educations as $edu)
                            <div class="resume-item">
                                <div class="resume-item-header">
                                    {{ $edu->qualification_name ?: 'Degree' }} {{ $edu->branch_name ? '- ' . $edu->branch_name : '' }}
                                </div>
                                <div class="resume-item-sub">
                                    {{ $edu->institution_name }}
                                </div>
                                @if($edu->start_year || $edu->end_year)
                                    <p><strong>Years:</strong> {{ $edu->start_year }} - {{ $edu->end_year ?: 'Present' }}</p>
                                @endif
                                @if($edu->cgpa)
                                    <p><strong>CGPA:</strong> {{ $edu->cgpa }}</p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="resume-item">
                            <div class="resume-item-header">
                                {{ $student->qualification->qualification_name ?? 'Higher Education' }}
                            </div>
                            <div class="resume-item-sub">
                                {{ $student->collegename ?? 'University / College' }}
                            </div>
                            @if(!empty($student->graduation_year))
                                <p><strong>Graduation:</strong> {{ $student->graduation_year }}</p>
                            @endif
                            @if(!empty($student->cgpa))
                                <p><strong>CGPA:</strong> {{ $student->cgpa }}</p>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Technical Skills -->
                <div class="resume-section">
                    <div class="section-title">Technical Skills</div>
                    <div>
                        @if($student && $student->skills && $student->skills->isNotEmpty())
                            @foreach($student->skills as $skill)
                                <span class="badge-pill-custom">{{ $skill->skill_name }}</span>
                            @endforeach
                        @else
                            <span class="badge-pill-custom">Programming</span>
                            <span class="badge-pill-custom">Web Development</span>
                            <span class="badge-pill-custom">Database Management</span>
                            <span class="badge-pill-custom">Problem Solving</span>
                        @endif
                    </div>
                </div>

                <!-- Languages -->
                <div class="resume-section">
                    <div class="section-title">Languages</div>
                    <div style="font-size: 13px; color: #475569; line-height: 1.6;">
                        {{ isset($resume) && !empty($resume->language) ? $resume->language : 'English' }}
                    </div>
                </div>

                <!-- Hobbies / Interests -->
                <div class="resume-section">
                    <div class="section-title">Interests & Hobbies</div>
                    <div style="font-size: 13px; color: #475569; line-height: 1.6;">
                        {{ isset($resume) && !empty($resume->hobbies) ? $resume->hobbies : ($student->interest ?? 'Technology Research, Open Source, Problem Solving') }}
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>