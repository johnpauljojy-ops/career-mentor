@extends('layouts.studentmaster')

@section('content')

  <style>
    /* =========================================================
     CAREER MENTOR HOMEPAGE
  ========================================================= */

    .cm-page {
      font-family: 'Poppins', sans-serif;
      background: #f8fafc;
      color: #0f172a;
    }


    /* =========================================================
     HERO
  ========================================================= */

    .cm-hero {
      position: relative;
      min-height: 620px;
      overflow: hidden;
      display: flex;
      align-items: center;
    }

    .cm-hero video {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .cm-hero-overlay {
      position: absolute;
      inset: 0;
      background:
        linear-gradient(90deg,
          rgba(7, 15, 25, 0.94) 0%,
          rgba(7, 15, 25, 0.82) 42%,
          rgba(7, 15, 25, 0.55) 100%);
    }

    .cm-hero-content {
      position: relative;
      z-index: 2;
      width: 100%;
      padding: 80px 0;
    }

    /* Pushes all hero contents (left text & right panel) safely below the header */
    .cm-hero-content {
      position: relative;
      z-index: 2;
      width: 100%;
      padding-top: 160px;   /* Clears the header with a clean margin */
      padding-bottom: 60px;
    }

    .cm-hero-text {
      max-width: 700px;
    }

    .cm-hero-tag {
      display: inline-block;
      margin-bottom: 22px;
      padding: 8px 16px;
      border: 1px solid rgba(34, 197, 94, 0.5);
      border-radius: 50px;
      background: rgba(34, 197, 94, 0.12);
      color: #4ade80;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 1px;
    }

    .cm-hero h1 {
      margin: 0 0 22px;
      color: #ffffff;
      font-size: 56px;
      line-height: 1.1;
      font-weight: 700;
    }

    .cm-hero h1 span {
      color: #22c55e;
    }

    .cm-hero-description {
      max-width: 650px;
      margin-bottom: 32px;
      color: #dbe4ee;
      font-size: 16px;
      line-height: 1.8;
    }

    .cm-hero-buttons {
      display: flex;
      flex-wrap: wrap;
      gap: 13px;
    }

    .cm-btn-primary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 13px 23px;
      border-radius: 7px;
      background: #ef4444;
      color: #ffffff !important;
      text-decoration: none !important;
      font-size: 14px;
      font-weight: 600;
      transition: .2s ease;
    }

    .cm-btn-primary:hover {
      background: #dc2626;
      color: #ffffff !important;
      transform: translateY(-2px);
    }

    .cm-btn-outline {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 12px 23px;
      border: 1px solid rgba(255, 255, 255, .45);
      border-radius: 7px;
      background: rgba(255, 255, 255, .06);
      color: #ffffff !important;
      text-decoration: none !important;
      font-size: 14px;
      font-weight: 600;
      transition: .2s ease;
    }

    .cm-btn-outline:hover {
      background: rgba(255, 255, 255, .14);
      color: #ffffff !important;
    }


    /* =========================================================
     HERO SIDE PANEL
  ========================================================= */

    .cm-hero-panel {
      padding: 28px;
      border: 1px solid rgba(255, 255, 255, .22);
      border-radius: 17px;
      background: rgba(15, 23, 42, .67);
      backdrop-filter: blur(10px);
      box-shadow: 0 20px 50px rgba(0, 0, 0, .20);
    }

    .cm-hero-panel-title {
      margin-bottom: 23px;
      color: #ffffff;
      font-size: 19px;
      font-weight: 700;
    }

    .cm-hero-feature {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 14px 0;
      border-bottom: 1px solid rgba(255, 255, 255, .09);
    }

    .cm-hero-feature:last-child {
      border-bottom: 0;
      padding-bottom: 0;
    }

    .cm-hero-feature:first-of-type {
      padding-top: 0;
    }

    .cm-feature-icon-small {
      width: 43px;
      height: 43px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      background: rgba(34, 197, 94, .16);
      font-size: 19px;
    }

    .cm-hero-feature h4 {
      margin: 0 0 3px;
      color: #ffffff;
      font-size: 14px;
      font-weight: 600;
    }

    .cm-hero-feature p {
      margin: 0;
      color: #aebdcd;
      font-size: 11px;
    }


    /* =========================================================
     PROFILE COMPLETION
  ========================================================= */

    .cm-profile-section {
      padding: 55px 0;
      background: #ffffff;
    }

    .cm-profile-card {
      padding: 30px 34px;
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      background: #ffffff;
      box-shadow: 0 8px 30px rgba(15, 23, 42, .06);
    }

    .cm-profile-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 25px;
    }

    .cm-profile-label {
      margin-bottom: 7px;
      color: #16a34a;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1px;
    }

    .cm-profile-header h2 {
      margin: 0 0 6px;
      color: #0f172a;
      font-size: 25px;
      font-weight: 700;
    }

    .cm-profile-header p {
      margin: 0;
      color: #64748b;
      font-size: 13px;
    }

    .cm-profile-percentage {
      color: #16a34a;
      font-size: 34px;
      font-weight: 700;
    }

    .cm-progress-track {
      width: 100%;
      height: 9px;
      margin-top: 23px;
      overflow: hidden;
      border-radius: 20px;
      background: #e2e8f0;
    }

    .cm-progress-bar {
      height: 100%;
      border-radius: 20px;
      background: linear-gradient(90deg,
          #16a34a,
          #22c55e);
      transition: width .4s ease;
    }

    .cm-profile-info {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      margin-top: 17px;
    }

    .cm-profile-info p {
      margin: 0;
      color: #64748b;
      font-size: 13px;
    }

    .cm-profile-link {
      white-space: nowrap;
      color: #16a34a !important;
      text-decoration: none !important;
      font-size: 13px;
      font-weight: 600;
    }

    .cm-profile-link:hover {
      color: #15803d !important;
    }


    /* =========================================================
     COMMON SECTION
  ========================================================= */

    .cm-section {
      padding: 80px 0;
    }

    .cm-section-light {
      background: #f8fafc;
    }

    .cm-section-white {
      background: #ffffff;
    }

    .cm-section-heading {
      max-width: 720px;
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
      font-size: 34px;
      line-height: 1.2;
      font-weight: 700;
    }

    .cm-section-heading p {
      margin: 0;
      color: #64748b;
      font-size: 14px;
      line-height: 1.8;
    }


    /* =========================================================
     FEATURES
  ========================================================= */

    .cm-feature-card {
      height: 100%;
      padding: 28px 25px;
      border: 1px solid #e2e8f0;
      border-radius: 13px;
      background: #ffffff;
      transition: .2s ease;
    }

    .cm-feature-card:hover {
      transform: translateY(-5px);
      border-color: #bbf7d0;
      box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
    }

    .cm-feature-card-icon {
      width: 51px;
      height: 51px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 19px;
      border-radius: 11px;
      background: #f0fdf4;
      font-size: 23px;
    }

    .cm-feature-card h3 {
      margin: 0 0 9px;
      color: #0f172a;
      font-size: 18px;
      font-weight: 700;
    }

    .cm-feature-card p {
      margin: 0;
      color: #64748b;
      font-size: 13px;
      line-height: 1.75;
    }


    /* =========================================================
     RECOMMENDATION SECTION
  ========================================================= */

    .cm-recommend-card {
      height: 100%;
      padding: 32px;
      border: 1px solid #e2e8f0;
      border-radius: 15px;
      background: #ffffff;
      box-shadow: 0 5px 20px rgba(15, 23, 42, .05);
    }

    .cm-recommend-icon {
      width: 53px;
      height: 53px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      border-radius: 12px;
      background: #eff6ff;
      font-size: 24px;
    }

    .cm-recommend-card h3 {
      margin: 0 0 10px;
      color: #0f172a;
      font-size: 21px;
      font-weight: 700;
    }

    .cm-recommend-card p {
      min-height: 48px;
      margin: 0 0 22px;
      color: #64748b;
      font-size: 13px;
      line-height: 1.75;
    }

    .cm-recommend-button {
      display: inline-flex;
      padding: 11px 20px;
      border-radius: 6px;
      background: #16a34a;
      color: #ffffff !important;
      text-decoration: none !important;
      font-size: 13px;
      font-weight: 600;
    }

    .cm-recommend-button:hover {
      background: #15803d;
    }

    .cm-recommend-button-disabled {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 11px 20px;
      border-radius: 6px;
      background: #cbd5e1;
      color: #64748b !important;
      font-size: 13px;
      font-weight: 600;
      cursor: not-allowed;
      opacity: .9;
    }

    .cm-recommend-status {
      margin-top: 13px;
      color: #dc2626;
      font-size: 12px;
      font-weight: 500;
    }


    /* =========================================================
     HOW IT WORKS
  ========================================================= */

    .cm-process {
      position: relative;
    }

    .cm-process-card {
      height: 100%;
      padding: 10px 20px;
      text-align: center;
    }

    .cm-process-number {
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 18px;
      border-radius: 50%;
      background: #16a34a;
      color: #ffffff;
      font-size: 16px;
      font-weight: 700;
    }

    .cm-process-card h4 {
      margin: 0 0 9px;
      color: #0f172a;
      font-size: 16px;
      font-weight: 700;
    }

    .cm-process-card p {
      margin: 0;
      color: #64748b;
      font-size: 13px;
      line-height: 1.7;
    }


    /* =========================================================
     RESUME
  ========================================================= */

    .cm-resume-section {
      padding: 75px 0;
      background: #ffffff;
    }

    .cm-resume-banner {
      position: relative;
      overflow: hidden;
      padding: 45px;
      border-radius: 17px;
      background: linear-gradient(135deg,
          #0f172a,
          #1e293b);
    }

    .cm-resume-banner::after {
      content: "";
      position: absolute;
      width: 230px;
      height: 230px;
      right: -80px;
      top: -80px;
      border-radius: 50%;
      background: rgba(34, 197, 94, .08);
    }

    .cm-resume-label {
      display: inline-block;
      margin-bottom: 8px;
      color: #4ade80;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1px;
    }

    .cm-resume-banner h2 {
      position: relative;
      z-index: 1;
      margin: 0 0 12px;
      color: #ffffff;
      font-size: 30px;
      font-weight: 700;
    }

    .cm-resume-banner p {
      position: relative;
      z-index: 1;
      max-width: 680px;
      margin: 0;
      color: #cbd5e1;
      font-size: 14px;
      line-height: 1.8;
    }

    .cm-resume-list {
      position: relative;
      z-index: 1;
      display: flex;
      flex-wrap: wrap;
      gap: 10px 25px;
      margin: 23px 0;
    }

    .cm-resume-list span {
      color: #e2e8f0;
      font-size: 13px;
    }

    .cm-resume-button {
      position: relative;
      z-index: 1;
      display: inline-flex;
      padding: 12px 21px;
      border-radius: 6px;
      background: #22c55e;
      color: #ffffff !important;
      text-decoration: none !important;
      font-size: 13px;
      font-weight: 600;
    }

    .cm-resume-button:hover {
      background: #16a34a;
    }


    /* =========================================================
     FINAL CTA
  ========================================================= */

    .cm-final-cta {
      padding: 75px 0;
      background: #f8fafc;
    }

    .cm-final-box {
      text-align: center;
      max-width: 760px;
      margin: auto;
    }

    .cm-final-box h2 {
      margin: 0 0 12px;
      color: #0f172a;
      font-size: 32px;
      font-weight: 700;
    }

    .cm-final-box p {
      margin: 0 auto 25px;
      color: #64748b;
      font-size: 14px;
      line-height: 1.8;
    }

    .cm-final-button {
      display: inline-flex;
      padding: 13px 24px;
      border-radius: 7px;
      background: #ef4444;
      color: #ffffff !important;
      text-decoration: none !important;
      font-size: 14px;
      font-weight: 600;
    }

    .cm-final-button:hover {
      background: #dc2626;
    }


    /* =========================================================
     RESPONSIVE
  ========================================================= */

    @media (max-width: 991px) {

      .cm-hero {
        min-height: 750px;
      }

      .cm-hero-content {
        padding: 75px 0;
      }

      .cm-hero h1 {
        font-size: 44px;
      }

      .cm-hero-panel {
        margin-top: 35px;
      }

      .cm-profile-header {
        align-items: flex-start;
        flex-direction: column;
      }

    }

    @media (max-width: 576px) {

      .cm-hero {
        min-height: 800px;
      }

      .cm-hero h1 {
        font-size: 35px;
      }

      .cm-hero-description {
        font-size: 14px;
      }

      .cm-section {
        padding: 58px 0;
      }

      .cm-section-heading h2 {
        font-size: 27px;
      }

      .cm-profile-card {
        padding: 23px;
      }

      .cm-profile-info {
        align-items: flex-start;
        flex-direction: column;
      }

      .cm-resume-banner {
        padding: 28px;
      }

    }
  </style>


  <div class="cm-page">


    <!-- =====================================================
           HERO
      ====================================================== -->

    <section class="cm-hero">

      <video autoplay muted loop playsinline>

        <source src="{{ asset('student/assets/images/course-video.mp4') }}" type="video/mp4">

      </video>


      <div class="cm-hero-overlay"></div>


      <div class="container">

        <div class="cm-hero-content">

          <div class="row align-items-center">

            <!-- LEFT -->

            <div class="col-lg-7">

              <div class="cm-hero-text">

                <span class="cm-hero-tag">
                  AI-POWERED CAREER GUIDANCE
                </span>


                <h1>
                  Your <span>Future.</span>
                  <br>
                  Your <span>Career.</span>
                  <br>
                  Your <span>Journey.</span>
                </h1>


                <p class="cm-hero-description">
                  Career Mentor helps you explore suitable
                  career paths and x education options
                  based on your academic background, skills,
                  interests and career goals.
                </p>

                <div class="cm-hero-buttons">

                  @if($profileComplete)
                    <a href="#recommendations" class="cm-btn-primary">
                      Explore Recommendations
                      →
                    </a>
                  @else
                    <a href="{{ route('student.profile') }}" class="cm-btn-primary">
                      Complete Your Profile
                      →
                    </a>
                  @endif


                  <a href="#features" class="cm-btn-outline">
                    Explore CareerMentor
                    →
                  </a>

                </div>

              </div>

            </div>


            <!-- RIGHT -->

            <div class="col-lg-5">

              <div class="cm-hero-panel">

                <div class="cm-hero-panel-title">
                  What You Can Do
                </div>


                <div class="cm-hero-feature">

                  <div class="cm-feature-icon-small">
                    🎯
                  </div>

                  <div>

                    <h4>
                      Discover Career Paths
                    </h4>

                    <p>
                      Personalized career recommendations
                    </p>

                  </div>

                </div>


                <div class="cm-hero-feature">

                  <div class="cm-feature-icon-small">
                    🎓
                  </div>

                  <div>

                    <h4>
                      Explore Higher Studies
                    </h4>

                    <p>
                      Find suitable study opportunities
                    </p>

                  </div>

                </div>


                <div class="cm-hero-feature">

                  <div class="cm-feature-icon-small">
                    💡
                  </div>

                  <div>

                    <h4>
                      Understand Your Skills
                    </h4>

                    <p>
                      Organize your academic profile
                    </p>

                  </div>

                </div>


                <div class="cm-hero-feature">

                  <div class="cm-feature-icon-small">
                    📄
                  </div>

                  <div>

                    <h4>
                      Build Your Resume
                    </h4>

                    <p>
                      Create a professional resume
                    </p>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </section>



    <!-- =====================================================
           PROFILE COMPLETION
      ====================================================== -->

    <section class="cm-profile-section">

      <div class="container">

        <div class="cm-profile-card">

          <div class="cm-profile-header">

            <div>

              <div class="cm-profile-label">
                PROFILE READINESS
              </div>

              @if($profileComplete)

                <h2>
                  Your Profile is Ready!
                </h2>

                <p>
                  You have completed all the information
                  required for personalized recommendations.
                </p>

              @else

                <h2>
                  Complete Your Career Profile
                </h2>

                <p>
                  Complete all required information below to unlock
                  personalized career and higher studies recommendations.
                </p>

              @endif

            </div>


            <div class="cm-profile-percentage">
              {{ $profileCompletion }}%
            </div>

          </div>


          <div class="cm-progress-track">

            <div class="cm-progress-bar" style="width: {{ $profileCompletion }}%;"></div>

          </div>


          @if(!$profileComplete)

            <div style="
                            margin-top: 22px;
                            padding: 18px 20px;
                            border-radius: 9px;
                            background: #fff7ed;
                            border: 1px solid #fed7aa;
                        ">

              <div style="
                                color: #c2410c;
                                font-size: 14px;
                                font-weight: 700;
                                margin-bottom: 8px;
                            ">
                Complete these required fields:
              </div>


              <ul style="
                                margin: 0 0 15px 18px;
                                padding: 0;
                                color: #9a3412;
                                font-size: 13px;
                            ">

                @foreach($missingFields as $field)

                  <li style="margin-bottom: 4px;">
                    {{ $field }}
                  </li>

                @endforeach

              </ul>


              <a href="{{ route('student.profile') }}" class="cm-profile-link">
                Complete My Profile →
              </a>

            </div>


          @else

            <div style="
                            margin-top: 22px;
                            padding: 16px 20px;
                            border-radius: 9px;
                            background: #f0fdf4;
                            border: 1px solid #bbf7d0;
                            color: #166534;
                            font-size: 13px;
                            font-weight: 500;
                        ">

              ✓ Your profile is 100% complete.
              Career and higher studies recommendations
              are now unlocked.

            </div>

          @endif


        </div>

      </div>

    </section>



    <!-- =====================================================
           FEATURES
      ====================================================== -->

    <section class="cm-section cm-section-light" id="features">

      <div class="container">

        <div class="cm-section-heading">

          <span class="cm-section-label">
            CAREERMENTOR FEATURES
          </span>

          <h2>
            Everything You Need to Plan Ahead
          </h2>

          <p>
            CareerMentor connects your academic profile,
            career exploration and resume preparation
            in one platform.
          </p>

        </div>


        <div class="row g-4">


          <div class="col-lg-4 col-md-6">

            <div class="cm-feature-card">

              <div class="cm-feature-card-icon">
                🎯
              </div>

              <h3>
                AI Career Recommendations
              </h3>

              <p>
                Receive career suggestions based on
                your qualification, skills, projects,
                interests and career goals.
              </p>

            </div>

          </div>


          <div class="col-lg-4 col-md-6">

            <div class="cm-feature-card">

              <div class="cm-feature-card-icon">
                🎓
              </div>

              <h3>
                Higher Studies Guidance
              </h3>

              <p>
                Explore higher education opportunities
                that relate to your academic background
                and future interests.
              </p>

            </div>

          </div>


          <div class="col-lg-4 col-md-6">

            <div class="cm-feature-card">

              <div class="cm-feature-card-icon">
                📄
              </div>

              <h3>
                Professional Resume Builder
              </h3>

              <p>
                Create a professional resume using
                information already available in your
                profile.
              </p>

            </div>

          </div>


          <div class="col-lg-4 col-md-6">

            <div class="cm-feature-card">

              <div class="cm-feature-card-icon">
                💻
              </div>

              <h3>
                Skills & Projects
              </h3>

              <p>
                Maintain your skills, projects and
                certifications as part of your career
                profile.
              </p>

            </div>

          </div>


          <div class="col-lg-4 col-md-6">

            <div class="cm-feature-card">

              <div class="cm-feature-card-icon">
                ✨
              </div>

              <h3>
                Personalized Guidance
              </h3>

              <p>
                Recommendations are based on the
                information you provide rather than
                generic suggestions.
              </p>

            </div>

          </div>


          <div class="col-lg-4 col-md-6">

            <div class="cm-feature-card">

              <div class="cm-feature-card-icon">
                🚀
              </div>

              <h3>
                Career Preparation
              </h3>

              <p>
                Organize your academic and professional
                information as you prepare for your
                next step.
              </p>

            </div>

          </div>

        </div>

      </div>

    </section>



    <!-- =====================================================
           OPPORTUNITIES
      ====================================================== -->

    <section class="cm-section cm-section-white" id="recommendations">

      <div class="container">

        <div class="cm-section-heading">

          <span class="cm-section-label">
            YOUR NEXT STEP
          </span>

          <h2>
            Explore Your Future
          </h2>

          <p>
            Once your profile is ready, use CareerMentor
            to explore career and higher education options.
          </p>

        </div>


        <div class="row g-4">


          <!-- Career -->
<!-- 
          <div class="col-lg-6">

            <div class="cm-recommend-card">

              <div class="cm-recommend-icon" style="background:#f0fdf4;">
                🎯
              </div>

              <h3>
                Career Recommendations
              </h3>

              <p>
                Explore career roles that may align with
                your academic background, skills, interests,
                projects and career goals.
              </p>


              @if($profileComplete)

                <a href="#"
                   class="cm-recommend-button">
                  Explore Careers →
                </a>

              @else

                <span class="cm-recommend-button-disabled">
                  🔒 Complete Profile First
                </span>

                <div class="cm-recommend-status">
                  Complete your profile to unlock career recommendations.
                </div>

              @endif

            </div>

          </div> -->


          <!-- Higher Studies -->

          <style>
  /* Enlarged Recommendation Card Styles */
  .cm-recommend-card-enlarged {
    background: #ffffff;
    border-radius: 16px;
    padding: 40px 45px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    margin-bottom: 30px;
  }

  .cm-recommend-card-enlarged:hover {
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
  }

  /* Bigger Icon */
  .cm-recommend-icon-lg {
    width: 64px;
    height: 64px;
    background: #eff6ff;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    margin-bottom: 22px;
    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.1);
  }

  /* Bigger Title */
  .cm-recommend-card-enlarged h3 {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.35;
    margin-bottom: 14px;
  }

  /* Bigger & More Readable Paragraph */
  .cm-recommend-card-enlarged p {
    font-size: 15.5px;
    line-height: 1.7;
    color: #64748b;
    max-width: 900px;
    margin-bottom: 28px;
  }

  /* Enlarged Primary Button */
  .cm-recommend-btn-lg {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #2563eb;
    color: #ffffff;
    padding: 13px 30px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
    transition: background 0.2s ease, transform 0.15s ease;
  }

  .cm-recommend-btn-lg:hover {
    background: #1d4ed8;
    color: #ffffff;
    transform: translateY(-1px);
  }

  /* Disabled State */
  .cm-recommend-btn-disabled-lg {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #e2e8f0;
    color: #94a3b8;
    padding: 13px 28px;
    font-size: 15px;
    font-weight: 600;
    border-radius: 8px;
    cursor: not-allowed;
  }

  .cm-recommend-status-lg {
    font-size: 13.5px;
    color: #94a3b8;
    margin-top: 10px;
  }
</style>

<!-- Full-width (col-lg-12) replaces col-lg-6 -->
<div class="col-lg-12">

  <div class="cm-recommend-card-enlarged">

    <!-- Enlarged Icon -->
    <div class="cm-recommend-icon-lg">
      🎓
    </div>

    <!-- Enlarged Title -->
    <h3>
      Career Recommendations & Higher Studies Recommendations
    </h3>

    <!-- Enlarged Description -->
    <p>
      Explore career roles that may align with your academic background, skills, interests,
      projects and career goals and Higher education paths that may suit your qualification and long-term
      career interests.
    </p>

    <!-- Buttons -->
    @if($profileComplete)

      <a href="{{ route('student.recommendations') }}" class="cm-recommend-btn-lg">
        Generate Recommendations →
      </a>

    @else

      <div>
        <span class="cm-recommend-btn-disabled-lg">
          🔒 Complete Profile First
        </span>

        <div class="cm-recommend-status-lg">
          Complete your profile to unlock higher studies recommendations.
        </div>
      </div>

    @endif

  </div>

</div>

        </div>

      </div>

    </section>



    <!-- =====================================================
           HOW IT WORKS
      ====================================================== -->

    <section class="cm-section cm-section-light">

      <div class="container">

        <div class="cm-section-heading">

          <span class="cm-section-label">
            HOW IT WORKS
          </span>

          <h2>
            Your Journey With CareerMentor
          </h2>

          <p>
            A simple process designed to help you move
            from information to informed decisions.
          </p>

        </div>


        <div class="row g-4">


          <div class="col-lg-3 col-md-6">

            <div class="cm-process-card">

              <div class="cm-process-number">
                1
              </div>

              <h4>
                Complete Your Profile
              </h4>

              <p>
                Add your academic information, skills,
                interests and career goals.
              </p>

            </div>

          </div>


          <div class="col-lg-3 col-md-6">

            <div class="cm-process-card">

              <div class="cm-process-number" style="background:#2563eb;">
                2
              </div>

              <h4>
                AI Analysis
              </h4>

              <p>
                CareerMentor analyzes the information
                available in your profile.
              </p>

            </div>

          </div>


          <div class="col-lg-3 col-md-6">

            <div class="cm-process-card">

              <div class="cm-process-number" style="background:#f59e0b;">
                3
              </div>

              <h4>
                Explore Options
              </h4>

              <p>
                View personalized career and higher
                studies recommendations.
              </p>

            </div>

          </div>


          <div class="col-lg-3 col-md-6">

            <div class="cm-process-card">

              <div class="cm-process-number" style="background:#7c3aed;">
                4
              </div>

              <h4>
                Build Your Resume
              </h4>

              <p>
                Use your profile information to create
                and download your professional resume.
              </p>

            </div>

          </div>

        </div>

      </div>

    </section>



    <!-- =====================================================
           RESUME BUILDER
      ====================================================== -->
    

      
    <section class="cm-resume-section" id="resume">

      <div class="container">

        <div class="cm-resume-banner">

          <div class="row align-items-center">

            <div class="col-lg-8">

              <span class="cm-resume-label">
                RESUME BUILDER
              </span>

              <h2>
                Turn Your Profile Into a Professional Resume
              </h2>

              <p>
                CareerMentor lets you reuse information
                already entered in your profile, making
                resume creation easier and faster.
              </p>


              <div class="cm-resume-list">

                <span>
                  ✓ Reuse profile information
                </span>

                <span>
                  ✓ Choose a template
                </span>

                <span>
                  ✓ Edit your resume
                </span>

                <span>
                  ✓ Preview & download
                </span>

              </div>

            </div>


            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

              <a href="{{ route('student.resume.template1') }}" class="cm-resume-button">
                Open Resume Builder →
              </a>

            </div>

          </div>

        </div>

      </div>

    </section>



    <!-- =====================================================
           FINAL CTA
      ====================================================== -->

    <section class="cm-final-cta">

      <div class="container">

        <div class="cm-final-box">

          <span class="cm-section-label">
            START YOUR JOURNEY
          </span>

          <h2>
            Your Career Journey Starts With Your Profile
          </h2>

          <p>
            Keep your information updated and use
            CareerMentor to explore the possibilities
            available to you.
          </p>

          <a href="{{ route('student.profile') }}" class="cm-final-button">
            Manage My Profile →
          </a>

        </div>

      </div>

    </section>


  </div>
<!-- ===================== FEEDBACK SECTION ===================== -->
<section id="feedback" style="
  background: linear-gradient(135deg, #070f19 0%, #0f172a 60%, #1e293b 100%);
  padding: 80px 0;
  font-family: 'Poppins', sans-serif;
  position: relative;
  overflow: hidden;
">

  <!-- Background Glow Decoration -->
  <div style="
    position: absolute;
    width: 400px; height: 400px;
    left: -150px; bottom: -150px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(34,197,94,0.1) 0%, transparent 70%);
    pointer-events: none;
  "></div>
  <div style="
    position: absolute;
    width: 300px; height: 300px;
    right: -100px; top: -100px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(37,99,235,0.12) 0%, transparent 70%);
    pointer-events: none;
  "></div>

  <div class="container" style="position: relative; z-index: 1;">

    <!-- Section Header -->
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center">
        <span style="
          display: inline-block;
          padding: 5px 16px;
          border: 1px solid rgba(34,197,94,0.5);
          border-radius: 999px;
          color: #22c55e;
          font-size: 12px;
          font-weight: 600;
          letter-spacing: 1.5px;
          text-transform: uppercase;
          margin-bottom: 16px;
        ">We'd Love to Hear From You</span>

        <h2 style="
          font-size: 36px;
          font-weight: 700;
          color: #ffffff;
          margin-bottom: 12px;
          line-height: 1.25;
        ">Share Your <span style="color: #22c55e;">Feedback</span> &amp; Queries</h2>

        <p style="
          color: rgba(255,255,255,0.55);
          font-size: 15px;
          max-width: 520px;
          margin: 0 auto;
        ">Your thoughts help us improve. Drop us a message and we'll get back to you shortly.</p>
      </div>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
      <div class="col-lg-9">

        @if(session('feedback_success'))
          <div class="alert alert-success mb-4" style="background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.5); color: #4ade80; border-radius: 12px; padding: 16px 20px; font-size: 15px;">
            <i class="fas fa-check-circle me-2"></i> {{ session('feedback_success') }}
          </div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger mb-4" style="background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.5); color: #f87171; border-radius: 12px; padding: 14px 20px;">
            <ul class="mb-0 ps-3">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div style="
          background: rgba(255,255,255,0.04);
          border: 1px solid rgba(255,255,255,0.08);
          border-radius: 20px;
          padding: 48px 44px;
          backdrop-filter: blur(10px);
        ">
          <form id="contact" action="{{ route('feedback.store') }}" method="POST">
            @csrf
            <div class="row g-3">

              <!-- Name -->
              <div class="col-lg-4 col-md-4 col-12">
                <label style="color: rgba(255,255,255,0.6); font-size: 12px; font-weight: 600; letter-spacing: 0.8px; text-transform: uppercase; margin-bottom: 7px; display: block;">Your Name</label>
                <input name="name" type="text" id="name" placeholder="John Doe" value="{{ old('name', Auth::user()->name ?? '') }}" required style="
                  width: 100%;
                  background: rgba(255,255,255,0.06);
                  border: 1px solid rgba(255,255,255,0.12);
                  border-radius: 10px;
                  padding: 12px 16px;
                  color: #ffffff;
                  font-size: 14px;
                  font-family: 'Poppins', sans-serif;
                  outline: none;
                  transition: border-color 0.25s;
                "
                onfocus="this.style.borderColor='rgba(34,197,94,0.6)'"
                onblur="this.style.borderColor='rgba(255,255,255,0.12)'">
              </div>

              <!-- Email -->
              <div class="col-lg-4 col-md-4 col-12">
                <label style="color: rgba(255,255,255,0.6); font-size: 12px; font-weight: 600; letter-spacing: 0.8px; text-transform: uppercase; margin-bottom: 7px; display: block;">Email Address</label>
                <input name="email" type="email" id="email" placeholder="you@example.com" value="{{ old('email', Auth::user()->email ?? '') }}" required style="
                  width: 100%;
                  background: rgba(255,255,255,0.06);
                  border: 1px solid rgba(255,255,255,0.12);
                  border-radius: 10px;
                  padding: 12px 16px;
                  color: #ffffff;
                  font-size: 14px;
                  font-family: 'Poppins', sans-serif;
                  outline: none;
                  transition: border-color 0.25s;
                "
                onfocus="this.style.borderColor='rgba(34,197,94,0.6)'"
                onblur="this.style.borderColor='rgba(255,255,255,0.12)'">
              </div>

              <!-- Subject -->
              <div class="col-lg-4 col-md-4 col-12">
                <label style="color: rgba(255,255,255,0.6); font-size: 12px; font-weight: 600; letter-spacing: 0.8px; text-transform: uppercase; margin-bottom: 7px; display: block;">Subject</label>
                <input name="subject" type="text" id="subject" placeholder="Your subject..." value="{{ old('subject') }}" required style="
                  width: 100%;
                  background: rgba(255,255,255,0.06);
                  border: 1px solid rgba(255,255,255,0.12);
                  border-radius: 10px;
                  padding: 12px 16px;
                  color: #ffffff;
                  font-size: 14px;
                  font-family: 'Poppins', sans-serif;
                  outline: none;
                  transition: border-color 0.25s;
                "
                onfocus="this.style.borderColor='rgba(34,197,94,0.6)'"
                onblur="this.style.borderColor='rgba(255,255,255,0.12)'">
              </div>

              <!-- Message -->
              <div class="col-12">
                <label style="color: rgba(255,255,255,0.6); font-size: 12px; font-weight: 600; letter-spacing: 0.8px; text-transform: uppercase; margin-bottom: 7px; display: block;">Your Message</label>
                <textarea name="message" id="message" rows="5" placeholder="Write your feedback or query here..." required style="
                  width: 100%;
                  background: rgba(255,255,255,0.06);
                  border: 1px solid rgba(255,255,255,0.12);
                  border-radius: 10px;
                  padding: 14px 16px;
                  color: #ffffff;
                  font-size: 14px;
                  font-family: 'Poppins', sans-serif;
                  outline: none;
                  resize: vertical;
                  transition: border-color 0.25s;
                "
                onfocus="this.style.borderColor='rgba(34,197,94,0.6)'"
                onblur="this.style.borderColor='rgba(255,255,255,0.12)'">{{ old('message') }}</textarea>
              </div>

              <!-- Submit Button -->
              <div class="col-12 text-center mt-2">
                <button type="submit" id="form-submit" style="
                  background: linear-gradient(135deg, #16a34a, #22c55e);
                  color: #ffffff;
                  border: none;
                  border-radius: 10px;
                  padding: 13px 42px;
                  font-size: 14px;
                  font-weight: 700;
                  font-family: 'Poppins', sans-serif;
                  letter-spacing: 0.8px;
                  cursor: pointer;
                  transition: opacity 0.25s, transform 0.2s;
                  text-transform: uppercase;
                "
                onmouseover="this.style.opacity='0.88'; this.style.transform='translateY(-2px)'"
                onmouseout="this.style.opacity='1'; this.style.transform='translateY(0)'">
                  ✉&nbsp; Send Message
                </button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</section>

<script type="text/javascript">
  // Lock browser back navigation so only clicking Logout navigates away
  (function () {
    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function () {
      window.history.pushState(null, "", window.location.href);
    };
  })();
</script>

@endsection