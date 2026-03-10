<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login — DIU Routes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html[data-theme="dark"] {
            --bg: #09090b;
            --surface: #111113;
            --border: #1f1f23;
            --text: #fafafa;
            --muted: #71717a;
            --accent: #16c479;
            --btn-bg: #18181b;
            --btn-hover: #1f1f23;
            --shadow: 0 0 0 1px #1f1f23, 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        html[data-theme="light"] {
            --bg: #f8f8f8;
            --surface: #ffffff;
            --border: #e4e4e7;
            --text: #09090b;
            --muted: #71717a;
            --accent: #16a067;
            --btn-bg: #fafafa;
            --btn-hover: #f4f4f5;
            --shadow: 0 0 0 1px #e4e4e7, 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        body {
            font-family: 'Geist', -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 1.5rem;
            transition: background 0.2s, color 0.2s;
        }

        /* Theme toggle */
        .theme-btn {
            position: fixed;
            top: 1.25rem;
            right: 1.25rem;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--surface);
            cursor: pointer;
            display: grid;
            place-items: center;
            color: var(--muted);
            font-size: 13px;
            transition: all 0.15s;
            overflow: hidden;
        }

        .theme-btn:hover {
            color: var(--text);
            border-color: var(--muted);
        }

        .t-sun,
        .t-moon {
            position: absolute;
            transition: transform 0.3s cubic-bezier(0.34, 1.5, 0.64, 1), opacity 0.2s;
        }

        html[data-theme="dark"] .t-sun {
            transform: translateY(-16px);
            opacity: 0;
        }

        html[data-theme="dark"] .t-moon {
            transform: translateY(0);
            opacity: 1;
        }

        html[data-theme="light"] .t-sun {
            transform: translateY(0);
            opacity: 1;
        }

        html[data-theme="light"] .t-moon {
            transform: translateY(16px);
            opacity: 0;
        }

        /* Card */
        .card {
            width: 100%;
            max-width: 380px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2.25rem 2rem;
            box-shadow: var(--shadow);
            animation: rise 0.4s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes rise {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Logo */
        .logo-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2rem;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--accent);
            display: grid;
            place-items: center;
            flex-shrink: 0;
            position: relative;
        }

        .logo-icon i {
            color: #fff;
            font-size: 14px;
        }

        .live-pip {
            position: absolute;
            bottom: -2px;
            right: -2px;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #4ade80;
            border: 2px solid var(--surface);
            animation: pip 2s ease-in-out infinite;
        }

        @keyframes pip {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.25;
            }
        }

        .logo-name {
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            color: var(--text);
        }

        .logo-name span {
            color: var(--accent);
            font-weight: 400;
        }

        /* Heading */
        h1 {
            font-size: 1.45rem;
            font-weight: 600;
            letter-spacing: -0.04em;
            line-height: 1.3;
            margin-bottom: 0.45rem;
        }

        .sub {
            font-size: 0.82rem;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 1.75rem;
        }

        /* Google button */
        .btn-google {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 11px 18px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--btn-bg);
            color: var(--text);
            font-family: inherit;
            font-size: 0.875rem;
            font-weight: 500;
            letter-spacing: -0.01em;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s, transform 0.12s;
        }

        .btn-google:hover {
            background: var(--btn-hover);
            border-color: var(--muted);
            transform: translateY(-1px);
        }

        .btn-google:active {
            transform: translateY(0);
        }

        .g-icon {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
        }

        hr {
            border: none;
            border-top: 1px solid var(--border);
            margin: 1.5rem 0;
        }

        .note {
            font-size: 0.72rem;
            color: var(--muted);
            line-height: 1.65;
            text-align: center;
        }

        .note a {
            color: var(--muted);
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .note a:hover {
            color: var(--text);
        }
    </style>
</head>

<body>

    <button class="theme-btn" id="themeToggle" aria-label="Toggle theme">
        <i class="fa-solid fa-sun t-sun" style="color:#f59e0b;"></i>
        <i class="fa-solid fa-moon t-moon" style="color:#818cf8;"></i>
    </button>

    <div class="card">

        <div class="logo-row">
            <div class="logo-icon">
                <i class="fa-solid fa-bus"></i>
                <div class="live-pip"></div>
            </div>
            <div class="logo-name">DIU <span>Routes</span></div>
        </div>

        <h1>Sign in to your account</h1>
        <p class="sub">Track your bus live. Use your DIU Google account to continue.</p>

        <a href="{{ route('login.redirect') }}" class="btn-google">
            <svg class="g-icon" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
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

        <hr />

        <p class="note">
            By continuing, you agree to our <a href="#">Terms</a> &amp; <a href="#">Privacy
                Policy</a>.<br />
            DIU student or staff account required.
        </p>

    </div>

    <script>
        const html = document.documentElement;
        const btn = document.getElementById('themeToggle');
        html.setAttribute('data-theme', localStorage.getItem('diu-theme') || 'dark');
        btn.addEventListener('click', () => {
            const t = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', t);
            localStorage.setItem('diu-theme', t);
        });
    </script>

</body>

</html>
