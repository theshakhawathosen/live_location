<!doctype html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Login to DIU Routes — Live bus tracking for Dhaka International University students and staff." />
    <title>Login — DIU Routes</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,700;12..96,800&family=Nunito:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Tailwind CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.14.1/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: "class",
        };
    </script>

    <style>
        :root {
            --accent: #00d4d4;
            --accent-dark: #00b0b0;
            --bg-dark: #060d14;
            --bg-card-dark: #0d1b26;
            --bg-light: #f0f7ff;
            --bg-card-light: #ffffff;
            --text-dark: #e2eaf3;
            --text-light: #0d1b26;
            --border-dark: rgba(0, 212, 212, 0.18);
            --border-light: rgba(0, 160, 160, 0.2);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Nunito", sans-serif;
            transition:
                background 0.3s,
                color 0.3s;
        }

        /* Dark theme (default) */
        html[data-theme="dark"] body {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }

        html[data-theme="light"] body {
            background-color: var(--bg-light);
            color: var(--text-light);
        }

        /* Animated background grid */
        .bg-grid {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        html[data-theme="dark"] .bg-grid {
            background-image:
                linear-gradient(rgba(0, 212, 212, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 212, 212, 0.04) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        html[data-theme="light"] .bg-grid {
            background-image:
                linear-gradient(rgba(0, 160, 160, 0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 160, 160, 0.07) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        /* Glow orb */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
            z-index: 0;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            top: -100px;
            left: -100px;
        }

        html[data-theme="dark"] .orb-1 {
            background: rgba(0, 212, 212, 0.08);
        }

        html[data-theme="light"] .orb-1 {
            background: rgba(0, 180, 180, 0.1);
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            bottom: -80px;
            right: -60px;
        }

        html[data-theme="dark"] .orb-2 {
            background: rgba(0, 180, 180, 0.06);
        }

        html[data-theme="light"] .orb-2 {
            background: rgba(0, 212, 212, 0.08);
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            height: 64px;
            border-bottom: 1px solid;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        html[data-theme="dark"] nav {
            background: rgba(6, 13, 20, 0.7);
            border-color: rgba(0, 212, 212, 0.1);
        }

        html[data-theme="light"] nav {
            background: rgba(240, 247, 255, 0.8);
            border-color: rgba(0, 160, 160, 0.15);
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: "Syne", sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            text-decoration: none;
        }

        html[data-theme="dark"] .nav-logo {
            color: #fff;
        }

        html[data-theme="light"] .nav-logo {
            color: var(--text-light);
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: var(--accent);
            border-radius: 10px;
            display: grid;
            place-items: center;
            color: #060d14;
            font-size: 1rem;
        }

        .logo-accent {
            color: var(--accent);
        }

        /* Theme toggle */
        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid;
            cursor: pointer;
            display: grid;
            place-items: center;
            font-size: 1rem;
            transition:
                background 0.2s,
                color 0.2s;
            background: transparent;
        }

        html[data-theme="dark"] .theme-toggle {
            border-color: rgba(0, 212, 212, 0.3);
            color: var(--accent);
        }

        html[data-theme="light"] .theme-toggle {
            border-color: rgba(0, 160, 160, 0.3);
            color: #0d7070;
        }

        .theme-toggle:hover {
            background: rgba(0, 212, 212, 0.1);
        }

        /* Card */
        .card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            border-radius: 20px;
            padding: 2.5rem;
            border: 1px solid;
        }

        html[data-theme="dark"] .card {
            background: var(--bg-card-dark);
            border-color: var(--border-dark);
            box-shadow:
                0 0 60px rgba(0, 212, 212, 0.06),
                0 20px 60px rgba(0, 0, 0, 0.4);
        }

        html[data-theme="light"] .card {
            background: var(--bg-card-light);
            border-color: var(--border-light);
            box-shadow:
                0 8px 40px rgba(0, 160, 160, 0.1),
                0 2px 8px rgba(0, 0, 0, 0.06);
        }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            padding: 5px 14px;
            border-radius: 999px;
            border: 1px solid rgba(0, 212, 212, 0.25);
            margin-bottom: 1.5rem;
        }

        html[data-theme="dark"] .badge {
            background: rgba(0, 212, 212, 0.08);
            color: var(--accent);
        }

        html[data-theme="light"] .badge {
            background: rgba(0, 212, 212, 0.1);
            color: #007575;
        }

        .badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--accent);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.6;
                transform: scale(0.85);
            }
        }

        /* Title */
        .card-title {
            font-family: "Syne", sans-serif;
            font-weight: 800;
            font-size: clamp(1.5rem, 4vw, 1.85rem);
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }

        html[data-theme="dark"] .card-title {
            color: #fff;
        }

        html[data-theme="light"] .card-title {
            color: var(--text-light);
        }

        .card-sub {
            font-size: 0.88rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        html[data-theme="dark"] .card-sub {
            color: #7a9ab5;
        }

        html[data-theme="light"] .card-sub {
            color: #4a6a80;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.78rem;
            margin: 1.5rem 0;
        }

        html[data-theme="dark"] .divider {
            color: #3a5570;
        }

        html[data-theme="light"] .divider {
            color: #9ab5c5;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
        }

        html[data-theme="dark"] .divider::before,
        html[data-theme="dark"] .divider::after {
            background: rgba(0, 212, 212, 0.1);
        }

        html[data-theme="light"] .divider::before,
        html[data-theme="light"] .divider::after {
            background: rgba(0, 160, 160, 0.15);
        }

        /* Google button */
        .btn-google {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 14px 24px;
            border-radius: 12px;
            font-family: "DM Sans", sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            border: 1px solid;
            cursor: pointer;
            transition:
                transform 0.15s,
                box-shadow 0.15s,
                background 0.2s;
            text-decoration: none;
        }

        html[data-theme="dark"] .btn-google {
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(255, 255, 255, 0.1);
            color: #e2eaf3;
        }

        html[data-theme="light"] .btn-google {
            background: #fff;
            border-color: rgba(0, 0, 0, 0.12);
            color: #2d3748;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .btn-google:hover {
            transform: translateY(-2px);
        }

        html[data-theme="dark"] .btn-google:hover {
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        }

        html[data-theme="light"] .btn-google:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-google:active {
            transform: translateY(0);
        }

        /* Google icon SVG */
        .google-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        /* Stats row inside card */
        .stats-row {
            display: flex;
            gap: 0;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid;
            margin-top: 2rem;
        }

        html[data-theme="dark"] .stats-row {
            border-color: rgba(0, 212, 212, 0.1);
        }

        html[data-theme="light"] .stats-row {
            border-color: rgba(0, 160, 160, 0.15);
        }

        .stat-item {
            flex: 1;
            text-align: center;
            padding: 12px 8px;
        }

        html[data-theme="dark"] .stat-item {
            background: rgba(0, 212, 212, 0.04);
        }

        html[data-theme="light"] .stat-item {
            background: rgba(0, 212, 212, 0.04);
        }

        .stat-item+.stat-item {
            border-left: 1px solid;
        }

        html[data-theme="dark"] .stat-item+.stat-item {
            border-color: rgba(0, 212, 212, 0.1);
        }

        html[data-theme="light"] .stat-item+.stat-item {
            border-color: rgba(0, 160, 160, 0.15);
        }

        .stat-val {
            font-family: "Syne", sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: var(--accent);
        }

        .stat-label {
            font-size: 0.68rem;
            margin-top: 2px;
        }

        html[data-theme="dark"] .stat-label {
            color: #5a7a90;
        }

        html[data-theme="light"] .stat-label {
            color: #6a8a9a;
        }

        /* Privacy note */
        .privacy-note {
            font-size: 0.75rem;
            text-align: center;
            margin-top: 1.25rem;
            line-height: 1.5;
        }

        html[data-theme="dark"] .privacy-note {
            color: #3a5570;
        }

        html[data-theme="light"] .privacy-note {
            color: #8aabb8;
        }

        .privacy-note a {
            color: var(--accent);
            text-decoration: none;
        }

        .privacy-note a:hover {
            text-decoration: underline;
        }

        /* Main layout */
        main {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 1rem 2rem;
        }

        /* Fade-in */
        .fade-in {
            animation: fadeIn 0.5s ease both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .card {
                padding: 2rem 1.5rem;
            }

            nav {
                padding: 0 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Background -->
    <div class="bg-grid"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- Main Content -->
    <main>
        <div class="card fade-in" role="main">
            <!-- Badge -->
            <div class="badge">
                <span class="badge-dot"></span>
                Live Tracking · Dhaka International University
            </div>

            <!-- Title -->
            <h1 class="card-title">
                Welcome to<br />
                <span style="color: var(--accent)">DIU Routes</span>
            </h1>
            <p class="card-sub">
                Sign in to track your bus in real-time on campus. Connect students
                &amp; drivers on a single Google Maps platform.
            </p>

            <!-- Google Sign In -->
            <a href="{{ route('login.redirect') }}" class="btn-google" role="button" aria-label="Continue with Google">
                <!-- Google SVG logo -->
                <svg class="google-icon" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path fill="#EA4335"
                        d="M24 9.5c3.15 0 5.64 1.08 7.74 2.84l5.77-5.77C33.74 3.52 29.18 1.5 24 1.5 14.84 1.5 7.1 7.22 4.02 15.1l6.72 5.22C12.36 14.02 17.7 9.5 24 9.5z" />
                    <path fill="#4285F4"
                        d="M46.5 24c0-1.6-.14-3.14-.4-4.64H24v8.78h12.7c-.55 2.94-2.2 5.44-4.67 7.12l7.24 5.62C43.44 36.82 46.5 30.86 46.5 24z" />
                    <path fill="#FBBC05"
                        d="M10.74 28.32A14.55 14.55 0 0 1 9.5 24c0-1.5.26-2.94.74-4.32L3.52 14.46A23.43 23.43 0 0 0 1.5 24c0 3.76.9 7.32 2.52 10.46l6.72-6.14z" />
                    <path fill="#34A853"
                        d="M24 46.5c5.18 0 9.52-1.7 12.7-4.62l-7.24-5.62c-1.96 1.32-4.46 2.12-5.46 2.12-6.3 0-11.64-4.52-13.26-10.52l-6.72 6.14C7.1 40.78 14.84 46.5 24 46.5z" />
                </svg>
                Continue with Google
            </a>


            <!-- Privacy -->
            <p class="privacy-note">
                By continuing, you agree to our <a href="#">Terms of Service</a> and
                <a href="#">Privacy Policy</a>.<br />
                DIU student or staff Google account required.
            </p>
        </div>
    </main>

    <script>
        const html = document.documentElement;
        const toggle = document.getElementById("themeToggle");
        const icon = document.getElementById("themeIcon");

        // Load saved preference
        const saved = localStorage.getItem("diuroutes-theme") || "dark";
        setTheme(saved);

        toggle.addEventListener("click", () => {
            const next =
                html.getAttribute("data-theme") === "dark" ? "light" : "dark";
            setTheme(next);
            localStorage.setItem("diuroutes-theme", next);
        });

        function setTheme(t) {
            html.setAttribute("data-theme", t);
            if (t === "dark") {
                icon.className = "fa-solid fa-moon";
                toggle.setAttribute("aria-label", "Switch to light mode");
            } else {
                icon.className = "fa-solid fa-sun";
                toggle.setAttribute("aria-label", "Switch to dark mode");
            }
        }
    </script>
</body>

</html>
