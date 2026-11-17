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

    <!-- Header Logout Button Styles (small size) -->
    <style>
        .cm-nav-back-item {
            display: flex;
            align-items: center;
            margin-right: 6px;
        }

        .cm-navbar-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 5px 14px;
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff !important;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.2;
            text-decoration: none !important;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .cm-navbar-back:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.6);
            color: #ffffff !important;
            transform: translateX(-2px);
        }

        .cm-nav-logout-item {
            display: flex;
            align-items: center;
            margin-left: 8px;
        }

        .cm-nav-logout-item form {
            margin: 0;
        }

        .cm-navbar-logout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 5px 13px;
            border: 1px solid #ef4444;
            border-radius: 6px;
            background: #ef4444;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.2;
            cursor: pointer;
        }

        /* No color change on hover */
        .cm-navbar-logout:hover {
            background: #ef4444;
            border-color: #ef4444;
            color: #ffffff;
        }

        /* Mobile menu: full-width button */
        @media (max-width: 991px) {

            .cm-nav-back-item {
                margin-right: 0;
                padding: 8px 15px;
            }

            .cm-navbar-back {
                width: 100%;
                padding: 7px 13px;
            }

            .cm-nav-logout-item {
                margin-left: 0;
                padding: 8px 15px;
            }

            .cm-navbar-logout {
                width: 100%;
                padding: 7px 13px;
            }
        }
    </style>

</head>

<body>

    <!-- Header -->
    <header class="header-area header-sticky">

        <div class="container">

            <div class="row">

                <div class="col-12">

                    <nav class="main-nav">

                        <!-- Logo -->
                        <a href="{{ route('studenthome') }}" class="logo">
                            Career Mentoring
                        </a>

                        @php
                            $defaultBackUrl = route('studenthome');
                            if (request()->routeIs('student.recommendations')) {
                                $defaultBackUrl = route('studenthome') . '#recommendations';
                            } elseif (request()->routeIs('student.payment')) {
                                $defaultBackUrl = route('student.subscription');
                            } elseif (request()->routeIs('student.subscription') || request()->routeIs('student.subscription.plan')) {
                                $defaultBackUrl = route('studenthome') . '#resume';
                            }
                        @endphp

                        <!-- Menu -->
                        <ul class="nav">

                            <li class="scroll-to-section">
                                <a href="javascript:history.back()">Back</a>
                            </li>

                            <!-- Logout (next to Back) -->
                            @auth
                            <li class="cm-nav-logout-item">

                                <form method="POST" action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit" class="cm-navbar-logout">
                                        Logout
                                    </button>

                                </form>

                            </li>
                            @endauth

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

    <style>
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
      .cm-footer-cta { padding: 20px; border: 1px solid rgba(255,255,255,.12); border-radius: 14px; background: rgba(255,255,255,.04); }
      .cm-footer-cta p { margin: 0 0 14px; color: #94a3b8; font-size: 13px; line-height: 1.7; }
      .cm-footer-btn { display: inline-flex; padding: 11px 20px; border-radius: 7px; background: #ef4444; color: #fff !important; text-decoration: none !important; font-size: 13px; font-weight: 600; transition: .2s ease; }
      .cm-footer-btn:hover { background: #dc2626; transform: translateY(-2px); }
      .cm-footer-bottom { padding: 20px 0; border-top: 1px solid rgba(255,255,255,.1); }
      .cm-footer-bottom p { margin: 0; color: #64748b; font-size: 12px; }
      .cm-footer-top { color: #94a3b8 !important; text-decoration: none !important; font-size: 12px; font-weight: 600; transition: .2s ease; }
      .cm-footer-top:hover { color: #22c55e !important; }
      @media (max-width: 767px) { .cm-footer-main { padding: 45px 0 25px; } }
    </style>

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


    <!-- Profile Completion Script -->
    @auth
    <script>
        function updateProfileProgress() {
            const profileElement = document.getElementById("student-profile-data");
            if (!profileElement) return;

            const studentProfile = JSON.parse(profileElement.textContent);

            const fields = Object.entries(studentProfile);

            let filled = 0;

            fields.forEach(([fieldName, value]) => {

                const isFilled =
                    value !== null &&
                    value !== undefined &&
                    String(value).trim() !== "";

                if (isFilled) {
                    filled++;
                }
            });

            const totalFields = fields.length;

            console.log("Filled Fields:", filled);
            console.log("Total Fields:", totalFields);

            const percentage = Math.round((filled / totalFields) * 100);

            const circle = document.getElementById("profileProgressCircle");
            const label = document.getElementById("profileProgressValue");

            if (!circle || !label) return;

            // Radius is 34; circumference = 2 * PI * 34 ≈ 213.63
            const radius = 34;
            const circumference = 2 * Math.PI * radius;

            circle.style.strokeDasharray = circumference;
            const offset = circumference - (percentage / 100) * circumference;
            circle.style.strokeDashoffset = offset;

            label.innerText = percentage + "%";

            // Dynamic status color
            let color = "#22c55e"; // Green
            let bgColor = "rgba(34, 197, 94, 0.15)";

            if (percentage < 40) {
                color = "#ef4444"; // Red
                bgColor = "rgba(239, 68, 68, 0.15)";
            } else if (percentage < 70) {
                color = "#f59e0b"; // Yellow/Orange
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

        // Lock browser back navigation
        // Back button: return to the previous page at the same scroll position
document.addEventListener("DOMContentLoaded", function () {
    var btn = document.getElementById("cmBackBtn");
    if (!btn) return;

    btn.addEventListener("click", function (e) {
        var cameFromAnotherPage = false;
        try {
            var ref = document.referrer;
            cameFromAnotherPage =
                ref &&
                new URL(ref).origin === location.origin &&
                ref.split("#")[0] !== location.href.split("#")[0];
        } catch (err) {}

        if (cameFromAnotherPage && history.length > 1) {
            e.preventDefault();
            history.back();   // browser restores the previous scroll position
        }
        // otherwise the normal href (default back URL) is used
    });
});
    </script>
    @endauth

</body>

</html>