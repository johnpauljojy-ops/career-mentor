<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AI-Based Career & Higher Studies Guidance Platform</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<style>
    /* =========================================================
       CAREER MENTOR — LOGIN PAGE
       (design tokens matched to the CareerMentor homepage)
    ========================================================= */

    .cm-page {
        font-family: 'Poppins', sans-serif;
        background: #f8fafc;
        color: #0f172a;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 20px;
        box-sizing: border-box;
    }


    /* =========================================================
       NAVBAR
    ========================================================= */

    .cm-navbar-wrap {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #0f172a, #1e293b);
    }

    .cm-navbar-wrap::after {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        right: -90px;
        top: -110px;
        border-radius: 50%;
        background: rgba(34, 197, 94, .10);
        pointer-events: none;
    }

    .cm-navbar {
        position: relative;
        z-index: 2;
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
        font-size: 15px;
        font-weight: 500;
        text-decoration: none !important;
        transition: color .15s ease;
    }

    .cm-navbar-links a:hover {
        color: #4ade80;
    }

    .cm-navbar-auth {
        justify-self: end;
    }

    .cm-navbar-register {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        border: 1px solid rgba(255, 255, 255, .45);
        border-radius: 7px;
        background: rgba(255, 255, 255, .06);
        color: #ffffff !important;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none !important;
        transition: .2s ease;
    }

    .cm-navbar-register:hover {
        background: rgba(255, 255, 255, .14);
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
       AUTH SPLIT SECTION
    ========================================================= */

    .cm-auth-section {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
        background: #f8fafc;
    }

    .cm-auth-grid {
        width: 100%;
        display: flex;
        justify-content: center;
    }


    /* =========================================================
       RIGHT FORM PANEL
    ========================================================= */

    .cm-auth-form-panel {
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        max-width: 460px;
        padding: 50px 45px;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(15, 23, 42, .08);
        box-sizing: border-box;
    }

    .cm-auth-form-inner {
        width: 100%;
        max-width: 380px;
        text-align: center;
    }

    .cm-form-group,
    form {
        text-align: left;
    }

    .cm-section-label {
        display: inline-block;
        margin-bottom: 8px;
        color: #16a34a;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .cm-auth-form-inner h2 {
        margin: 0 0 8px;
        color: #0f172a;
        font-size: 26px;
        font-weight: 700;
    }

    .cm-auth-form-inner > p {
        margin: 0 0 28px;
        color: #64748b;
        font-size: 13.5px;
        line-height: 1.7;
    }

    .cm-alert-error {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
        padding: 14px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .cm-alert-error ul {
        margin: 0;
        padding-left: 18px;
    }

    .cm-form-group {
        margin-bottom: 20px;
    }

    .cm-form-group label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 7px;
    }

    .cm-form-group input {
        width: 100%;
        padding: 12px 14px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        color: #0f172a;
        box-sizing: border-box;
        transition: .15s ease;
    }

    .cm-form-group input:focus {
        outline: none;
        border-color: #16a34a;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(22, 163, 74, .12);
    }

    .cm-btn-login {
        width: 100%;
        padding: 13px 20px;
        border: none;
        border-radius: 8px;
        background: #22c55e;
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
        font-size: 14.5px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .cm-btn-login:hover {
        background: #16a34a;
    }

    .cm-auth-switch {
        text-align: center;
        margin-top: 22px;
        color: #64748b;
        font-size: 13px;
    }

    .cm-auth-switch a {
        color: #16a34a;
        text-decoration: none !important;
        font-weight: 600;
    }

    .cm-auth-switch a:hover {
        color: #15803d;
    }


    /* =========================================================
       FOOTER
    ========================================================= */

    .cm-footer {
        padding: 22px 0;
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

    @media (max-width: 900px) {

        .cm-auth-form-panel {
            padding: 36px 26px;
        }
    }

    @media (max-width: 576px) {

        .cm-auth-brand h1 {
            font-size: 26px;
        }

        .cm-auth-form-inner h2 {
            font-size: 22px;
        }
    }
</style>


<div class="cm-page">


    <!-- =====================================================
         NAVBAR
    ====================================================== -->

    <div class="cm-navbar-wrap">

        <header class="cm-navbar">

            <div class="cm-navbar-inner">

                <div class="cm-navbar-logo">

                    <a href="{{ url('/') }}">
                        Career<span class="cm-highlight">Mentor</span>
                    </a>

                </div>


                <nav class="cm-navbar-links">

                    <a href="{{ url('/') }}#features">Features</a>

                    <a href="{{ url('/') }}#about">About</a>

                    <a href="{{ url('/') }}#contact">Contact</a>

                </nav>


                <div class="cm-navbar-auth">

                    <a href="{{ route('register') }}" class="cm-navbar-register">
                        Register
                    </a>

                </div>

            </div>

        </header>

    </div>


    <!-- =====================================================
         LOGIN SPLIT SECTION
    ====================================================== -->

    <section class="cm-auth-section">

        <div class="cm-auth-grid">



            <!-- RIGHT — LOGIN FORM -->

            <div class="cm-auth-form-panel">

                <div class="cm-auth-form-inner">

                    <span class="cm-section-label">
                        WELCOME BACK
                    </span>

                    <h2>
                        Login to Your Account
                    </h2>

                    <p>
                        Enter your credentials to access your
                        career mentoring dashboard.
                    </p>


                    @if ($errors->any())

                        <div class="cm-alert-error">

                            <ul>

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form method="POST" action="{{ route('loginn') }}">

                        @csrf

                        <div class="cm-form-group">

                            <label for="email">
                                Username / Email Address
                            </label>

                            <input
                                type="text"
                                id="email"
                                name="login"
                                value="{{ old('login') }}"
                                placeholder="Enter your username or email"
                                required
                                autofocus
                            >

                        </div>


                        <div class="cm-form-group">

                            <label for="password">
                                Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                required
                            >

                        </div>


                        <button type="submit" class="cm-btn-login">
                            Login
                        </button>

                    </form>


                    <p class="cm-auth-switch">
                        Don't have an account?
                        <a href="{{ route('register') }}">Register here</a>
                    </p>

                </div>

            </div>

        </div>

    </section>


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