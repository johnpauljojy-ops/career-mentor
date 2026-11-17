@extends('layouts.templatemaster')

@section('content')

<style>
  /* =========================================================
     CAREER MENTOR - RECOMMENDATIONS PAGE STYLES
  ========================================================= */

  .cm-page {
    font-family: 'Poppins', sans-serif;
    background: #f8fafc;
    color: #0f172a;
  }

  /* Hero Banner */
  .cm-rec-hero {
    position: relative;
    background: linear-gradient(135deg, #070f19 0%, #0f172a 60%, #1e293b 100%);
    color: #ffffff;
    padding-top: 160px;
    padding-bottom: 45px;
    min-height: 440px;
    overflow: hidden;
    display: flex;
    align-items: center;
  }

  .cm-rec-hero::after {
    content: "";
    position: absolute;
    width: 400px;
    height: 400px;
    right: -100px;
    top: -100px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, transparent 70%);
    pointer-events: none;
  }

  .cm-rec-tag {
    display: inline-block;
    margin-bottom: 18px;
    padding: 7px 18px;
    border: 1px solid rgba(34, 197, 94, 0.5);
    border-radius: 50px;
    background: rgba(34, 197, 94, 0.14);
    color: #4ade80;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
  }

  .cm-rec-hero h1 {
    font-size: 44px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 16px;
  }

  .cm-rec-hero h1 span {
    color: #22c55e;
  }

  .cm-rec-hero p.cm-hero-sub {
    font-size: 15.5px;
    color: #cbd5e1;
    max-width: 780px;
    line-height: 1.75;
    margin-bottom: 24px;
  }

  /* Profile Summary Bar inside Hero */
  .cm-profile-summary-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 16px 24px;
    max-width: 920px;
  }

  .cm-summary-pill {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    color: #e2e8f0;
  }

  .cm-summary-pill strong {
    color: #4ade80;
  }

  /* =========================================================
     TAB SWITCHER (pill toggle, like the Barcode / QR Code UI)
  ========================================================= */

  .cm-tab-switcher-wrap {
    background: #f8fafc;
    padding: 36px 0 0;
  }

  .cm-tab-switcher {
    max-width: 560px;
    margin: 0 auto;
    display: flex;
    gap: 6px;
    background: #e2e8f0;
    border-radius: 14px;
    padding: 6px;
  }

  .cm-tab-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    padding: 13px 18px;
    border: none;
    border-radius: 10px;
    background: transparent;
    color: #64748b;
    font-family: 'Poppins', sans-serif;
    font-size: 14.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .cm-tab-btn .cm-tab-icon {
    font-size: 17px;
  }

  .cm-tab-btn.active {
    background: #ffffff;
    color: #0f172a;
    box-shadow: 0 3px 10px rgba(15, 23, 42, 0.12);
  }

  .cm-tab-btn.active.cm-tab-job {
    color: #15803d;
  }

  .cm-tab-btn.active.cm-tab-study {
    color: #1d4ed8;
  }

  .cm-tab-btn:hover:not(.active) {
    color: #334155;
  }

  @media (max-width: 480px) {

    .cm-tab-btn {
      font-size: 13px;
      padding: 12px 10px;
    }

    .cm-tab-btn .cm-tab-icon {
      font-size: 15px;
    }
  }

  /* Tab panels */
  .cm-tab-panel {
    display: none;
  }

  .cm-tab-panel.active {
    display: block;
  }

  /* Sections */
  .cm-section {
    padding: 50px 0 75px;
  }

  .cm-section-light {
    background: #f8fafc;
  }

  .cm-section-white {
    background: #ffffff;
  }

  .cm-section-heading {
    max-width: 760px;
    margin: 0 auto 45px;
    text-align: center;
  }

  .cm-section-label {
    display: inline-block;
    margin-bottom: 8px;
    color: #16a34a;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
  }

  .cm-section-heading h2 {
    margin: 0 0 12px;
    color: #0f172a;
    font-size: 32px;
    font-weight: 700;
  }

  .cm-section-heading p {
    margin: 0;
    color: #64748b;
    font-size: 14px;
    line-height: 1.8;
  }

  /* =========================================================
     4-ITEM COMPACT PREVIEW CARDS
  ========================================================= */
  .cm-preview-card {
    height: 100%;
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .cm-preview-card:hover {
    transform: translateY(-6px);
    border-color: #22c55e;
    box-shadow: 0 16px 36px rgba(34, 197, 94, 0.12);
  }

  .cm-card-top-bar {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 14px;
  }

  .cm-card-icon-box {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
  }

  .cm-rec-badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .cm-badge-high {
    background: #dcfce7;
    color: #15803d;
  }

  .cm-badge-study {
    background: #eff6ff;
    color: #1d4ed8;
  }

  /* 1. Title */
  .cm-preview-card h3 {
    font-size: 19px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
    line-height: 1.35;
  }

  /* 2. Degree / Specialization Highlight */
  .cm-fit-highlight {
    font-size: 12px;
    font-weight: 600;
    color: #15803d;
    background: #f0fdf4;
    padding: 4px 10px;
    border-radius: 6px;
    border: 1px solid #bbf7d0;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 14px;
  }

  .cm-study-highlight {
    font-size: 12px;
    font-weight: 600;
    color: #1d4ed8;
    background: #eff6ff;
    padding: 4px 10px;
    border-radius: 6px;
    border: 1px solid #bfdbfe;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 14px;
  }

  /* 3. Core Highlights / Skills Pills */
  .cm-preview-pill-list {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 16px;
  }

  .cm-preview-pill {
    background: #f1f5f9;
    color: #334155;
    padding: 4px 9px;
    border-radius: 6px;
    font-size: 11.5px;
    font-weight: 500;
  }

  /* 4. Bottom Metadata */
  .cm-preview-meta {
    border-top: 1px solid #f1f5f9;
    padding-top: 12px;
    margin-top: 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 12px;
    color: #64748b;
  }

  .cm-preview-meta strong {
    color: #0f172a;
  }

  /* View Button on Card */
  .cm-view-btn {
    margin-top: 14px;
    padding: 10px 14px;
    border-radius: 8px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 12.5px;
    font-weight: 600;
    color: #15803d;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .cm-preview-card:hover .cm-view-btn {
    background: #16a34a;
    border-color: #16a34a;
    color: #ffffff;
  }

  .cm-view-btn-blue {
    background: #eff6ff;
    border-color: #bfdbfe;
    color: #1d4ed8;
  }

  .cm-preview-card:hover .cm-view-btn-blue {
    background: #2563eb;
    border-color: #2563eb;
    color: #ffffff;
  }

  /* =========================================================
     STANDALONE ENLARGED POPUP / MODAL (Guaranteed to work)
  ========================================================= */
  .cm-popup-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.75);
    backdrop-filter: blur(6px);
    z-index: 99999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    transition: opacity 0.25s ease;
  }

  .cm-popup-backdrop.active {
    display: flex;
    opacity: 1;
  }

  .cm-popup-card {
    background: #ffffff;
    width: 100%;
    max-width: 680px;
    max-height: 90vh;
    border-radius: 20px;
    overflow-y: auto;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
    position: relative;
    transform: scale(0.92);
    transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  .cm-popup-backdrop.active .cm-popup-card {
    transform: scale(1);
  }

  .cm-popup-header {
    background: linear-gradient(135deg, #0f172a, #1e293b);
    color: #ffffff;
    padding: 24px 28px;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 10;
  }

  .cm-popup-header h4 {
    margin: 0 0 6px;
    color: #ffffff;
    font-size: 22px;
    font-weight: 700;
  }

  .cm-popup-close {
    background: rgba(255, 255, 255, 0.15);
    border: none;
    color: #ffffff;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    cursor: pointer;
    transition: background 0.2s;
    flex-shrink: 0;
  }

  .cm-popup-close:hover {
    background: rgba(239, 68, 68, 0.85);
    color: #ffffff;
  }

  .cm-popup-body {
    padding: 28px;
    background: #ffffff;
  }

  .cm-detail-block {
    margin-bottom: 22px;
  }

  .cm-detail-block:last-child {
    margin-bottom: 0;
  }

  .cm-detail-title {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #16a34a;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .cm-detail-text {
    font-size: 14.5px;
    line-height: 1.75;
    color: #334155;
    background: #f8fafc;
    padding: 14px 16px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    margin: 0;
  }

  .cm-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  .cm-info-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 12px 16px;
    border-radius: 10px;
  }

  .cm-info-box span {
    font-size: 11.5px;
    color: #64748b;
    display: block;
    margin-bottom: 3px;
  }

  .cm-info-box strong {
    font-size: 14px;
    color: #0f172a;
  }

  .cm-popup-footer {
    padding: 18px 28px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    position: sticky;
    bottom: 0;
    z-index: 10;
  }

  .cm-btn-secondary {
    padding: 10px 20px;
    border-radius: 8px;
    background: #e2e8f0;
    color: #475569;
    border: none;
    font-weight: 600;
    font-size: 13.5px;
    cursor: pointer;
    transition: background 0.2s;
  }

  .cm-btn-secondary:hover {
    background: #cbd5e1;
    color: #1e293b;
  }

  .cm-btn-action {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    border-radius: 8px;
    background: #2563eb;
    color: #ffffff !important;
    text-decoration: none !important;
    font-weight: 600;
    font-size: 13.5px;
    border: none;
    transition: background 0.2s;
  }

  .cm-btn-action:hover {
    background: #1d4ed8;
  }

  .cm-btn-action-green {
    background: #16a34a;
  }

  .cm-btn-action-green:hover {
    background: #15803d;
  }

  /* Resume CTA Banner (Bottom) */
  .cm-resume-banner {
    position: relative;
    overflow: hidden;
    padding: 45px;
    border-radius: 17px;
    background: linear-gradient(135deg, #0f172a, #1e293b);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
  }

  .cm-resume-banner h2 {
    color: #ffffff;
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 8px;
  }

  .cm-resume-banner p {
    color: #cbd5e1;
    font-size: 14px;
    line-height: 1.7;
    margin: 0;
  }

  .cm-resume-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border-radius: 8px;
    background: #22c55e;
    color: #ffffff !important;
    text-decoration: none !important;
    font-size: 14px;
    font-weight: 600;
    transition: background 0.2s ease;
  }

  .cm-resume-button:hover {
    background: #16a34a;
  }

  @media (max-width: 768px) {
    .cm-rec-hero {
      padding-top: 125px;
      padding-bottom: 60px;
      min-height: auto;
    }
    .cm-rec-hero h1 {
      font-size: 32px;
    }
    .cm-grid-2 {
      grid-template-columns: 1fr;
    }
  }
</style>

<div class="cm-page">

  <!-- =====================================================
       HERO BANNER (AI ANALYSIS REPORT)
  ====================================================== -->
  <section class="cm-rec-hero">
    <div class="container">
      
      <span class="cm-rec-tag">🤖 AI-POWERED ANALYSIS REPORT</span>
      <h1>
        Your Personalized <span>Recommendations</span>
      </h1>
      
      <p class="cm-hero-sub">
        
          Based on your academic performance, identified skills, and future aspirations,
          here are targeted career directions and higher education pathways curated for you by AI assistance.
        
      </p>

      <!-- Profile Summary Snippet -->
      <div class="cm-profile-summary-bar">
        <div class="cm-summary-pill">
          <span>🎯 Career Goal:</span>
          <strong>{{ $student->carrergoal ?? $profile->carrergoal ?? 'Not specified' }}</strong>
        </div>

        <div class="cm-summary-pill">
          <span>🎓 Qualification:</span>
          <strong>
            {{ $student->qualification->qualification_name ?? $profile->qualification_name ?? 'Undergraduate' }}
            @if(!empty($student->branch->branch_name ?? $profile->branch_name))
              ({{ $student->branch->branch_name ?? $profile->branch_name }})
            @endif
          </strong>
        </div>

        

        <div class="cm-summary-pill">
          <span>💡 Skills:</span>
          <strong>
            @if(!empty($skills) && count($skills) > 0)
              {{ implode(', ', $skills) }}
            @else
              Profile Skills
            @endif
          </strong>
        </div>
      </div>
    </div>
  </section>

  <!-- =====================================================
       TAB SWITCHER — choose which recommendations to view
  ====================================================== -->
  <div class="cm-tab-switcher-wrap">
    <div class="container">
      <div class="cm-tab-switcher">

        <button
          type="button"
          id="tabBtnCareers"
          class="cm-tab-btn cm-tab-job active"
          onclick="switchRecTab('careers')"
        >
          <span class="cm-tab-icon">💼</span>
          Job Recommendations
        </button>

        <button
          type="button"
          id="tabBtnStudies"
          class="cm-tab-btn cm-tab-study"
          onclick="switchRecTab('higher-studies')"
        >
          <span class="cm-tab-icon">🎓</span>
          Higher Studies
        </button>

      </div>
    </div>
  </div>

  <!-- =====================================================
       SECTION 1: CAREER RECOMMENDATIONS (4-ITEM CARDS)
  ====================================================== -->
  <section class="cm-section cm-section-light cm-tab-panel active" id="careers">
    <div class="container">
      
      <div class="cm-section-heading">
        <span class="cm-section-label">RECOMMENDED CAREER PATHS</span>
        <h2>Top Job Roles Matching Your Profile</h2>
        <p>
          Click on any card or view button to view complete details, qualification alignment, and full guidance.
        </p>
      </div>

      <div class="row g-4">
        @if(!empty($recommendations['job_options']))
          @foreach($recommendations['job_options'] as $index => $job)
            <div class="col-lg-4 col-md-6">
              
              <!-- 4-Item Compact Card -->
              <div class="cm-preview-card" onclick="openPopup('jobPopup{{ $index }}')">
                
                <div>
                  <!-- Top Bar: Icon & Match Score -->
                  <div class="cm-card-top-bar">
                    <div class="cm-card-icon-box" style="background:#f0fdf4;">{{ $job['icon'] ?? '💻' }}</div>
                    <span class="cm-rec-badge cm-badge-high">
                      {{ $job['badge'] ?? (($job['match_score'] ?? '90') . '% Match') }}
                    </span>
                  </div>

                  <!-- 1. Role Title -->
                  <h3>{{ $job['job_role'] ?? 'Job Title' }}</h3>

                  <!-- 2. Degree Fit Highlight -->
                  @if(!empty($job['qualification_fit']))
                    <div class="cm-fit-highlight">
                      <span>🎓</span> {{ $job['qualification_fit'] }}
                    </div>
                  @endif

                  <!-- 3. Key Skills Preview (Top 3-4 items) -->
                  @if(!empty($job['skills']) && is_array($job['skills']))
                    <div class="cm-preview-pill-list">
                      @foreach(array_slice($job['skills'], 0, 4) as $skillItem)
                        <span class="cm-preview-pill">{{ $skillItem }}</span>
                      @endforeach
                    </div>
                  @endif
                </div>

                <div>
                  <!-- 4. Compensation & Market Demand -->
                  <div class="cm-preview-meta">
                    <span>Avg Salary: <strong>{{ $job['avg_salary'] ?? 'Competitive' }}</strong></span>
                    <span>Demand: <strong style="color: #16a34a;">{{ $job['demand'] ?? 'High' }}</strong></span>
                  </div>

                  <!-- View Details Button -->
                  <div class="cm-view-btn">
                    <span>View Full Details & Guidance</span>
                    <span>→</span>
                  </div>
                </div>

              </div>
            </div>

            <!-- Standalone Full Details Popup for Job Role -->
            <div id="jobPopup{{ $index }}" class="cm-popup-backdrop" onclick="handleBackdropClick(event, 'jobPopup{{ $index }}')">
              <div class="cm-popup-card">
                
                <div class="cm-popup-header">
                  <div>
                    <div class="cm-rec-badge cm-badge-high" style="margin-bottom: 8px;">
                      {{ $job['badge'] ?? (($job['match_score'] ?? '90') . '% Match') }}
                    </div>
                    <h4>{{ $job['icon'] ?? '💻' }} {{ $job['job_role'] ?? 'Job Role' }}</h4>
                    <small style="color: #94a3b8;">Career Option for {{ $student->qualification->qualification_name ?? 'Graduate' }} ({{ $student->branch->branch_name ?? 'Specialization' }})</small>
                  </div>
                  <button type="button" class="cm-popup-close" onclick="closePopup('jobPopup{{ $index }}')" title="Close">✕</button>
                </div>

                <div class="cm-popup-body">
                  
                  @if(!empty($job['qualification_fit']))
                    <div class="cm-detail-block">
                      <div class="cm-detail-title">
                        <span>🎓</span> Qualification & Degree Alignment
                      </div>
                      <p class="cm-detail-text" style="background:#f0fdf4; border-color:#bbf7d0; color:#15803d; font-weight: 500;">
                        {{ $job['qualification_fit'] }}
                      </p>
                    </div>
                  @endif

                  <div class="cm-detail-block">
                    <div class="cm-detail-title">
                      <span>📋</span> AI Role Analysis & Guidance Rationale
                    </div>
                    <p class="cm-detail-text">
                      {{ $job['description'] ?? 'This role aligns with your academic qualification, demonstrated skills, and career path.' }}
                    </p>
                  </div>

                  @if(!empty($job['skills']) && is_array($job['skills']))
                    <div class="cm-detail-block">
                      <div class="cm-detail-title">
                        <span>🛠️</span> Required & Matching Core Skills
                      </div>
                      <div class="cm-preview-pill-list">
                        @foreach($job['skills'] as $skillItem)
                          <span class="cm-preview-pill" style="font-size: 12.5px; padding: 5px 12px; background: #e2e8f0; color: #1e293b; font-weight: 600;">
                            ✓ {{ $skillItem }}
                          </span>
                        @endforeach
                      </div>
                    </div>
                  @endif

                  <div class="cm-detail-block">
                    <div class="cm-detail-title">
                      <span>📊</span> Market Compensation & Outlook
                    </div>
                    <div class="cm-grid-2">
                      <div class="cm-info-box">
                        <span>Expected Average Salary</span>
                        <strong>{{ $job['avg_salary'] ?? 'Competitive' }}</strong>
                      </div>
                      <div class="cm-info-box">
                        <span>Market Demand</span>
                        <strong style="color: #16a34a;">{{ $job['demand'] ?? 'High' }}</strong>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="cm-popup-footer">
                  <button type="button" class="cm-btn-secondary" onclick="closePopup('jobPopup{{ $index }}')">Close</button>
                  <a href="{{ route('student.resume.template1') }}" class="cm-btn-action">
                    <span>Build Resume For This Role</span>
                    <span>→</span>
                  </a>
                </div>

              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </section>

  <!-- =====================================================
       SECTION 2: HIGHER STUDIES (4-ITEM CARDS)
  ====================================================== -->
  <section class="cm-section cm-section-white cm-tab-panel" id="higher-studies">
    <div class="container">
      
      <div class="cm-section-heading">
        <span class="cm-section-label">ACADEMIC ADVANCEMENT</span>
        <h2>Higher Studies & Academic Pathways</h2>
        <p>
          Click on any academic card or view button to explore complete eligibility, prerequisites, and entrance exams.
        </p>
      </div>

      <div class="row g-4">
        @if(!empty($recommendations['higher_studies']))
          @foreach($recommendations['higher_studies'] as $sIndex => $study)
            <div class="col-lg-4 col-md-6">
              
              <!-- 4-Item Compact Card -->
              <div class="cm-preview-card" onclick="openPopup('studyPopup{{ $sIndex }}')">
                
                <div>
                  <!-- Top Bar: Icon & Badge -->
                  <div class="cm-card-top-bar">
                    <div class="cm-card-icon-box" style="background:#eff6ff;">{{ $study['icon'] ?? '🎓' }}</div>
                    <span class="cm-rec-badge cm-badge-study">
                      {{ $study['badge'] ?? 'Top Choice' }}
                    </span>
                  </div>

                  <!-- 1. Program Name -->
                  <h3>{{ $study['program_name'] ?? 'Degree Program' }}</h3>

                  <!-- 2. Specialization Highlight -->
                  @if(!empty($study['specialization']))
                    <div class="cm-study-highlight">
                      <span>📘</span> {{ $study['specialization'] }}
                    </div>
                  @endif

                  <!-- 3. Duration & University Highlights -->
                  @if(!empty($study['skills_or_duration']) && is_array($study['skills_or_duration']))
                    <div class="cm-preview-pill-list">
                      @foreach($study['skills_or_duration'] as $tag)
                        <span class="cm-preview-pill">{{ $tag }}</span>
                      @endforeach
                    </div>
                  @endif
                </div>

                <div>
                  <!-- 4. Eligibility & Entrance Exam -->
                  <div class="cm-preview-meta">
                    <span>Eligibility: <strong>{{ Str::limit($study['eligibility'] ?? 'Bachelor Degree', 22) }}</strong></span>
                    <span>Exam: <strong style="color: #2563eb;">{{ Str::limit($study['exam'] ?? 'Entrance', 16) }}</strong></span>
                  </div>

                  <!-- View Button -->
                  <div class="cm-view-btn cm-view-btn-blue">
                    <span>View Academic Progression</span>
                    <span>→</span>
                  </div>
                </div>

              </div>
            </div>

            <!-- Standalone Full Details Popup for Higher Study -->
            <div id="studyPopup{{ $sIndex }}" class="cm-popup-backdrop" onclick="handleBackdropClick(event, 'studyPopup{{ $sIndex }}')">
              <div class="cm-popup-card">
                
                <div class="cm-popup-header" style="background: linear-gradient(135deg, #1e1b4b, #1e293b);">
                  <div>
                    <div class="cm-rec-badge cm-badge-study" style="margin-bottom: 8px;">
                      {{ $study['badge'] ?? 'Top Choice' }}
                    </div>
                    <h4>{{ $study['icon'] ?? '🎓' }} {{ $study['program_name'] ?? 'Degree Program' }}</h4>
                    @if(!empty($study['specialization']))
                      <small style="color: #93c5fd; font-weight: 500;">Specialization: {{ $study['specialization'] }}</small>
                    @endif
                  </div>
                  <button type="button" class="cm-popup-close" onclick="closePopup('studyPopup{{ $sIndex }}')" title="Close">✕</button>
                </div>

                <div class="cm-popup-body">
                  
                  <div class="cm-detail-block">
                    <div class="cm-detail-title" style="color: #2563eb;">
                      <span>🎓</span> Academic Progression & Guidance
                    </div>
                    <p class="cm-detail-text">
                      {{ $study['description'] ?? 'This postgraduate program is designed to build on your undergraduate degree and prepare you for specialized positions.' }}
                    </p>
                  </div>

                  <div class="cm-detail-block">
                    <div class="cm-detail-title" style="color: #2563eb;">
                      <span>📋</span> Degree Eligibility & Prerequisites
                    </div>
                    <p class="cm-detail-text" style="background:#eff6ff; border-color:#bfdbfe; color:#1d4ed8; font-weight: 500;">
                      {{ $study['eligibility'] ?? 'Graduation with relevant academic foundation' }}
                    </p>
                  </div>

                  <div class="cm-detail-block">
                    <div class="cm-detail-title" style="color: #2563eb;">
                      <span>📝</span> Required Entrance Exams & Preparation
                    </div>
                    <p class="cm-detail-text" style="background:#f8fafc; border-color:#e2e8f0; color:#0f172a; font-weight: 600;">
                      {{ $study['exam'] ?? 'Entrance Exam or Direct Entry depending on institution' }}
                    </p>
                  </div>

                  @if(!empty($study['skills_or_duration']) && is_array($study['skills_or_duration']))
                    <div class="cm-detail-block">
                      <div class="cm-detail-title" style="color: #2563eb;">
                        <span>⏱️</span> Program Highlights & Scope
                      </div>
                      <div class="cm-preview-pill-list">
                        @foreach($study['skills_or_duration'] as $tag)
                          <span class="cm-preview-pill" style="font-size: 12.5px; padding: 5px 12px; background: #e0e7ff; color: #3730a3; font-weight: 600;">
                            ★ {{ $tag }}
                          </span>
                        @endforeach
                      </div>
                    </div>
                  @endif

                </div>

                <div class="cm-popup-footer">
                  <button type="button" class="cm-btn-secondary" onclick="closePopup('studyPopup{{ $sIndex }}')">Close</button>
                  <a href="{{ route('student.profile') }}" class="cm-btn-action cm-btn-action-green">
                    <span>Update Profile & Goals</span>
                    <span>→</span>
                  </a>
                </div>

              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </section>



</div>

<!-- =========================================================
     VANILLA JS POPUP + TAB CONTROLLER (No external dependencies)
========================================================= -->
<script>
  function openPopup(popupId) {
    const popup = document.getElementById(popupId);
    if (!popup) return;
    popup.classList.add('active');
    document.body.style.overflow = 'hidden'; // Lock background scroll
  }

  function closePopup(popupId) {
    const popup = document.getElementById(popupId);
    if (!popup) return;
    popup.classList.remove('active');
    document.body.style.overflow = ''; // Restore background scroll
  }

  function handleBackdropClick(event, popupId) {
    // If the click happened on the backdrop itself (not inside the card)
    if (event.target.id === popupId) {
      closePopup(popupId);
    }
  }

  // Close popup with Escape key
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' || event.keyCode === 27) {
      const activePopups = document.querySelectorAll('.cm-popup-backdrop.active');
      activePopups.forEach(popup => {
        popup.classList.remove('active');
      });
      document.body.style.overflow = '';
    }
  });

  /*
  |--------------------------------------------------------------------------
  | Recommendations Tab Switcher (Job Recommendations / Higher Studies)
  |--------------------------------------------------------------------------
  */
  function switchRecTab(tabId) {

    // Toggle panels
    document.querySelectorAll('.cm-tab-panel').forEach(function (panel) {
      panel.classList.toggle('active', panel.id === tabId);
    });

    // Toggle button states
    document.getElementById('tabBtnCareers').classList.toggle('active', tabId === 'careers');
    document.getElementById('tabBtnStudies').classList.toggle('active', tabId === 'higher-studies');
  }

  // Lock browser back navigation
  (function () {
    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function () {
      window.history.pushState(null, "", window.location.href);
    };
  })();
</script>

@endsection