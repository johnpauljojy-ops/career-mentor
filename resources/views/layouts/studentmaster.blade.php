<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="TemplateMo">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900"
          rel="stylesheet">

    <title>Career Mentoring</title>

    <!-- Bootstrap -->
    <link href="{{ asset('student/assets/vendor/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet"
          href="{{ asset('student/assets/css/fontawesome.css') }}">

    <link rel="stylesheet"
          href="{{ asset('student/assets/css/templatemo-edu-meeting.css') }}">

    <link rel="stylesheet"
          href="{{ asset('student/assets/css/owl.css') }}">

    <link rel="stylesheet"
          href="{{ asset('student/assets/css/lightbox.css') }}">

    <style>
      /* =========================================================
         NAV ACTIVE UNDERLINE BAR (AT THE BOTTOM OF HEADER)
      ========================================================= */

      .header-area .main-nav .nav > li {
        position: relative;
        display: flex;
        align-items: center;
      }

      .header-area .main-nav .nav > li > a {
        position: relative;
        padding-bottom: 8px;
        transition: color 0.3s ease;
      }

      /* The underline bar for top-level links */
      .header-area .main-nav .nav > li:not(.profile-circle-nav) > a::after {
        content: '';
        position: absolute;
        bottom: -15px; /* Sits right at the bottom edge of the header */
        left: 0;
        width: 0;
        height: 3px;
        background-color: #22c55e; /* Vibrant Green Accent */
        border-radius: 3px 3px 0 0;
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }

      /* Expand bar when: 
         1. Top link is active
         2. Top link is hovered
         3. Parent has active class
         4. Any sub-menu item inside Domain is active (:has selector)
      */
      .header-area .main-nav .nav > li:not(.profile-circle-nav) > a.active::after,
      .header-area .main-nav .nav > li:not(.profile-circle-nav):hover > a::after,
      .header-area .main-nav .nav > li.has-sub.active > a::after,
      .header-area .main-nav .nav > li.has-sub:hover > a::after,
      .header-area .main-nav .nav > li.has-sub:has(.active) > a::after,
      .header-area .main-nav .nav > li.has-sub.domain-active > a::after {
        width: 100% !important;
      }

      /* Green text color when active or hovered */
      .header-area .main-nav .nav > li:not(.profile-circle-nav) > a.active,
      .header-area .main-nav .nav > li:not(.profile-circle-nav):hover > a,
      .header-area .main-nav .nav > li.has-sub.active > a,
      .header-area .main-nav .nav > li.has-sub:hover > a,
      .header-area .main-nav .nav > li.has-sub:has(.active) > a,
      .header-area .main-nav .nav > li.has-sub.domain-active > a {
        color: #22c55e !important;
      }

      /* =========================================================
         FIX DROPDOWN MENU WIDTH & STYLING
      ========================================================= */
      header.header-area .main-nav .nav li ul.sub-menu,
      .header-area .main-nav .nav li ul.sub-menu {
        width: 250px !important;
        min-width: 250px !important;
        padding: 10px 0 !important;
        overflow: visible !important;
      }

      header.header-area .main-nav .nav li ul.sub-menu li,
      .header-area .main-nav .nav li ul.sub-menu li {
        width: 100% !important;
        white-space: nowrap !important;
      }

      header.header-area .main-nav .nav li ul.sub-menu li a,
      .header-area .main-nav .nav li ul.sub-menu li a {
        display: block !important;
        width: 100% !important;
        padding: 10px 20px !important;
        white-space: nowrap !important;
        font-size: 13px !important;
      }

      /* Fix scroll position offset for sticky header */
      #features, #recommendations, #resume, #feedback {
        scroll-margin-top: 100px;
      }

      /* =========================================================
         FOOTER
      ========================================================= */
      .cm-footer { position: relative; overflow: hidden; font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #070f19 0%, #0f172a 60%, #1e293b 100%); color: #cbd5e1; }
      .cm-footer::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #16a34a, #22c55e, #4ade80); }
      .cm-footer::after { content: ""; position: absolute; width: 360px; height: 360px; right: -140px; bottom: -160px; border-radius: 50%; background: radial-gradient(circle, rgba(34,197,94,.1) 0%, transparent 70%); pointer-events: none; }
      .cm-footer .container { position: relative; z-index: 1; }
      .cm-footer-main { padding: 60px 0 40px; }
      .cm-footer-brand { margin-bottom: 14px; color: #fff; font-size: 22px; font-weight: 700; }
      .cm-footer-brand span { color: #22c55e; }
      .cm-footer-about { max-width: 340px; margin: 0 0 20px; color: #94a3b8; font-size: 13px; line-height: 1.8; }
      .cm-footer-tag { display: inline-block; padding: 7px 14px; border: 1px solid rgba(34,197,94,.5); border-radius: 50px; background: rgba(34,197,94,.12); color: #4ade80; font-size: 11px; font-weight: 700; letter-spacing: 1px; }
      .cm-footer h5 { margin: 0 0 18px; color: #fff; font-size: 15px; font-weight: 700; }
      .cm-footer ul { margin: 0; padding: 0; list-style: none; }
      .cm-footer li { margin-bottom: 11px; }
      .cm-footer li a { color: #94a3b8; text-decoration: none; font-size: 13px; transition: .2s ease; }
      .cm-footer li a:hover { color: #22c55e; padding-left: 4px; }
      .cm-footer-bottom { padding: 20px 0; border-top: 1px solid rgba(255,255,255,.1); }
      .cm-footer-bottom p { margin: 0; color: #64748b; font-size: 12px; }
      @media (max-width: 767px) { .cm-footer-main { padding: 45px 0 25px; } }
    </style>

</head>

<body>

    <div id="top"></div>

    <!-- Header -->
    <header class="header-area header-sticky">

        <div class="container">

            <div class="row">

                <div class="col-12">

                    <nav class="main-nav">

                        <!-- Logo -->
                        <a href="{{ route('studenthome') }}" class="logo">
                            Career Mentor
                        </a>

                        <!-- Menu -->
                        <ul class="nav">

                            <li class="scroll-to-section">
                                <a href="{{ route('studenthome') }}#top" class="{{ request()->routeIs('studenthome') ? 'active' : '' }}">Home</a>
                            </li>

                            <li class="has-sub">

                                <a href="javascript:void(0)">
                                    Domain
                                </a>

                                <ul class="sub-menu">

                                    <li>
                                        <div class="scroll-to-section"><a href="#recommendations">Career Assitance</a></div>
                                    </li>

                                    <li>
                                        <div class="scroll-to-section"><a href="#resume">Resume Building</a></div>
                                    </li>

                                </ul>

                            </li>

                            <li class="scroll-to-section">
                                <a href="#features">
                                    About Us
                                </a>
                            </li>

                            <li class="scroll-to-section">
                                <a href="#feedback">
                                    Feedback
                                </a>
                            </li>

                            

                            <!-- Student Profile -->
                            <li class="profile-circle-nav">

                                <a href="{{ route('student.profile') }}"
                                   style="display: inline-flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px; text-decoration: none;">

                                    @auth
                                        @php
                                            $user = Auth::user();
                                            $userId = Auth::id() ?? ($user->userid ?? null);

                                            // Fetch student details
                                            $studentData = $student ?? \App\Models\Student::where('userid', $userId)->first();

                                            // Check saved photo path
                                            $navPhoto = $studentData->photo 
                                                     ?? $studentData->profile_pic 
                                                     ?? $studentData->image 
                                                     ?? null;

                                            // Check if file exists on disk
                                            $hasNavPhoto = !empty($navPhoto) && file_exists(public_path(ltrim($navPhoto, '/')));
                                            $navPhotoUrl = $hasNavPhoto 
                                                ? asset(ltrim($navPhoto, '/')) . '?v=' . filemtime(public_path(ltrim($navPhoto, '/')))
                                                : null;
                                        @endphp

                                        <!-- PROFILE PROGRESS WIDGET (nav bar version) -->
                                        <svg width="44" height="44" viewBox="0 0 84 84" style="overflow: visible;">
                                            <defs>
                                                <!-- Circular clip path for avatar photo -->
                                                <clipPath id="avatarCircleClip">
                                                    <circle cx="42" cy="42" r="23" />
                                                </clipPath>
                                            </defs>

                                            <!-- Gray Background Track Ring -->
                                            <circle
                                                cx="42" cy="42" r="34"
                                                fill="none"
                                                stroke="#374151"
                                                stroke-width="6"
                                            />

                                            <!-- Dynamic Progress Ring -->
                                            <circle
                                                id="profileProgressCircle"
                                                cx="42" cy="42" r="34"
                                                fill="none"
                                                stroke="#22c55e"
                                                stroke-width="6"
                                                stroke-linecap="round"
                                                transform="rotate(-90 42 42)"
                                                style="transition: stroke-dashoffset 0.4s ease, stroke 0.3s ease;"
                                            />

                                            @if($hasNavPhoto)
                                                <!-- Background circle for transparent images -->
                                                <circle cx="42" cy="42" fill="#ffffff" />

                                                <!-- Saved Student Photo -->
                                                <image
                                                    x="19" y="19" width="46" height="46"
                                                    href="{{ $navPhotoUrl }}"
                                                    xlink:href="{{ $navPhotoUrl }}"
                                                    clip-path="url(#avatarCircleClip)"
                                                    preserveAspectRatio="xMidYMid slice"
                                                />
                                            @else
                                                <!-- Fallback: Orange Inner Avatar Circle -->
                                                <circle
                                                    cx="42" cy="42" r="23"
                                                    fill="#f59e0b"
                                                />

                                                <!-- Fallback: Purple User Silhouette Icon -->
                                                <g transform="translate(31, 31) scale(0.92)" fill="#3b2a6b">
                                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                </g>
                                            @endif
                                        </svg>

                                        <!-- PERCENTAGE PILL BADGE -->
                                        <div
                                            id="profileProgressValue"
                                            style="display: inline-block; padding: 1px 7px; font-size: 10px; font-weight: 700; border-radius: 9999px; background-color: rgba(34, 197, 94, 0.15); color: #22c55e; line-height: 1.2; text-align: center;">
                                            0%
                                        </div>

                                        <script type="application/json" id="student-profile-data">
                                        {
                                            "photo": "{{ $studentData->photo ?? $studentData->profile_pic ?? $studentData->image ?? ($hasNavPhoto ? 'exists' : '') }}",
                                            "name": "{{ $user->name ?? $studentData->name ?? '' }}",
                                            "email": "{{ $user->email ?? $studentData->email ?? '' }}",
                                            "phone": "{{ $studentData->phone ?? $studentData->mobile ?? $studentData->contact ?? '' }}",
                                            "gender": "{{ $studentData->gender ?? '' }}",
                                            "dob": "{{ $studentData->dob ?? $studentData->date_of_birth ?? '' }}",
                                            "qualification": "{{ $studentData->qualification_id ?? $studentData->qualification ?? '' }}",
                                            "branch": "{{ $studentData->branch_id ?? $studentData->branch ?? '' }}",
                                            "college": "{{ $studentData->collegename ?? $studentData->college_name ?? $studentData->college ?? '' }}",
                                            "cgpa": "{{ $studentData->cgpa ?? $studentData->percentage ?? '' }}",
                                            "graduation_year": "{{ $studentData->graduation_year ?? $studentData->passout_year ?? $studentData->grad_year ?? '' }}",
                                            "skills": "{{ $studentData->skill ?? $studentData->skills ?? '' }}",
                                            "projects": "{{ $studentData->projects ?? $studentData->project ?? '' }}",
                                            "certifications": "{{ $studentData->certification ?? $studentData->certifications ?? $studentData->certificate ?? '' }}",
                                            "interests": "{{ $studentData->interest ?? $studentData->interests ?? '' }}",
                                            "career_goal": "{{ $studentData->carrergoal ?? $studentData->career_goal ?? $studentData->careergoal ?? $studentData->career_objective ?? '' }}"
                                        }
                                        </script>
                                    @endauth

                                </a>

                            </li>

                        </ul>

                        <a class="menu-trigger">
                            <span>Menu</span>
                        </a>

                    </nav>

                </div>

            </div>

        </div>

    </header>


    <!-- Page Content -->

    @yield('content')


    <!-- Footer -->

    <footer class="cm-footer">
      <div class="container">

        <div class="cm-footer-main">
          <div class="row g-4">

            <div class="col-lg-4 col-md-6">
              <div class="cm-footer-brand">Career <span>Mentoring</span></div>
              <p class="cm-footer-about">
                AI-powered guidance that helps you explore career paths and higher studies,
                and turn your academic profile into a professional resume.
              </p>
              <span class="cm-footer-tag">YOUR FUTURE. YOUR CAREER.</span>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
              <h5>Explore</h5>
              <ul>
                <li><a href="{{ route('studenthome') }}">Home</a></li>
                <li><a href="{{ route('studenthome') }}#features">Features</a></li>
                <li><a href="{{ route('studenthome') }}#recommendations">Recommendations</a></li>
                <li><a href="{{ route('studenthome') }}#resume">Resume Builder</a></li>
              </ul>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
              <h5>For Students</h5>
              <ul>
                @auth
                  <li><a href="{{ route('student.profile') }}">My Profile</a></li>
                  <li><a href="{{ route('student.recommendations') }}">My Recommendations</a></li>
                  <li><a href="{{ route('student.resume.template1') }}">Build Resume</a></li>
                @else
                  <li><a href="{{ route('loginn') }}">Login</a></li>
                @endauth
                <li><a href="{{ route('studenthome') }}#feedback">Feedback</a></li>
              </ul>
            </div>

          </div>
        </div>

        <div class="cm-footer-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
          <p>Copyright © {{ date('Y') }} Career Mentoring. All Rights Reserved.</p>
        </div>

      </div>
    </footer>


    <!-- JavaScript -->

    <script src="{{ asset('student/assets/vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('student/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('student/assets/js/isotope.min.js') }}"></script>

    <script src="{{ asset('student/assets/js/owl-carousel.js') }}"></script>

    <script src="{{ asset('student/assets/js/lightbox.js') }}"></script>

    <script src="{{ asset('student/assets/js/tabs.js') }}"></script>

    <script src="{{ asset('student/assets/js/video.js') }}"></script>

    <script src="{{ asset('student/assets/js/slick-slider.js') }}"></script>

    <script src="{{ asset('student/assets/js/custom.js') }}"></script>


    <!-- Submenu Active Tracker -->
    <!-- Navigation & Active Bar Fix -->
<script>
    $(document).ready(function () {
        const $navLinks = $('.main-nav .nav li:not(.profile-circle-nav) a');
        const $homeLink = $('.main-nav .nav li:first-child a');
        const $hasSub = $('.main-nav .nav li.has-sub');

        // 1. When clicking any nav link (especially Home)
        $navLinks.on('click', function () {
            $navLinks.removeClass('active');
            $hasSub.removeClass('domain-active');
            $(this).addClass('active');

            // If it's inside the Domain sub-menu, activate Domain bar
            if ($(this).closest('.has-sub').length > 0) {
                $hasSub.addClass('domain-active');
            }
        });

        // 2. On scroll: if near the top, force Home to be active
        $(window).on('scroll', function () {
            const scrollPos = $(window).scrollTop();

            // When scrolled near the top (< 150px), reset active to Home
            if (scrollPos < 150) {
                $navLinks.removeClass('active');
                $hasSub.removeClass('domain-active');
                $homeLink.addClass('active');
            } else {
                // Check if Domain submenu items are active
                if ($hasSub.find('.sub-menu a.active').length > 0) {
                    $hasSub.addClass('domain-active');
                } else {
                    $hasSub.removeClass('domain-active');
                }
            }
        });
    });
</script>

    <!-- Profile Completion Script -->
    @auth
    <script>
        function updateProfileProgress() {
            const profileElement = document.getElementById("student-profile-data");
            if (!profileElement) return;

            let studentProfile;
            try {
                studentProfile = JSON.parse(profileElement.textContent);
            } catch (e) {
                console.error("Invalid profile JSON:", e);
                return;
            }

            const fields = Object.entries(studentProfile);
            let filled = 0;

            fields.forEach(([fieldName, value]) => {
                const isFilled =
                    value !== null &&
                    value !== undefined &&
                    String(value).trim() !== "";

                if (isFilled) {
                    filled++;
                } else {
                    console.warn("Unfilled profile field:", fieldName);
                }
            });

            const totalFields = fields.length;
            const percentage = totalFields > 0 ? Math.round((filled / totalFields) * 100) : 0;

            const circle = document.getElementById("profileProgressCircle");
            const label = document.getElementById("profileProgressValue");

            if (!circle || !label) return;

            const radius = 34;
            const circumference = 2 * Math.PI * radius;

            circle.style.strokeDasharray = circumference;
            const offset = circumference - (percentage / 100) * circumference;
            circle.style.strokeDashoffset = offset;

            label.innerText = percentage + "%";

            // Status colors
            let color = "#22c55e"; // Green
            let bgColor = "rgba(34, 197, 94, 0.15)";

            if (percentage < 40) {
                color = "#ef4444"; // Red
                bgColor = "rgba(239, 68, 68, 0.15)";
            } else if (percentage < 70) {
                color = "#f59e0b"; // Orange/Yellow
                bgColor = "rgba(245, 158, 11, 0.15)";
            }

            circle.style.stroke = color;
            label.style.color = color;
            label.style.backgroundColor = bgColor;
        }

        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", updateProfileProgress);
        } else {
            updateProfileProgress();
        }
    </script>
    @endauth

</body>

</html>