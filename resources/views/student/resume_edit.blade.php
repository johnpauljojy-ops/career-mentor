@extends('layouts.resumetempmaster')

@section('content')

<style>
  /* Resume Editor Styles */
  .resume-editor-section {
    padding-top: 130px;
    padding-bottom: 80px;
    background: #0f172a;
    min-height: 100vh;
    font-family: 'Poppins', sans-serif;
  }

  .editor-header-card {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 16px;
    padding: 24px 30px;
    margin-bottom: 30px;
    color: #ffffff;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
  }

  .editor-header-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .editor-badge {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .editor-badge-premium {
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fde68a;
  }

  .editor-badge-free {
    background: #e0f2fe;
    color: #0369a1;
    border: 1px solid #bae6fd;
  }

  .editor-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 32px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    margin-bottom: 30px;
  }

  .editor-card-header {
    border-bottom: 2px solid #f1f5f9;
    padding-bottom: 16px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .editor-card-title {
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .editor-section-divider {
    border-top: 1.5px dashed #e2e8f0;
    margin: 28px 0 24px 0;
    padding-top: 14px;
  }

  .editor-section-heading {
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .editor-label {
    font-size: 13.5px;
    font-weight: 600;
    color: #334155;
    margin-bottom: 7px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .editor-label .badge-source {
    font-size: 11px;
    font-weight: 500;
    color: #0284c7;
    background: #f0f9ff;
    padding: 2px 8px;
    border-radius: 6px;
  }

  .editor-hint {
    font-size: 12px;
    color: #64748b;
    margin-bottom: 8px;
  }

  .editor-input, .editor-textarea {
    width: 100%;
    border: 1.5px solid #cbd5e1;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13.5px;
    color: #1e293b;
    font-family: inherit;
    transition: border-color 0.2s, box-shadow 0.2s;
    background-color: #f8fafc;
  }

  .editor-input:focus, .editor-textarea:focus {
    outline: none;
    border-color: #2563eb;
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
  }

  .editor-textarea {
    line-height: 1.6;
    resize: vertical;
  }

  .btn-save-primary {
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
    color: #ffffff;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: transform 0.15s, box-shadow 0.15s;
    text-decoration: none;
  }

  .btn-save-primary:hover {
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(22, 163, 74, 0.4);
  }

  .btn-preview-accent {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    color: #ffffff;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: transform 0.15s, box-shadow 0.15s;
    text-decoration: none;
  }

  .btn-preview-accent:hover {
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);
  }

  /* AI Sparkle Button */
  .btn-ai-sparkle {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
    color: #ffffff !important;
    border: none;
    border-radius: 8px;
    padding: 11px 20px;
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(139, 92, 246, 0.35);
    transition: all 0.25s ease;
    white-space: nowrap;
    text-decoration: none;
  }

  .btn-ai-sparkle:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 22px rgba(139, 92, 246, 0.55);
    color: #ffffff !important;
  }

  .btn-ai-sparkle:disabled {
    opacity: 0.65;
    cursor: not-allowed;
    transform: none;
  }

  /* AI Copilot Card & Panels */
  .ai-copilot-card {
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    border: 1.5px solid #c7d2fe;
    border-radius: 14px;
    padding: 24px;
    margin-top: 18px;
    margin-bottom: 24px;
    box-shadow: 0 8px 25px rgba(99, 102, 241, 0.08);
    position: relative;
  }

  .ai-copilot-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 14px;
    border-bottom: 1.5px solid #e0e7ff;
  }

  .ai-copilot-title {
    font-size: 16px;
    font-weight: 700;
    color: #3730a3;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .metric-gauge-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 18px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    height: 100%;
  }

  .metric-gauge-title {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
    margin-bottom: 8px;
  }

  .metric-gauge-val {
    font-size: 32px;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 8px;
  }

  .progress-custom {
    height: 9px;
    border-radius: 6px;
    background-color: #f1f5f9;
    overflow: hidden;
    margin-top: 8px;
  }

  .improvement-alert-box {
    background: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 100%);
    border: 1.5px solid #86efac;
    color: #166534;
    border-radius: 10px;
    padding: 14px 18px;
    margin-bottom: 18px;
    font-size: 13.5px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
  }

  .deficiency-alert-box {
    background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
    border: 1.5px solid #fde68a;
    color: #92400e;
    border-radius: 10px;
    padding: 14px 18px;
    margin-bottom: 18px;
    font-size: 13.5px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
  }

  .deficiency-card-item {
    background: #ffffff;
    border: 1px solid #fed7aa;
    border-left: 4px solid #ea580c;
    border-radius: 8px;
    padding: 12px 14px;
    margin-bottom: 10px;
    font-size: 13px;
  }

  .jd-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px;
    margin-bottom: 20px;
  }

  .jd-box-title {
    font-size: 13.5px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .suggestion-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
    padding: 5px 12px;
    border-radius: 6px;
    font-size: 12.5px;
    margin: 3px 4px 3px 0;
    cursor: pointer;
    transition: all 0.15s ease;
  }

  .suggestion-pill:hover {
    background: #dbeafe;
    border-color: #93c5fd;
  }

  .btn-quick-insert {
    background: #ede9fe;
    color: #6d28d9;
    border: 1px solid #ddd6fe;
    border-radius: 6px;
    padding: 4px 10px;
    font-size: 11.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s ease;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .btn-quick-insert:hover {
    background: #ddd6fe;
    color: #5b21b6;
  }

  .btn-re-eval {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 9px 18px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
  }

  .btn-re-eval:hover {
    background: #1d4ed8;
    color: #ffffff;
  }

  .sidebar-box {
    background: #ffffff;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.18);
    margin-bottom: 24px;
  }

  .sidebar-box-title {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
    border-bottom: 1.5px solid #f1f5f9;
    padding-bottom: 10px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .profile-pill {
    display: inline-block;
    background: #f1f5f9;
    color: #334155;
    font-size: 12px;
    padding: 4px 10px;
    border-radius: 6px;
    margin: 3px 4px 3px 0;
    font-weight: 500;
  }

  .editor-input-readonly, .editor-textarea-readonly {
    background-color: #f8fafc !important;
    border-color: #e2e8f0 !important;
    color: #64748b !important;
    cursor: not-allowed !important;
    box-shadow: none !important;
    user-select: none;
  }

  .badge-locked {
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    padding: 3px 9px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .badge-editable {
    font-size: 11px;
    font-weight: 600;
    color: #166534;
    background: #dcfce7;
    border: 1px solid #bbf7d0;
    padding: 3px 9px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .editor-standard-banner {
    background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
    border: 1px solid #bbf7d0;
    border-left: 5px solid #16a34a;
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 24px;
    color: #166534;
  }

  @keyframes pulseGreen {
    0% { background-color: #dcfce7; }
    100% { background-color: #ffffff; }
  }

  .flash-highlight {
    animation: pulseGreen 1.4s ease-out;
  }
</style>

<section class="resume-editor-section">
  <div class="container">

    <!-- Flash Messages -->
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px; background-color: #dcfce7; color: #15803d; padding: 14px 20px; font-weight: 500;">
        <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right; background: none; border: none; font-size: 18px; cursor: pointer; color: #15803d;">&times;</button>
      </div>
    @endif

    @if(session('info'))
      <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px; background-color: #e0f2fe; color: #0369a1; padding: 14px 20px; font-weight: 500;">
        <i class="fa fa-info-circle me-2"></i> {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right; background: none; border: none; font-size: 18px; cursor: pointer; color: #0369a1;">&times;</button>
      </div>
    @endif

    @if(isset($errors) && $errors->any())
      <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px; background-color: #fee2e2; color: #b91c1c; padding: 14px 20px; font-weight: 500;">
        <i class="fa fa-exclamation-circle me-2"></i> Please check the form errors below.
        <ul class="mb-0 mt-2 ps-3">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right; background: none; border: none; font-size: 18px; cursor: pointer; color: #b91c1c;">&times;</button>
      </div>
    @endif

    @php
      $isStandard = $template && $template->isStandard();
      $isPremium = $template && $template->isPremium();
      $savedAi = is_array($resume->ai_suggestions) ? $resume->ai_suggestions : (is_string($resume->ai_suggestions) ? json_decode($resume->ai_suggestions, true) : null);
    @endphp

    <!-- Editor Header Bar -->
    <div class="editor-header-card">
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
          <div class="editor-header-title">
            <span>✏️ Edit Resume</span>
            @if($template)
              @if($isPremium)
                <span class="editor-badge editor-badge-premium">⭐ {{ $template->template_name }}</span>
              @elseif($isStandard)
                <span class="editor-badge" style="background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd;">📄 Standard Resume</span>
              @else
                <span class="editor-badge editor-badge-free">📄 {{ $template->template_name }}</span>
              @endif
            @endif
          </div>
          <p style="margin: 0; color: #94a3b8; font-size: 13px;">
            @if($isStandard)
              In the Standard Resume, only <strong>Work Experience &amp; Featured Projects</strong> and <strong>Achievements &amp; Certifications</strong> can be edited. All other fields are locked to your profile details.
            @elseif($isPremium)
              ⭐ In this <strong>Premium Resume</strong>, all details that occur in the resume are completely customizable. Use the <strong>AI Resume Copilot</strong> to benchmark against your target designation, track deficiency, and measure improvements!
            @else
              Customize your resume fields fetched from your student profile. Save your updates, then preview and download/print your resume.
            @endif
          </p>
        </div>

        <div class="d-flex flex-wrap gap-2">
          <a href="{{ route('student.resume.template1') }}" class="btn btn-outline-light btn-sm" style="border-radius: 6px; padding: 8px 14px; font-size: 13px;">
            ← Templates
          </a>
          <a href="{{ route('student.resume.preview', $resume->id) }}" class="btn-preview-accent btn-sm" style="padding: 8px 16px; border-radius: 6px; font-size: 13px;">
            👁️ Preview / Print
          </a>
        </div>
      </div>
    </div>

    <div class="row">

      <!-- Left Column: Edit Form -->
      <div class="col-lg-8">
        <div class="editor-card">

          @if($isStandard)
            <div class="editor-standard-banner">
              <div class="d-flex align-items-center gap-2 mb-1">
                <i class="fa fa-info-circle" style="font-size: 1.15rem;"></i>
                <strong style="font-size: 14.5px;">Standard Resume Editing Rules</strong>
              </div>
              <div style="font-size: 13px; line-height: 1.5;">
                In the Standard Resume, only <strong>Work Experience &amp; Featured Projects</strong> and <strong>Achievements &amp; Certifications</strong> can be edited. All other fields cannot be edited and are locked to your profile.
              </div>
            </div>
          @endif

          <div class="editor-card-header">
            <h3 class="editor-card-title">
              <i class="fa fa-file-text-o text-primary"></i> Resume Content
            </h3>
            <span style="font-size: 12px; color: #64748b;">
              Last updated: {{ $resume->updated_at ? $resume->updated_at->format('M d, Y h:i A') : 'Just now' }}
            </span>
          </div>

          <form action="{{ route('student.resume.update', $resume->id) }}" method="POST" id="resumeForm">
            @csrf
            @method('PUT')

            {{-- PREMIUM EXCLUSIVE: PERSONAL & CONTACT INFORMATION --}}
            @if($isPremium)
              <div class="editor-section-heading">
                <i class="fa fa-user-circle text-primary"></i> Personal &amp; Contact Details
                <span class="badge-editable ms-2"><i class="fa fa-pencil"></i> Manually Editable</span>
              </div>

              <div class="row g-3 mb-4">
                <div class="col-md-6">
                  <label class="editor-label" for="full_name">
                    <span>Full Name</span>
                    <span class="badge-source">Candidate Name</span>
                  </label>
                  <input type="text" name="full_name" id="full_name" class="editor-input" 
                         value="{{ old('full_name', $resume->full_name ?: ($user->name ?? '')) }}" required>
                </div>

                <div class="col-md-6">
                  <label class="editor-label" for="email">
                    <span>Email Address</span>
                    <span class="badge-source">Contact Email</span>
                  </label>
                  <input type="email" name="email" id="email" class="editor-input" 
                         value="{{ old('email', $resume->email ?: ($user->email ?? '')) }}">
                </div>

                <div class="col-md-6">
                  <label class="editor-label" for="phone">
                    <span>Phone Number</span>
                    <span class="badge-source">Contact Phone</span>
                  </label>
                  <input type="text" name="phone" id="phone" class="editor-input" 
                         value="{{ old('phone', $resume->phone ?: ($student->phone ?? '')) }}">
                </div>

                <div class="col-md-6">
                  <label class="editor-label" for="location">
                    <span>Location / College / Address</span>
                    <span class="badge-source">Address / Campus</span>
                  </label>
                  <input type="text" name="location" id="location" class="editor-input" 
                         value="{{ old('location', $resume->location ?: ($student->collegename ?? '')) }}">
                </div>
              </div>

              <div class="editor-section-divider"></div>
            @endif

            {{-- FIELD 1: RESUME TITLE / HEADING (Database Field: title) --}}
            <div class="mb-4">
              <label class="editor-label" for="title">
                <span>
                  <strong>Resume Title / Heading</strong>
                </span>
                @if($isStandard)
                  <span class="badge-locked"><i class="fa fa-lock"></i> Locked in Standard Resume</span>
                @else
                  <span class="badge-source">Database Field: title</span>
                @endif
              </label>

              <div class="editor-hint">
                @if($isStandard)
                  <span class="text-muted"><i class="fa fa-lock me-1"></i> Locked in Standard Resume. Sourced from your profile.</span>
                @else
                  The primary title / headline displayed on your resume (e.g. <em>Full Stack Developer, Senior Software Engineer</em>).
                @endif
              </div>

              <input type="text" name="title" id="title" 
                     class="editor-input {{ $isStandard ? 'editor-input-readonly' : '' }}" 
                     value="{{ old('title', $resume->title ?: ($student->carrergoal ?? 'Full Stack Developer')) }}" 
                     placeholder="e.g. Senior Software Developer, Cloud Architect, Data Scientist"
                     @if($isStandard) readonly tabindex="-1" @else required @endif
                     style="font-size: 14.5px; font-weight: 600; color: #0f172a;">
            </div>

            @if($isPremium)
            {{-- AI SEARCH FIELD: DESIGNATION (Form field used exclusively for AI suggestions search - NOT a database column) --}}
            @php
              $currentDesignation = old('designation', 
                $savedAi['designation'] 
                ?? ($savedAi['job_description']['title'] 
                ?? ($resume->title ?: ($student->carrergoal ?? 'Full Stack Developer')))
              );
            @endphp
            <div class="mb-4 p-3 rounded" style="background: #f8faff; border: 1.5px solid #c7d2fe;">
              <label class="editor-label" for="designation">
                <span style="color: #3730a3;">
                  <strong><i class="fa fa-crosshairs me-1"></i> Target Designation (for AI Search &amp; Suggestions)</strong>
                </span>
                <span class="badge" style="background: #eef2ff; color: #4f46e5; border: 1px solid #c7d2fe; font-size: 11px; padding: 4px 8px; border-radius: 6px;">
                  ✨ AI Search Field
                </span>
              </label>

              <div class="editor-hint" style="color: #4b5563;">
                Enter the target job designation for AI suggestions (e.g. <em>Full Stack Developer, Cloud Architect, Data Scientist</em>). Click <strong>Get AI Suggestions</strong> to benchmark your resume against industry standards.
                <span class="d-block mt-1 text-muted" style="font-size: 11px;">
                  <i class="fa fa-info-circle"></i> <em>Note: Designation is used for AI suggestion search and is not a direct column on the resumes table.</em>
                </span>
              </div>

              <div class="d-flex flex-wrap gap-2 align-items-center">
                <div class="flex-grow-1" style="min-width: 260px;">
                  <input type="text" name="designation" id="designation" 
                         class="editor-input" 
                         value="{{ $currentDesignation }}" 
                         placeholder="e.g. Senior Software Developer, Cloud Architect, Data Scientist"
                         style="font-size: 14.5px; font-weight: 600; color: #1e1b4b; background: #ffffff;">
                </div>

                {{-- AI SUGGESTIONS BUTTON: ONLY FOR PREMIUM RESUMES --}}
                <button type="button" id="btn-get-ai-suggestions" class="btn-ai-sparkle">
                  <i class="fa fa-magic"></i> ✨ Get AI Suggestions
                </button>
              </div>
            </div>
            @endif

            {{-- DYNAMIC AI COPILOT & DEFICIENCY / IMPROVEMENT PANEL (PREMIUM ONLY) --}}
            @if($isPremium)
              <div id="aiResumeAssistantPanel" class="ai-copilot-card" style="{{ empty($savedAi) && empty($resume->ai_score) ? 'display: none;' : '' }}">
                
                <div class="ai-copilot-header">
                  <div class="ai-copilot-title">
                    <span>🤖 AI Career Copilot &amp; ATS Match Analyzer</span>
                  </div>
                  <div class="d-flex align-items-center gap-2">
                    <button type="button" id="btn-re-eval-corrections" class="btn-re-eval">
                      <i class="fa fa-refresh"></i> 🔄 Re-evaluate After Corrections
                    </button>
                  </div>
                </div>

                {{-- Improvement / Deficiency Status Banner --}}
                <div id="aiImprovementBanner" class="improvement-alert-box" style="{{ !empty($savedAi['evaluation']['is_improved']) || (!empty($savedAi['evaluation']['score_improvement']) && $savedAi['evaluation']['score_improvement'] > 0) ? '' : 'display: none;' }}">
                  <i class="fa fa-trophy" style="font-size: 1.3rem; color: #16a34a; margin-top: 2px;"></i>
                  <div>
                    <strong style="font-size: 14px;" id="aiImprovementTitle">
                      🎉 Resume Improved by +{{ $savedAi['evaluation']['score_improvement'] ?? 0 }}%!
                    </strong>
                    <div style="font-size: 12.5px; margin-top: 2px;" id="aiImprovementText">
                      {{ $savedAi['evaluation']['improvement_summary'] ?? 'Your updates closed key competency gaps against this designation.' }}
                    </div>
                  </div>
                </div>

                {{-- Score and Deficiency Meters --}}
                <div class="row g-3 mb-4">
                  <div class="col-md-6">
                    <div class="metric-gauge-card">
                      <div class="metric-gauge-title">ATS Job Description Match</div>
                      <div class="metric-gauge-val text-success" id="aiMatchScoreVal">
                        {{ $savedAi['evaluation']['match_score'] ?? ($resume->ai_score ?? 75) }}%
                      </div>
                      <span class="badge" style="background: #dcfce7; color: #166534;" id="aiMatchBadge">
                        {{ $savedAi['evaluation']['status_badge'] ?? 'Well Aligned' }}
                      </span>
                      <div class="progress-custom">
                        <div id="aiMatchProgressBar" class="progress-bar bg-success" role="progressbar" 
                             style="width: {{ $savedAi['evaluation']['match_score'] ?? ($resume->ai_score ?? 75) }}%;"></div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="metric-gauge-card">
                      <div class="metric-gauge-title">Resume Deficiency Gap</div>
                      <div class="metric-gauge-val text-danger" id="aiDeficiencyScoreVal">
                        {{ $savedAi['evaluation']['deficiency_score'] ?? ($resume->ai_deficiency ?? 25) }}%
                      </div>
                      <span class="badge" style="background: #fee2e2; color: #991b1b;" id="aiDeficiencyBadge">
                        {{ $savedAi['evaluation']['deficiency_level'] ?? 'Moderate' }} Deficiency
                      </span>
                      <div class="progress-custom">
                        <div id="aiDeficiencyProgressBar" class="progress-bar bg-danger" role="progressbar" 
                             style="width: {{ $savedAi['evaluation']['deficiency_score'] ?? ($resume->ai_deficiency ?? 25) }}%;"></div>
                      </div>
                    </div>
                  </div>
                </div>

                {{-- Benchmark Job Description Accordion/Box --}}
                <div class="jd-box">
                  <div class="jd-box-title">
                    <i class="fa fa-briefcase text-primary"></i> 
                    <span>Industry Benchmark Job Description: <strong id="jdRoleTitle">{{ $savedAi['job_description']['title'] ?? ($resume->title ?: 'Target Role') }}</strong></span>
                  </div>
                  <p style="font-size: 13px; color: #475569; margin-bottom: 10px;" id="jdRoleOverview">
                    {{ $savedAi['job_description']['overview'] ?? 'Overview of role expectations, competencies, and responsibilities.' }}
                  </p>

                  <div class="row g-2 pt-2 border-top">
                    <div class="col-md-6">
                      <strong style="font-size: 12px; color: #334155; display: block; margin-bottom: 4px;">Key Responsibilities:</strong>
                      <ul style="font-size: 12px; color: #64748b; padding-left: 18px; margin: 0;" id="jdResponsibilitiesList">
                        @if(!empty($savedAi['job_description']['key_responsibilities']))
                          @foreach($savedAi['job_description']['key_responsibilities'] as $resp)
                            <li>{{ $resp }}</li>
                          @endforeach
                        @else
                          <li>Architecture & technical delivery in modern frameworks.</li>
                          <li>Optimizing performance, security, and scalability.</li>
                        @endif
                      </ul>
                    </div>
                    <div class="col-md-6">
                      <strong style="font-size: 12px; color: #334155; display: block; margin-bottom: 4px;">Required Core Skills:</strong>
                      <div id="jdSkillsBadges">
                        @if(!empty($savedAi['job_description']['required_skills']))
                          @foreach($savedAi['job_description']['required_skills'] as $sk)
                            <span class="badge bg-light text-dark border me-1 mb-1" style="font-size: 11px;">{{ $sk }}</span>
                          @endforeach
                        @else
                          <span class="badge bg-light text-dark border me-1 mb-1" style="font-size: 11px;">Technical Problem Solving</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                {{-- Identified Deficiencies List --}}
                <div class="mb-4">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <strong style="font-size: 13.5px; color: #991b1b;">
                      <i class="fa fa-exclamation-triangle me-1"></i> Deficiencies &amp; Gaps in Current Resume
                    </strong>
                    <span style="font-size: 11.5px; color: #64748b;">Correct these below to boost your score</span>
                  </div>
                  <div id="deficienciesContainer">
                    @if(!empty($savedAi['deficiencies']))
                      @foreach($savedAi['deficiencies'] as $def)
                        <div class="deficiency-card-item">
                          <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong>{{ $def['section'] ?? 'Resume' }}: {{ $def['issue'] ?? '' }}</strong>
                            <span class="badge {{ ($def['severity'] ?? '') === 'High' ? 'bg-danger' : 'bg-warning text-dark' }}" style="font-size: 10px;">
                              {{ $def['severity'] ?? 'Medium' }} Gap
                            </span>
                          </div>
                          <div style="font-size: 12px; color: #475569;">
                            💡 <em>Fix:</em> {{ $def['recommendation'] ?? '' }}
                          </div>
                        </div>
                      @endforeach
                    @else
                      <div class="deficiency-card-item">
                        <strong>Analysis ready:</strong> Click <em>Get AI Suggestions</em> to diagnose keyword gaps and missing metrics for this designation.
                      </div>
                    @endif
                  </div>
                </div>

                {{-- Actionable Section Suggestions (with Quick Apply / Insert) --}}
                <div>
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <strong style="font-size: 13.5px; color: #1e293b;">
                      <i class="fa fa-lightbulb-o text-warning me-1"></i> AI Suggestions by Section
                    </strong>
                    <span style="font-size: 11.5px; color: #475569;">Click buttons to quickly apply suggestions</span>
                  </div>

                  {{-- Suggested Objective --}}
                  <div class="p-3 mb-3" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <strong style="font-size: 12.5px; color: #334155;">✨ Tailored Objective for <span id="objectiveForRole">{{ $savedAi['designation'] ?? ($savedAi['job_description']['title'] ?? ($resume->title ?: 'Target Role')) }}</span>:</strong>
                      <button type="button" class="btn-quick-insert" id="btnApplyObjective">
                        <i class="fa fa-check"></i> Apply to Objective
                      </button>
                    </div>
                    <p style="font-size: 12.5px; color: #475569; margin: 0; line-height: 1.6;" id="suggestedObjectiveText">
                      {{ $savedAi['section_suggestions']['suggested_objective'] ?? 'Dedicated and detail-oriented candidate targeting this designation, offering solid academic grounding, hands-on project experience, and modern technology proficiencies.' }}
                    </p>
                  </div>

                  {{-- Missing Skills to Add --}}
                  <div class="p-3 mb-3" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <strong style="font-size: 12.5px; color: #334155;">✨ Missing Skills for this Designation:</strong>
                      <button type="button" class="btn-quick-insert" id="btnAddAllSkills">
                        <i class="fa fa-plus"></i> Add All to Skills
                      </button>
                    </div>
                    <div id="missingSkillsContainer">
                      @if(!empty($savedAi['section_suggestions']['missing_skills_to_add']))
                        @foreach($savedAi['section_suggestions']['missing_skills_to_add'] as $mskill)
                          <span class="suggestion-pill" onclick="appendSingleSkill('{{ addslashes($mskill) }}')">
                            + {{ $mskill }}
                          </span>
                        @endforeach
                      @else
                        <span class="text-muted" style="font-size: 12px;">No missing skills identified yet.</span>
                      @endif
                    </div>
                  </div>

                  {{-- Experience Enhancements --}}
                  <div class="p-3" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <strong style="font-size: 12.5px; color: #334155;">✨ Suggested Experience Impact Bullets:</strong>
                      <button type="button" class="btn-quick-insert" id="btnAppendExperience">
                        <i class="fa fa-plus-circle"></i> Append to Experience
                      </button>
                    </div>
                    <div id="experienceEnhancementsList" style="font-size: 12.5px; color: #475569; white-space: pre-line;">
                      @if(!empty($savedAi['section_suggestions']['experience_enhancements']))
                        {{ implode("\n", $savedAi['section_suggestions']['experience_enhancements']) }}
                      @else
                        • Spearheaded feature development applying industry best practices, boosting system efficiency by 25%.
                        • Designed scalable modular endpoints integrated with automated validation and responsive interfaces.
                      @endif
                    </div>
                  </div>

                </div>

              </div>
            @endif

            {{-- FIELD 2: CAREER OBJECTIVE --}}
            <div class="mb-4">
              <label class="editor-label" for="objective">
                <span>Career Objective / Professional Summary</span>
                @if($isStandard)
                  <span class="badge-locked"><i class="fa fa-lock"></i> Locked in Standard Resume</span>
                @else
                  <span class="badge-source">From Career Goal &amp; Interests</span>
                @endif
              </label>
              <div class="editor-hint">
                @if($isStandard)
                  <span class="text-muted"><i class="fa fa-lock me-1"></i> Locked in Standard Resume. Sourced from your profile summary.</span>
                @else
                  A concise summary of your career focus, technical ambitions, and core strengths.
                @endif
              </div>
              <textarea name="objective" id="objective" rows="4" 
                        class="editor-textarea {{ $isStandard ? 'editor-textarea-readonly' : '' }}"
                        @if($isStandard) readonly tabindex="-1" @endif>{{ old('objective', $resume->objective) }}</textarea>
            </div>

            {{-- PREMIUM EXCLUSIVE: EDUCATION DETAILS (MANUALLY EDITABLE) --}}
            @if($isPremium)
              <div class="mb-4">
                <label class="editor-label" for="education">
                  <span>Education History &amp; Academic Qualifications</span>
                  <span class="badge-editable"><i class="fa fa-pencil"></i> Manually Editable</span>
                </label>
                <div class="editor-hint">
                  Customize degree names, universities, graduation years, and CGPA/scores.
                </div>
                <textarea name="education" id="education" rows="5" class="editor-textarea" 
                          placeholder="• Bachelor of Computer Applications in Computer Science - University College (2020 - 2023) | CGPA: 8.10">{{ old('education', $resume->education) }}</textarea>
              </div>
            @endif

            {{-- FIELD 3: WORK EXPERIENCE & PROJECTS (EDITABLE) --}}
            <div class="mb-4">
              <label class="editor-label" for="experience">
                <span>Work Experience &amp; Featured Projects</span>
                @if($isStandard)
                  <span class="badge-editable"><i class="fa fa-pencil"></i> Editable</span>
                @else
                  <span class="badge-source">Projects &amp; Work History</span>
                @endif
              </label>
              <div class="editor-hint">
                @if($isStandard)
                  <span class="text-success fw-semibold"><i class="fa fa-pencil me-1"></i> Editable:</span> Detail your internships, key software projects, technologies used, and responsibilities.
                @else
                  Detail your internships, key software projects, technologies used, and responsibilities.
                @endif
              </div>
              <textarea name="experience" id="experience" rows="8" class="editor-textarea" style="{{ $isStandard ? 'border: 1.5px solid #16a34a;' : '' }}">{{ old('experience', $resume->experience) }}</textarea>
            </div>

            {{-- PREMIUM EXCLUSIVE: TECHNICAL & CORE SKILLS (MANUALLY EDITABLE) --}}
            @if($isPremium)
              <div class="mb-4">
                <label class="editor-label" for="skills">
                  <span>Technical &amp; Core Skills</span>
                  <span class="badge-editable"><i class="fa fa-pencil"></i> Manually Editable</span>
                </label>
                <div class="editor-hint">
                  Comma-separated list of technical competencies, tools, frameworks, and programming languages.
                </div>
                <textarea name="skills" id="skills" rows="3" class="editor-textarea" 
                          placeholder="Python, Laravel, MySQL, Docker, RESTful APIs, Git, Cloud Architecture">{{ old('skills', $resume->skills) }}</textarea>
              </div>
            @endif

            {{-- FIELD 4: ACHIEVEMENTS & CERTIFICATIONS (EDITABLE) --}}
            <div class="mb-4">
              <label class="editor-label" for="achievements">
                <span>Achievements &amp; Certifications</span>
                @if($isStandard)
                  <span class="badge-editable"><i class="fa fa-pencil"></i> Editable</span>
                @else
                  <span class="badge-source">Certifications &amp; Academic Merit</span>
                @endif
              </label>
              <div class="editor-hint">
                @if($isStandard)
                  <span class="text-success fw-semibold"><i class="fa fa-pencil me-1"></i> Editable:</span> Licenses, online certifications, hackathons, academic awards, or special honors.
                @else
                  Licenses, online certifications, hackathons, academic awards, or special honors.
                @endif
              </div>
              <textarea name="achievements" id="achievements" rows="5" class="editor-textarea" style="{{ $isStandard ? 'border: 1.5px solid #16a34a;' : '' }}">{{ old('achievements', $resume->achievements) }}</textarea>
            </div>

            {{-- FIELD 5: LANGUAGES --}}
            <div class="mb-4">
              <label class="editor-label" for="language">
                <span>Languages</span>
                @if($isStandard)
                  <span class="badge-locked"><i class="fa fa-lock"></i> Locked in Standard Resume</span>
                @elseif($isPremium)
                  <span class="badge-editable"><i class="fa fa-pencil"></i> Manually Editable</span>
                @else
                  <span class="badge-source">From Student Languages</span>
                @endif
              </label>
              <div class="editor-hint">
                @if($isStandard)
                  <span class="text-muted"><i class="fa fa-lock me-1"></i> Locked in Standard Resume. Sourced from your profile languages.</span>
                @else
                  Languages you can read, write, or speak (e.g. English (Fluent), Hindi, Malayalam).
                @endif
              </div>
              <input type="text" name="language" id="language" 
                     class="editor-input {{ $isStandard ? 'editor-input-readonly' : '' }}" 
                     value="{{ old('language', $resume->language) }}"
                     @if($isStandard) readonly tabindex="-1" @endif>
            </div>

            {{-- FIELD 6: HOBBIES & INTERESTS --}}
            <div class="mb-4">
              <label class="editor-label" for="hobbies">
                <span>Hobbies &amp; Extracurricular Interests</span>
                @if($isStandard)
                  <span class="badge-locked"><i class="fa fa-lock"></i> Locked in Standard Resume</span>
                @elseif($isPremium)
                  <span class="badge-editable"><i class="fa fa-pencil"></i> Manually Editable</span>
                @else
                  <span class="badge-source">From Career Interests</span>
                @endif
              </label>
              <div class="editor-hint">
                @if($isStandard)
                  <span class="text-muted"><i class="fa fa-lock me-1"></i> Locked in Standard Resume. Sourced from your profile interests.</span>
                @else
                  Personal interests, co-curricular activities, community participation, or tech hobbies.
                @endif
              </div>
              <input type="text" name="hobbies" id="hobbies" 
                     class="editor-input {{ $isStandard ? 'editor-input-readonly' : '' }}" 
                     value="{{ old('hobbies', $resume->hobbies) }}"
                     @if($isStandard) readonly tabindex="-1" @endif>
            </div>

            <!-- Action Buttons Bar -->
            <div class="pt-3 border-top d-flex flex-wrap justify-content-between align-items-center gap-3">
              <div class="d-flex flex-wrap gap-2">
                <button type="submit" name="action" value="save" class="btn-save-primary">
                  <i class="fa fa-check"></i> Save Changes
                </button>
                <button type="submit" name="action" value="preview" class="btn-preview-accent">
                  <i class="fa fa-eye"></i> Save &amp; Preview
                </button>
              </div>

              <a href="{{ route('student.resume.preview', $resume->id) }}" class="btn btn-outline-secondary" style="font-size: 13.5px; border-radius: 8px;">
                👁️ View Live Preview
              </a>
            </div>

          </form>
        </div>
      </div>

      <!-- Right Column: Profile Summary & Sync Actions -->
      <div class="col-lg-4">

        <!-- Template Preview Info Card -->
        @if($template)
        <div class="sidebar-box">
          <div class="sidebar-box-title">
            <i class="fa fa-image text-primary"></i> Active Template
          </div>
          <div class="text-center mb-3">
            <img src="{{ $template->preview_url }}" 
                 alt="{{ $template->template_name }}" 
                 style="width: 100%; height: 180px; object-fit: cover; object-position: top; border-radius: 8px; border: 1px solid #e2e8f0;"
                 onerror="this.src='{{ asset('guest/assets/r1.jpeg') }}'">
            <h5 class="mt-2 mb-1" style="font-size: 16px; font-weight: 700; color: #1e293b;">
              {{ $template->template_name }}
            </h5>
            <span style="font-size: 12px; color: #64748b;">
              {{ $template->isPremium() ? '⭐ Premium ATS Design (AI Enabled)' : '📄 Free Standard Design' }}
            </span>
          </div>
          <div class="d-grid gap-2">
            <a href="{{ route('student.resume.preview', $resume->id) }}" class="btn btn-primary btn-sm fw-bold" style="border-radius: 6px;">
              👁️ View Fullscreen Preview
            </a>
            <a href="{{ route('student.resume.template1') }}" class="btn btn-outline-secondary btn-sm" style="border-radius: 6px;">
              🔄 Change Template
            </a>
          </div>
        </div>
        @endif

        <!-- Student Profile Overview -->
        <div class="sidebar-box">
          <div class="sidebar-box-title">
            <i class="fa fa-user-circle text-success"></i> Linked Profile Data
          </div>

          <p style="font-size: 12.5px; color: #64748b; margin-bottom: 14px;">
            The baseline information below was sourced from your verified student profile. In this Premium Resume, you can edit all details directly in the form on the left.
          </p>

          <div style="font-size: 13px; color: #334155;">
            <p class="mb-1"><strong>Name:</strong> {{ $user->name }}</p>
            <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="mb-1"><strong>Phone:</strong> {{ $student->phone ?? 'Not set' }}</p>
            <p class="mb-1"><strong>College:</strong> {{ $student->collegename ?? 'Not set' }}</p>
            <p class="mb-1"><strong>Degree:</strong> {{ $student->qualification->qualification_name ?? 'Not set' }}</p>
            <p class="mb-1"><strong>Branch:</strong> {{ $student->branch->branch_name ?? 'Not set' }}</p>
            <p class="mb-2"><strong>CGPA:</strong> {{ $student->cgpa ?? 'N/A' }} (Grad: {{ $student->graduation_year ?? 'N/A' }})</p>

            <div class="mt-3">
              <strong style="font-size: 12px; color: #475569; display: block; margin-bottom: 6px;">Skills from Profile:</strong>
              @if($student && $student->skills && $student->skills->isNotEmpty())
                @foreach($student->skills as $skill)
                  <span class="profile-pill">{{ $skill->skill_name }}</span>
                @endforeach
              @else
                <span class="text-muted" style="font-size: 12px;">No skills added in profile yet.</span>
              @endif
            </div>
          </div>
        </div>

        <!-- Reload / Re-sync Card -->
        <div class="sidebar-box" style="border: 1px dashed #cbd5e1; background: #f8fafc;">
          <div class="sidebar-box-title" style="color: #475569;">
            <i class="fa fa-refresh text-warning"></i> Re-sync with Profile
          </div>
          <p style="font-size: 12px; color: #64748b; line-height: 1.6; margin-bottom: 14px;">
            Updated your student profile recently? You can overwrite this resume's fields with the fresh data from your profile.
          </p>
          <form action="{{ route('student.resume.reset', $resume->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to reload from your profile? Any unsaved edits in this form will be replaced with fresh profile data.');">
            @csrf
            <button type="submit" class="btn btn-outline-warning w-100 fw-bold text-dark btn-sm" style="border-radius: 6px;">
              🔄 Reload Fields from Profile
            </button>
          </form>
        </div>

      </div>

    </div>
  </div>
</section>

{{-- JAVASCRIPT FOR AI SUGGESTIONS, DEFICIENCY ANALYSIS & IMPROVEMENT TRACKING --}}
@if($isPremium)
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btnGetSuggestions = document.getElementById('btn-get-ai-suggestions');
    const btnReEval = document.getElementById('btn-re-eval-corrections');
    const panel = document.getElementById('aiResumeAssistantPanel');
    const titleInput = document.getElementById('title');
    const designationInput = document.getElementById('designation');
    const csrfToken = '{{ csrf_token() }}';
    const aiUrl = '{{ route("student.resume.ai_suggestions", $resume->id) }}';

    // Current scores for tracking improvements across corrections
    let currentMatchScore = {{ $savedAi['evaluation']['match_score'] ?? ($resume->ai_score ?? 'null') }};
    let currentDeficiencyScore = {{ $savedAi['evaluation']['deficiency_score'] ?? ($resume->ai_deficiency ?? 'null') }};

    function runAiAnalysis(isCorrectionReEval = false) {
      const designation = (designationInput && designationInput.value.trim()) 
        ? designationInput.value.trim() 
        : (titleInput ? titleInput.value.trim() : '');

      if (!designation) {
        alert('Please enter a target designation in the Designation box to get AI suggestions.');
        if (designationInput) designationInput.focus();
        else if (titleInput) titleInput.focus();
        return;
      }

      // Collect live form values so AI evaluates whatever the user typed/corrected
      const payload = {
        designation: designation,
        title: titleInput ? titleInput.value.trim() : designation,
        full_name: document.getElementById('full_name') ? document.getElementById('full_name').value : '',
        email: document.getElementById('email') ? document.getElementById('email').value : '',
        phone: document.getElementById('phone') ? document.getElementById('phone').value : '',
        location: document.getElementById('location') ? document.getElementById('location').value : '',
        objective: document.getElementById('objective') ? document.getElementById('objective').value : '',
        education: document.getElementById('education') ? document.getElementById('education').value : '',
        experience: document.getElementById('experience') ? document.getElementById('experience').value : '',
        skills: document.getElementById('skills') ? document.getElementById('skills').value : '',
        achievements: document.getElementById('achievements') ? document.getElementById('achievements').value : '',
        language: document.getElementById('language') ? document.getElementById('language').value : '',
        hobbies: document.getElementById('hobbies') ? document.getElementById('hobbies').value : '',
        previous_score: currentMatchScore,
        previous_deficiency: currentDeficiencyScore,
      };

      const triggerBtn = isCorrectionReEval ? btnReEval : btnGetSuggestions;
      const originalBtnHtml = triggerBtn.innerHTML;

      triggerBtn.disabled = true;
      triggerBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Analyzing with AI...';

      fetch(aiUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
      })
      .then(response => {
        if (!response.ok) {
          return response.json().then(err => { throw new Error(err.message || 'AI request failed'); });
        }
        return response.json();
      })
      .then(result => {
        if (!result.success || !result.data) {
          throw new Error(result.message || 'Unable to retrieve AI suggestions.');
        }

        const data = result.data;
        renderAiResults(data);

        // Show panel if hidden
        panel.style.display = 'block';

        // Smooth scroll to panel if initial trigger
        if (!isCorrectionReEval) {
          panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
      })
      .catch(err => {
        console.error('AI Suggestion Error:', err);
        alert('AI Suggestion Notice: ' + err.message);
      })
      .finally(() => {
        triggerBtn.disabled = false;
        triggerBtn.innerHTML = originalBtnHtml;
      });
    }

    function renderAiResults(data) {
      const evalData = data.evaluation || {};
      const jd = data.job_description || {};
      const suggestions = data.section_suggestions || {};
      const deficiencies = data.deficiencies || [];

      const newMatch = evalData.match_score ?? 75;
      const newDeficiency = evalData.deficiency_score ?? (100 - newMatch);
      const scoreDiff = evalData.score_improvement ?? (currentMatchScore !== null ? (newMatch - currentMatchScore) : 0);

      // 1. Update Score & Deficiency displays
      document.getElementById('aiMatchScoreVal').innerText = newMatch + '%';
      document.getElementById('aiMatchProgressBar').style.width = newMatch + '%';
      document.getElementById('aiMatchBadge').innerText = evalData.status_badge || (newMatch >= 80 ? 'Strong Match' : 'Good Match');

      document.getElementById('aiDeficiencyScoreVal').innerText = newDeficiency + '%';
      document.getElementById('aiDeficiencyProgressBar').style.width = newDeficiency + '%';
      document.getElementById('aiDeficiencyBadge').innerText = (evalData.deficiency_level || (newDeficiency > 35 ? 'High' : (newDeficiency > 20 ? 'Moderate' : 'Low'))) + ' Deficiency';

      // 2. Improvement Banner
      const banner = document.getElementById('aiImprovementBanner');
      const titleEl = document.getElementById('aiImprovementTitle');
      const textEl = document.getElementById('aiImprovementText');

      if (currentMatchScore !== null && scoreDiff > 0) {
        titleEl.innerText = `🎉 Resume Improved by +${scoreDiff}%! (Previous: ${currentMatchScore}% → Current: ${newMatch}%)`;
        textEl.innerText = evalData.improvement_summary || `Your latest corrections reduced deficiency gap by ${scoreDiff}%. Keep refining for higher ATS match!`;
        banner.style.display = 'flex';
      } else if (currentMatchScore !== null && scoreDiff === 0) {
        titleEl.innerText = `📊 Current Status: ${newMatch}% Match (${newDeficiency}% Deficiency)`;
        textEl.innerText = evalData.improvement_summary || 'Apply the suggested bullet points and missing skills below to see your score improve!';
        banner.style.display = 'flex';
      } else {
        titleEl.innerText = `✨ Baseline Analysis for ${data.designation || 'Target Role'}: ${newMatch}% Match`;
        textEl.innerText = evalData.improvement_summary || `Currently ${newDeficiency}% deficiency gap against standard job requirements. Make corrections below to improve.`;
        banner.style.display = 'flex';
      }

      // Update current scores for subsequent corrections
      currentMatchScore = newMatch;
      currentDeficiencyScore = newDeficiency;

      // 3. Job Description & Designation sync
      const targetRoleName = jd.title || data.designation || 'Target Designation';
      document.getElementById('jdRoleTitle').innerText = targetRoleName;
      document.getElementById('jdRoleOverview').innerText = jd.overview || '';
      const objRoleEl = document.getElementById('objectiveForRole');
      if (objRoleEl) {
        objRoleEl.innerText = targetRoleName;
      }
      if (designationInput && data.designation && !designationInput.value.trim()) {
        designationInput.value = data.designation;
      }

      const respUl = document.getElementById('jdResponsibilitiesList');
      respUl.innerHTML = '';
      if (jd.key_responsibilities && jd.key_responsibilities.length) {
        jd.key_responsibilities.forEach(r => {
          const li = document.createElement('li');
          li.innerText = r;
          respUl.appendChild(li);
        });
      }

      const skillsBadges = document.getElementById('jdSkillsBadges');
      skillsBadges.innerHTML = '';
      if (jd.required_skills && jd.required_skills.length) {
        jd.required_skills.forEach(s => {
          const span = document.createElement('span');
          span.className = 'badge bg-light text-dark border me-1 mb-1';
          span.style.fontSize = '11px';
          span.innerText = s;
          skillsBadges.appendChild(span);
        });
      }

      // 4. Deficiencies List
      const defContainer = document.getElementById('deficienciesContainer');
      defContainer.innerHTML = '';
      if (deficiencies.length) {
        deficiencies.forEach(d => {
          const item = document.createElement('div');
          item.className = 'deficiency-card-item';
          const sevClass = (d.severity === 'High') ? 'bg-danger' : 'bg-warning text-dark';
          item.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-1">
              <strong>${escapeHtml(d.section || 'Resume')}: ${escapeHtml(d.issue || '')}</strong>
              <span class="badge ${sevClass}" style="font-size: 10px;">${escapeHtml(d.severity || 'Gap')}</span>
            </div>
            <div style="font-size: 12px; color: #475569;">
              💡 <em>Fix:</em> ${escapeHtml(d.recommendation || '')}
            </div>
          `;
          defContainer.appendChild(item);
        });
      } else {
        defContainer.innerHTML = '<div class="text-success p-2" style="font-size: 13px;"><i class="fa fa-check-circle me-1"></i> No major deficiencies detected! Your resume aligns very well with this job role.</div>';
      }

      // 5. Section Suggestions
      if (suggestions.suggested_objective) {
        document.getElementById('suggestedObjectiveText').innerText = suggestions.suggested_objective;
      }

      const missingSkillsBox = document.getElementById('missingSkillsContainer');
      missingSkillsBox.innerHTML = '';
      if (suggestions.missing_skills_to_add && suggestions.missing_skills_to_add.length) {
        suggestions.missing_skills_to_add.forEach(sk => {
          const pill = document.createElement('span');
          pill.className = 'suggestion-pill';
          pill.innerText = '+ ' + sk;
          pill.onclick = () => appendSingleSkill(sk);
          missingSkillsBox.appendChild(pill);
        });
      } else {
        missingSkillsBox.innerHTML = '<span class="text-muted" style="font-size: 12px;">All essential skills are already present!</span>';
      }

      if (suggestions.experience_enhancements && suggestions.experience_enhancements.length) {
        document.getElementById('experienceEnhancementsList').innerText = suggestions.experience_enhancements.join('\n');
      }
    }

    function escapeHtml(str) {
      if (!str) return '';
      return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
    }

    // Quick Apply Actions
    document.getElementById('btnApplyObjective').addEventListener('click', function () {
      const objText = document.getElementById('suggestedObjectiveText').innerText.trim();
      const objInput = document.getElementById('objective');
      if (objText && objInput) {
        objInput.value = objText;
        flashElement(objInput);
      }
    });

    document.getElementById('btnAddAllSkills').addEventListener('click', function () {
      const skillsInput = document.getElementById('skills');
      if (!skillsInput) return;

      const pills = document.querySelectorAll('#missingSkillsContainer .suggestion-pill');
      const newSkills = [];
      pills.forEach(p => {
        const text = p.innerText.replace(/^\+\s*/, '').trim();
        if (text) newSkills.push(text);
      });

      if (newSkills.length) {
        let current = skillsInput.value.trim();
        if (current && !current.endsWith(',')) current += ', ';
        skillsInput.value = current + newSkills.join(', ');
        flashElement(skillsInput);
      }
    });

    window.appendSingleSkill = function (skill) {
      const skillsInput = document.getElementById('skills');
      if (!skillsInput) return;

      let current = skillsInput.value.trim();
      if (current.toLowerCase().includes(skill.toLowerCase())) {
        alert(`Skill "${skill}" is already present.`);
        return;
      }
      if (current && !current.endsWith(',')) current += ', ';
      skillsInput.value = current + skill;
      flashElement(skillsInput);
    };

    document.getElementById('btnAppendExperience').addEventListener('click', function () {
      const expInput = document.getElementById('experience');
      const expList = document.getElementById('experienceEnhancementsList').innerText.trim();
      if (expInput && expList) {
        let current = expInput.value.trim();
        if (current) current += '\n\n';
        expInput.value = current + expList;
        flashElement(expInput);
      }
    });

    function flashElement(el) {
      el.classList.add('flash-highlight');
      setTimeout(() => el.classList.remove('flash-highlight'), 1500);
      el.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Event listeners for buttons
    if (btnGetSuggestions) {
      btnGetSuggestions.addEventListener('click', () => runAiAnalysis(false));
    }
    if (btnReEval) {
      btnReEval.addEventListener('click', () => runAiAnalysis(true));
    }
  });
</script>
@endif

@endsection
