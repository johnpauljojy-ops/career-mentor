<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI-Based Career & Higher Studies Guidance Platform</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<style>
    /* =========================================================
       CAREER MENTOR — GUEST HOMEPAGE
       (design tokens matched to the CareerMentor student homepage)
    ========================================================= */

    .cm-page {
        font-family: 'Poppins', sans-serif;
        background: #f8fafc;
        color: #0f172a;
    }


    /* =========================================================
       NAVBAR
    ========================================================= */

    .cm-navbar-wrap {
        position: relative;
        z-index: 3;
    }

    .cm-navbar {
        max-width: 1140px;
        margin: 0 auto;
        padding: 22px 20px;
        box-sizing: border-box;
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
        justify-self: center;
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

    .cm-navbar-links a:hover {
        color: #4ade80;
    }

    .cm-navbar-auth {
        justify-self: end;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .cm-navbar-login {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        border: 1px solid rgba(255, 255, 255, .45);
        border-radius: 7px;
        background: rgba(255, 255, 255, .06);
        color: #ffffff !important;
        font-size: 14.5px;
        font-weight: 600;
        text-decoration: none !important;
        transition: .2s ease;
    }

    .cm-navbar-login:hover {
        background: rgba(255, 255, 255, .14);
        color: #ffffff !important;
    }

    .cm-navbar-register {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 22px;
        border: 1px solid #22c55e;
        border-radius: 7px;
        background: #22c55e;
        color: #ffffff !important;
        font-size: 14.5px;
        font-weight: 600;
        text-decoration: none !important;
        transition: .2s ease;
    }

    .cm-navbar-register:hover {
        background: #16a34a;
        border-color: #16a34a;
        color: #ffffff !important;
    }

    @media (max-width: 768px) {

        .cm-navbar-inner {
            grid-template-columns: 1fr;
            justify-items: center;
            text-align: center;
            gap: 14px;
        }

        .cm-navbar-logo,
        .cm-navbar-links,
        .cm-navbar-auth {
            justify-self: center;
        }

        .cm-navbar-links {
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px 22px;
        }
    }


    /* =========================================================
       HERO (dark, shares the navbar's background)
    ========================================================= */

    .cm-hero-wrap {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #0f172a, #1e293b);
    }

    .cm-hero-wrap::after {
        content: "";
        position: absolute;
        width: 340px;
        height: 340px;
        right: -110px;
        top: -120px;
        border-radius: 50%;
        background: rgba(34, 197, 94, .10);
        pointer-events: none;
    }

    .cm-hero {
        position: relative;
        z-index: 1;
        max-width: 1140px;
        margin: 0 auto;
        padding: 30px 20px 80px;
        box-sizing: border-box;
        display: flex;
        align-items: center;
        gap: 40px;
        flex-wrap: wrap;
    }

    .cm-hero-text {
        flex: 1 1 520px;
        min-width: 280px;
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
        font-size: 46px;
        line-height: 1.15;
        font-weight: 700;
        max-width: 640px;
    }

    .cm-hero h1 span {
        color: #22c55e;
    }

    .cm-hero-description {
        max-width: 580px;
        margin-bottom: 32px;
        color: #dbe4ee;
        font-size: 15.5px;
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
        background: #22c55e;
        color: #ffffff !important;
        text-decoration: none !important;
        font-size: 14px;
        font-weight: 600;
        transition: .2s ease;
    }

    .cm-btn-primary:hover {
        background: #16a34a;
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
        flex: 1 1 340px;
        min-width: 280px;
        padding: 28px;
        border: 1px solid rgba(255, 255, 255, .22);
        border-radius: 17px;
        background: rgba(15, 23, 42, .55);
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, .20);
    }

    .cm-hero-panel-title {
        margin-bottom: 18px;
        color: #ffffff;
        font-size: 17px;
        font-weight: 700;
    }

    .cm-hero-panel-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: rgba(34, 197, 94, .16);
        font-size: 19px;
        margin-bottom: 16px;
    }

    .cm-hero-panel p {
        margin: 0 0 22px;
        color: #aebdcd;
        font-size: 12.5px;
        line-height: 1.7;
    }

    .cm-hero-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 22px;
        padding-top: 18px;
        border-top: 1px solid rgba(255, 255, 255, .12);
    }

    .cm-hero-stats div h4 {
        margin: 0 0 3px;
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
    }

    .cm-hero-stats div p {
        margin: 0;
        color: #9fb0c3;
        font-size: 11.5px;
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

    .container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 20px;
        box-sizing: border-box;
    }


    /* =========================================================
       FEATURES
    ========================================================= */

    .cm-features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

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
        font-size: 17px;
        font-weight: 700;
    }

    .cm-feature-card p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.75;
    }


    /* =========================================================
       HOW IT WORKS
    ========================================================= */

    .cm-process-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    .cm-process-card {
        padding: 10px 16px;
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
       ABOUT (dark banner, echoes resume banner)
    ========================================================= */

    .cm-about-section {
        padding: 75px 0;
        background: #ffffff;
    }

    .cm-about-banner {
        position: relative;
        overflow: hidden;
        padding: 50px 45px;
        border-radius: 17px;
        background: linear-gradient(135deg, #0f172a, #1e293b);
        text-align: center;
    }

    .cm-about-banner::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        right: -80px;
        top: -80px;
        border-radius: 50%;
        background: rgba(34, 197, 94, .08);
    }

    .cm-about-label {
        position: relative;
        z-index: 1;
        display: inline-block;
        margin-bottom: 10px;
        color: #4ade80;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .cm-about-banner h2 {
        position: relative;
        z-index: 1;
        margin: 0 0 16px;
        color: #ffffff;
        font-size: 28px;
        font-weight: 700;
    }

    .cm-about-banner p {
        position: relative;
        z-index: 1;
        max-width: 720px;
        margin: 0 auto;
        color: #cbd5e1;
        font-size: 14px;
        line-height: 1.85;
    }


    /* =========================================================
       CONTACT CARDS
    ========================================================= */

    .cm-contact-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .cm-contact-card {
        text-align: center;
        padding: 30px 22px;
        border: 1px solid #e2e8f0;
        border-radius: 13px;
        background: #f8fafc;
    }

    .cm-contact-card .cm-feature-card-icon {
        margin: 0 auto 16px;
    }

    .cm-contact-card h3 {
        margin: 0 0 8px;
        color: #0f172a;
        font-size: 15.5px;
        font-weight: 700;
    }

    .cm-contact-card p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.7;
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
        max-width: 720px;
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
        background: #22c55e;
        color: #ffffff !important;
        text-decoration: none !important;
        font-size: 14px;
        font-weight: 600;
    }

    .cm-final-button:hover {
        background: #16a34a;
    }


    /* =========================================================
       FOOTER
    ========================================================= */

    .cm-footer {
        padding: 26px 0;
        background: #0f172a;
        text-align: center;
    }

    .cm-footer p {
        margin: 0;
        color: #94a3b8;
        font-size: 12.5px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .cm-hero h1 {
            font-size: 36px;
        }

        .cm-hero-panel {
            margin-top: 10px;
        }

        .cm-features-grid,
        .cm-process-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .cm-contact-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {

        .cm-hero {
            padding: 24px 20px 55px;
        }

        .cm-hero h1 {
            font-size: 28px;
        }

        .cm-hero-description {
            font-size: 14px;
        }

        .cm-section {
            padding: 55px 0;
        }

        .cm-section-heading h2 {
            font-size: 26px;
        }

        .cm-features-grid,
        .cm-process-grid {
            grid-template-columns: 1fr;
        }

        .cm-about-banner {
            padding: 30px 22px;
        }
    }
</style>


<div class="cm-page">


    <!-- =====================================================
         NAVBAR + HERO (shared dark background)
    ====================================================== -->

    <div class="cm-hero-wrap">

        <div class="cm-navbar-wrap">

            <header class="cm-navbar">

                <div class="cm-navbar-inner">

                    <div class="cm-navbar-logo">

                        <a href="{{ url('/') }}">
                            Career<span class="cm-highlight">Mentor</span>
                        </a>

                    </div>


                    <nav class="cm-navbar-links">

                        <a href="#features">Features</a>

                        <a href="#how-it-works">How It Works</a>

                        <a href="#about">About</a>

                        <a href="#contact">Contact</a>

                    </nav>


                    <div class="cm-navbar-auth">

                        <a href="{{ route('loginn') }}" class="cm-navbar-login">
                            Login
                        </a>

                        <a href="{{ route('register') }}" class="cm-navbar-register">
                            Register
                        </a>

                    </div>

                </div>

            </header>

        </div>


        <div class="cm-hero">

            <div class="cm-hero-text">

                <span class="cm-hero-tag">
                    AI-POWERED GUIDANCE
                </span>

                <h1>
                    Shape Your <span>Professional Future</span> with Precision
                </h1>

                <p class="cm-hero-description">
                    Analyze your academic background, core skills and personal
                    interests to discover tailored career paths, higher education
                    opportunities, and instant resume-building tools.
                </p>

                <div class="cm-hero-buttons">

                    <a href="{{ route('register') }}" class="cm-btn-primary">
                        Register →
                    </a>

                    <a href="#features" class="cm-btn-outline">
                        Learn More
                    </a>

                </div>

            </div>


            <div class="cm-hero-panel">

                <div class="cm-hero-panel-icon">
                    💡
                </div>

                <div class="cm-hero-panel-title">
                    Smart Recommendation Engine
                </div>

                <p>
                    Matches your unique profile with up-to-date industry
                    trends and college database requirements.
                </p>

                <div class="cm-hero-stats">

                    <div>
                        <h4>98%</h4>
                        <p>Match Accuracy</p>
                    </div>

                    <div>
                        <h4>500+</h4>
                        <p>Career Paths</p>
                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- =====================================================
         FEATURES
    ====================================================== -->

    <section id="features" class="cm-section cm-section-light">

        <div class="container">

            <div class="cm-section-heading">

                <span class="cm-section-label">
                    PLATFORM FEATURES
                </span>

                <h2>
                    Everything You Need to Plan Ahead
                </h2>

                <p>
                    Everything you need to bridge the gap between academic
                    learning and industry requirements.
                </p>

            </div>


            <div class="cm-features-grid">

                <div class="cm-feature-card">

                    <div class="cm-feature-card-icon">
                        🎯
                    </div>

                    <h3>
                        AI Career Recommendations
                    </h3>

                    <p>
                        Get data-driven suggestions for careers that align
                        with your qualifications, CGPA and interests.
                    </p>

                </div>


                <div class="cm-feature-card">

                    <div class="cm-feature-card-icon">
                        🎓
                    </div>

                    <h3>
                        Higher Studies Finder
                    </h3>

                    <p>
                        Explore post-graduation opportunities, specialized
                        branches and institutions suited to your goals.
                    </p>

                </div>


                <div class="cm-feature-card">

                    <div class="cm-feature-card-icon">
                        🗺️
                    </div>

                    <h3>
                        Job Suggestions
                    </h3>

                    <p>
                        Explore better carrer path or job opportunities, specialized
                        institutions suited to your interests.
                    </p>

                </div>


                <div class="cm-feature-card">

                    <div class="cm-feature-card-icon">
                        📄
                    </div>

                    <h3>
                        Dynamic Resume Builder
                    </h3>

                    <p>
                        Select from professional templates and automatically
                        format your skills, projects and achievements.
                    </p>

                </div>


                

            </div>

        </div>

    </section>



    <!-- =====================================================
         HOW IT WORKS
    ====================================================== -->

    <section id="how-it-works" class="cm-section cm-section-white">

        <div class="container">

            <div class="cm-section-heading">

                <span class="cm-section-label">
                    HOW IT WORKS
                </span>

                <h2>
                    Your Journey With CareerMentor
                </h2>

                <p>
                    A simple process designed to help you move from
                    information to informed decisions.
                </p>

            </div>


            <div class="cm-process-grid">

                <div class="cm-process-card">

                    <div class="cm-process-number">
                        1
                    </div>

                    <h4>
                        Create Your Account
                    </h4>

                    <p>
                        Register and add your academic information,
                        skills, interests and career goals.
                    </p>

                </div>


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

    </section>



    <!-- =====================================================
         ABOUT
    ====================================================== -->

    <section id="about" class="cm-about-section">

        <div class="container">

            <div class="cm-about-banner">

                <span class="cm-about-label">
                    ABOUT GROUP-13 PLATFORM
                </span>

                <h2>
                    Empowering Students With Smart, Data-Driven Mentoring
                </h2>

                <p>
                    The AI-Based Career & Higher Studies Guidance Platform is
                    engineered to assist students and job seekers in making
                    confident, data-backed career decisions. By analyzing
                    educational backgrounds, specific skills and personal
                    goals, our engine bridges academic learning with modern
                    industry expectations.
                </p>

            </div>

        </div>

    </section>



    <!-- =====================================================
         CONTACT
    ====================================================== -->

    <section id="contact" class="cm-section cm-section-light">

        <div class="container">

            <div class="cm-section-heading">

                <span class="cm-section-label">
                    GET IN TOUCH
                </span>

                <h2>
                    We're Here to Help
                </h2>

                <p>
                    Have questions about your career journey or need
                    platform support? Reach out to our mentoring
                    administration directly.
                </p>

            </div>


            <div class="cm-contact-grid">

                <div class="cm-contact-card">

                    <div class="cm-feature-card-icon" style="margin-left:auto; margin-right:auto;">
                        📍
                    </div>

                    <h3>
                        Campus Location
                    </h3>

                    <p>
                        Educational Institution / Campus
                        Group-13 Office
                    </p>

                </div>


                <div class="cm-contact-card">

                    <div class="cm-feature-card-icon" style="margin-left:auto; margin-right:auto;">
                        📧
                    </div>

                    <h3>
                        Email Support
                    </h3>

                    <p>
                        support@careermentor.campus.edu
                    </p>

                </div>


                <div class="cm-contact-card">

                    <div class="cm-feature-card-icon" style="margin-left:auto; margin-right:auto;">
                        📞
                    </div>

                    <h3>
                        Phone Number
                    </h3>

                    <p>
                        +1 (555) 234-5678
                    </p>

                </div>

            </div>

            <!-- Feedback Submission Form Card -->
            

        </div>

    </section>



    <!-- =====================================================
         FINAL CTA
    ====================================================== -->

    



    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <footer class="cm-footer">

        <div class="container">

            <p>
                &copy; 2026 AI-Based Career & Higher Studies Guidance Platform
                (Group-13). All rights reserved.
            </p>

        </div>

    </footer>


</div>

</body>
</html>