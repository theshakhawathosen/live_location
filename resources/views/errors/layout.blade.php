<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #0a0a0f;
            --surface: #111118;
            --border: #1e1e2e;
            --text-primary: #e8e8f0;
            --text-muted: #5a5a7a;
            --accent: #ff3c5f;
            --accent-glow: rgba(255, 60, 95, 0.18);
            --accent-subtle: rgba(255, 60, 95, 0.07);
            --grid: rgba(255, 255, 255, 0.025);
        }

        /* === Status-specific themes === */
        body.s-403 {
            --accent: #ff3c5f;
            --accent-glow: rgba(255, 60, 95, 0.18);
            --accent-subtle: rgba(255, 60, 95, 0.07);
        }

        body.s-404 {
            --accent: #f59e0b;
            --accent-glow: rgba(245, 158, 11, 0.18);
            --accent-subtle: rgba(245, 158, 11, 0.07);
        }

        body.s-419 {
            --accent: #a78bfa;
            --accent-glow: rgba(167, 139, 250, 0.18);
            --accent-subtle: rgba(167, 139, 250, 0.07);
        }

        body.s-429 {
            --accent: #fb923c;
            --accent-glow: rgba(251, 146, 60, 0.18);
            --accent-subtle: rgba(251, 146, 60, 0.07);
        }

        body.s-500 {
            --accent: #f87171;
            --accent-glow: rgba(248, 113, 113, 0.18);
            --accent-subtle: rgba(248, 113, 113, 0.07);
        }

        body.s-503 {
            --accent: #38bdf8;
            --accent-glow: rgba(56, 189, 248, 0.18);
            --accent-subtle: rgba(56, 189, 248, 0.07);
        }

        html,
        body {
            min-height: 100vh;
            background-color: var(--bg);
            color: var(--text-primary);
            font-family: 'Syne', sans-serif;
        }

        /* Grid background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(var(--grid) 1px, transparent 1px),
                linear-gradient(90deg, var(--grid) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
            z-index: 0;
        }

        /* Glow blob */
        body::after {
            content: '';
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -60%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.6;
                transform: translate(-50%, -60%) scale(1);
            }

            50% {
                opacity: 1;
                transform: translate(-50%, -60%) scale(1.08);
            }
        }

        .wrapper {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-top: 2px solid var(--accent);
            border-radius: 4px;
            padding: 3rem 3.5rem 3rem;
            max-width: 560px;
            width: 100%;
            position: relative;
            overflow: hidden;
            animation: slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Corner accent */
        .card::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle at bottom right, var(--accent-subtle), transparent 70%);
        }

        .status-code {
            font-family: 'Space Mono', monospace;
            font-size: clamp(5rem, 18vw, 8rem);
            font-weight: 700;
            line-height: 1;
            color: var(--accent);
            letter-spacing: -4px;
            margin-bottom: 0.25rem;
            /* Glitch effect */
            position: relative;
            display: inline-block;
            animation: glitch 6s infinite;
        }

        @keyframes glitch {

            0%,
            90%,
            100% {
                text-shadow: none;
                clip-path: none;
            }

            92% {
                text-shadow: 3px 0 0 rgba(255, 0, 80, 0.6), -3px 0 0 rgba(0, 200, 255, 0.4);
                clip-path: polygon(0 20%, 100% 20%, 100% 40%, 0 40%);
                transform: translateX(-2px);
            }

            94% {
                text-shadow: -3px 0 0 rgba(255, 0, 80, 0.6), 3px 0 0 rgba(0, 200, 255, 0.4);
                clip-path: polygon(0 55%, 100% 55%, 100% 75%, 0 75%);
                transform: translateX(2px);
            }

            96% {
                clip-path: none;
                transform: none;
                text-shadow: none;
            }
        }

        .divider {
            width: 40px;
            height: 2px;
            background: var(--accent);
            margin: 1rem 0 1.25rem;
            border-radius: 2px;
        }

        .error-title {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
        }

        .error-message {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.65;
            font-family: 'Space Mono', monospace;
            font-weight: 400;
        }

        .actions {
            margin-top: 2.5rem;
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.6rem 1.25rem;
            border-radius: 3px;
            font-family: 'Space Mono', monospace;
            font-size: 0.8rem;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            opacity: 0.85;
            transform: translateY(-1px);
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border);
        }

        .btn-ghost:hover {
            border-color: var(--accent);
            color: var(--text-primary);
        }

        .meta {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            color: var(--text-muted);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-dot {
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
            margin-right: 0.4rem;
            animation: blink 1.4s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.2;
            }
        }
    </style>
</head>

<body class="s-@yield('code', '500')">

    <div class="wrapper">
        <div class="card">
            <div class="status-code">@yield('code', '500')</div>
            <div class="divider"></div>
            <div class="error-title">@yield('title', 'Something went wrong')</div>
            <div class="error-message">@yield('message', 'An unexpected error has occurred. Please try again later.')</div>

            <div class="actions">
                <a href="/" class="btn btn-primary">← Go Home</a>
            </div>

            <div class="meta">
                <span>
                    <span class="status-dot"></span>
                    HTTP @yield('code', '500')
                </span>
                <span>{{ date('Y-m-d H:i') }} UTC</span>
            </div>
        </div>
    </div>

</body>

</html>
