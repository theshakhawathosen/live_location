<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="DIU Routes – Real-time bus tracking for Dhaka International University. Students track buses live on Google Maps, drivers manage routes." />
    <meta name="keywords"
        content="DIU Routes, DIU bus tracker, Dhaka International University transport, real-time tracking, university bus" />
    <meta name="author" content="DIU Routes" />
    <title>DIU Routes – Live Campus Transport Tracker</title>

    <!-- Google Fonts: Bricolage Grotesque + Nunito -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,700;12..96,800&family=Nunito:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome 6 (latest) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <script>
        tailwind.config = {
            darkMode: ['attribute', '[data-theme="dark"]'],
            theme: {
                extend: {}
            },
        };
    </script>

    <style>
        /* ══ CSS Variables ══ */
        :root {
            --bg-base: #eef2f7;
            --bg-card: #ffffff;
            --bg-card2: #e3eaf3;
            --txt-1: #0c1a2b;
            --txt-2: #3d5166;
            --txt-m: #6b849c;
            --border: rgba(14, 165, 168, .18);
            --accent: #0ea5a8;
            --accent2: #06b6d4;
            --glow: rgba(14, 165, 168, .20);
            --nav-bg: rgba(238, 242, 247, .90);
            --dot-c: rgba(14, 165, 168, .10);
        }

        [data-theme="dark"] {
            --bg-base: #060f1a;
            --bg-card: #0c1f30;
            --bg-card2: #091826;
            --txt-1: #dff0f5;
            --txt-2: #7aafc4;
            --txt-m: #3d6a82;
            --border: rgba(14, 165, 168, .16);
            --accent: #22d3d8;
            --accent2: #38bdf8;
            --glow: rgba(34, 211, 216, .16);
            --nav-bg: rgba(6, 15, 26, .92);
            --dot-c: rgba(34, 211, 216, .07);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--bg-base);
            color: var(--txt-1);
            transition: background .35s, color .35s;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Bricolage Grotesque', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-base);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 99px;
        }

        /* ── Navbar ── */
        #navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: var(--nav-bg);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--border);
            transition: background .35s, box-shadow .3s;
        }

        #theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            background: var(--bg-card);
            color: var(--accent);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            transition: transform .25s;
        }

        #theme-toggle:hover {
            transform: rotate(22deg) scale(1.1);
        }

        /* ── Hero ── */
        .hero-bg {
            background-image: radial-gradient(circle, var(--dot-c) 1.5px, transparent 1.5px);
            background-size: 36px 36px;
        }

        /* ── Grad text ── */
        .grad {
            background: linear-gradient(130deg, var(--accent) 0%, var(--accent2) 55%, #a5f3fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Pill ── */
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 16px;
            border-radius: 99px;
            border: 1px solid var(--border);
            background: var(--glow);
            color: var(--accent);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .03em;
        }

        /* ── Card ── */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 22px;
            transition: transform .25s, box-shadow .25s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 44px var(--glow);
        }

        /* ── Feature icon ── */
        .fi {
            width: 54px;
            height: 54px;
            border-radius: 15px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background: var(--glow);
            color: var(--accent);
            border: 1px solid var(--border);
        }

        /* ── Stat ── */
        .stat {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 2.4rem;
            font-weight: 800;
            background: linear-gradient(130deg, var(--accent), var(--accent2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--accent);
            color: #fff;
            padding: 14px 28px;
            border-radius: 12px;
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 20px var(--glow);
            transition: filter .2s, transform .2s, box-shadow .2s;
        }

        .btn:hover {
            filter: brightness(1.12);
            transform: translateY(-2px);
            box-shadow: 0 8px 34px var(--glow);
        }

        .btn-o {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            color: var(--accent);
            padding: 13px 26px;
            border-radius: 12px;
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            border: 2px solid var(--accent);
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .btn-o:hover {
            background: var(--glow);
            transform: translateY(-2px);
        }

        /* ── Map mockup ── */
        .map-wrap {
            border-radius: 22px;
            overflow: hidden;
            border: 2px solid var(--border);
            box-shadow: 0 28px 70px rgba(0, 0, 0, .28);
            position: relative;
        }

        .map-wrap::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 50%, var(--bg-base) 100%);
            pointer-events: none;
        }

        /* ── Pulse dot ── */
        @keyframes pd {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(34, 211, 216, .55)
            }

            50% {
                box-shadow: 0 0 0 9px rgba(34, 211, 216, 0)
            }
        }

        .pdot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--accent);
            animation: pd 1.9s infinite;
            flex-shrink: 0;
        }

        /* ── Route anim ── */
        @keyframes dash {
            to {
                stroke-dashoffset: -200;
            }
        }

        .ra {
            animation: dash 3.5s linear infinite;
        }

        /* ── Reveal ── */
        .rev {
            opacity: 0;
            transform: translateY(26px);
            transition: opacity .6s ease, transform .6s ease;
        }

        .rev.on {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── Mobile nav ── */
        #mob {
            display: none;
        }

        #mob.open {
            display: flex;
        }

        /* ── Sec label ── */
        .slb {
            font-size: 11.5px;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
            color: var(--accent);
        }

        /* ── FAQ ── */
        .faq-item {
            border-bottom: 1px solid var(--border);
        }

        .faq-btn {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 0;
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 700;
            font-size: 16px;
            color: var(--txt-1);
            gap: 12px;
        }

        .faq-btn .ch {
            color: var(--accent);
            transition: transform .3s;
            flex-shrink: 0;
        }

        .faq-btn.open .ch {
            transform: rotate(180deg);
        }

        .faq-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height .4s ease;
        }

        .faq-body.open {
            max-height: 200px;
        }

        .faq-body p {
            padding-bottom: 16px;
            font-size: 15px;
            color: var(--txt-2);
            line-height: 1.75;
        }

        /* ── Toast ── */
        #toast {
            position: fixed;
            bottom: 26px;
            right: 26px;
            z-index: 999;
            background: var(--bg-card);
            border: 1px solid var(--accent);
            color: var(--txt-1);
            padding: 13px 20px;
            border-radius: 12px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, .22);
            transform: translateX(130%);
            transition: transform .4s cubic-bezier(.17, .67, .27, 1.3);
        }

        #toast.show {
            transform: translateX(0);
        }

        /* ── Footer link ── */
        .fl {
            color: var(--txt-m);
            text-decoration: none;
            font-size: 14px;
            transition: color .2s;
        }

        .fl:hover {
            color: var(--accent);
        }

        /* ── Bounce ── */
        @keyframes by {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(7px)
            }
        }

        .by {
            animation: by 1.7s ease-in-out infinite;
        }

        /* ── Tech logos ── */
        .tlogo {
            height: 34px;
            width: auto;
            max-width: 130px;
            object-fit: contain;
            opacity: .72;
            filter: grayscale(25%);
            transition: opacity .25s, filter .25s, transform .25s;
        }

        .tlogo:hover {
            opacity: 1;
            filter: grayscale(0%);
            transform: scale(1.06);
        }

        [data-theme="dark"] .tlogo {
            filter: grayscale(15%) brightness(1.15);
        }

        [data-theme="dark"] .tlogo:hover {
            filter: grayscale(0%) brightness(1.22);
        }
    </style>
</head>

<body>

    <!-- ════════ NAVBAR ════════ -->
    <nav id="navbar" role="navigation" aria-label="Main navigation">
        <div class="max-w-7xl mx-auto px-5 flex items-center justify-between h-16">

            <a href="{{ route('homepage') }}" class="flex items-center gap-2.5" aria-label="DIU Routes Home">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white"
                    style="background:var(--accent); font-size:14px;">
                    <i class="fa-solid fa-bus-simple"></i>
                </div>
                <span
                    style="font-family:'Bricolage Grotesque',sans-serif; font-weight:800; font-size:18px; color:var(--txt-1);">
                    DIU<span style="color:var(--accent);">Routes</span>
                </span>
            </a>

            <ul class="hidden md:flex items-center gap-8 list-none" style="font-size:15px; font-weight:600;">
                <li><a href="#features" style="color:var(--txt-2);"
                        class="hover:text-[var(--accent)] transition-colors">Features</a></li>
                <li><a href="#roles" style="color:var(--txt-2);"
                        class="hover:text-[var(--accent)] transition-colors">Roles</a></li>
                <li><a href="#how-it-works" style="color:var(--txt-2);"
                        class="hover:text-[var(--accent)] transition-colors">How It Works</a></li>
                <li><a href="#faq" style="color:var(--txt-2);"
                        class="hover:text-[var(--accent)] transition-colors">FAQ</a></li>
            </ul>

            <div class="flex items-center gap-3">
                <button id="theme-toggle" aria-label="Toggle light/dark mode">
                    <i class="fa-solid fa-moon" id="theme-icon"></i>
                </button>
                <a href="{{ route('login') }}" class="hidden sm:inline-flex btn py-2.5 px-5 text-sm">
                    <i class="fa-solid fa-right-to-bracket"></i> Login
                </a>
                <button id="ham" class="md:hidden w-10 h-10 flex items-center justify-center rounded-xl"
                    style="border:1.5px solid var(--border); background:var(--bg-card); color:var(--txt-1);"
                    aria-label="Open menu" aria-expanded="false">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>

        <div id="mob" class="flex-col px-5 pb-5 gap-1 md:hidden"
            style="border-top:1px solid var(--border); background:var(--nav-bg);">
            <a href="#features" class="mlink block py-3 fl text-base"
                style="border-bottom:1px solid var(--border);">Features</a>
            <a href="#roles" class="mlink block py-3 fl text-base"
                style="border-bottom:1px solid var(--border);">Roles</a>
            <a href="#how-it-works" class="mlink block py-3 fl text-base"
                style="border-bottom:1px solid var(--border);">How It Works</a>
            <a href="#faq" class="mlink block py-3 fl text-base">FAQ</a>
            <a href="{{ route('login') }}" class="btn mt-4 justify-center"><i class="fa-solid fa-right-to-bracket"></i>
                Login</a>
        </div>
    </nav>


    <!-- ════════ HERO ════════ -->
    <section
        class="hero-bg min-h-screen flex flex-col items-center justify-center text-center pt-24 pb-16 px-5 relative"
        aria-labelledby="hero-h">

        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div
                style="width:700px;height:700px;border-radius:50%;background:radial-gradient(circle,var(--glow) 0%,transparent 68%);position:absolute;top:5%;left:50%;transform:translateX(-50%);filter:blur(50px);opacity:.5;">
            </div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto">
            <div class="pill mb-7">
                <div class="pdot"></div>
                Live Tracking · Dhaka International University
            </div>

            <h1 id="hero-h"
                style="font-size:clamp(2.2rem,5.8vw,4rem); font-weight:800; line-height:1.15; color:var(--txt-1); margin-bottom:22px;">
                Know Exactly Where<br />
                <span class="grad">Your Bus Is — Right Now.</span>
            </h1>

            <p style="font-size:17px; color:var(--txt-2); line-height:1.8; max-width:540px; margin:0 auto 38px;">
                DIU Routes connects students and drivers on a single real-time Google Maps platform — built for
                <strong style="color:var(--txt-1);">Dhaka International University</strong>.
            </p>

            <div class="flex flex-wrap justify-center gap-4 mb-14">
                <a href="#get-started" class="btn"><i class="fa-solid fa-location-dot"></i> Track Live Now</a>
                <a href="#how-it-works" class="btn-o"><i class="fa-regular fa-circle-play"></i> How It Works</a>
            </div>

            <div class="flex flex-wrap justify-center items-center gap-10">
                <div>
                    <div class="stat">12+</div>
                    <div style="font-size:13px;color:var(--txt-m);font-weight:600;">Active Routes</div>
                </div>
                <div style="width:1px;height:40px;background:var(--border);"></div>
                <div>
                    <div class="stat">3K+</div>
                    <div style="font-size:13px;color:var(--txt-m);font-weight:600;">Students Served</div>
                </div>
                <div style="width:1px;height:40px;background:var(--border);"></div>
                <div>
                    <div class="stat">24/7</div>
                    <div style="font-size:13px;color:var(--txt-m);font-weight:600;">Live Tracking</div>
                </div>
                <div style="width:1px;height:40px;background:var(--border);"></div>
                <div>
                    <div class="stat" style="font-size:1.6rem;">Real-Time</div>
                    <div style="font-size:13px;color:var(--txt-m);font-weight:600;">GPS Updates</div>
                </div>
            </div>
        </div>

        <!-- Map mockup -->
        <div class="relative z-10 mt-16 w-full max-w-5xl mx-auto map-wrap rev">
            <svg viewBox="0 0 960 430" xmlns="http://www.w3.org/2000/svg"
                style="width:100%;display:block;background:var(--bg-card2);">
                <line x1="0" y1="145" x2="960" y2="145" stroke="var(--border)"
                    stroke-width="1.5" />
                <line x1="0" y1="290" x2="960" y2="290" stroke="var(--border)"
                    stroke-width="1.5" />
                <line x1="165" y1="0" x2="165" y2="430" stroke="var(--border)"
                    stroke-width="1.5" />
                <line x1="490" y1="0" x2="490" y2="430" stroke="var(--border)"
                    stroke-width="1.5" />
                <line x1="810" y1="0" x2="810" y2="430" stroke="var(--border)"
                    stroke-width="1.5" />
                <rect x="25" y="25" width="115" height="100" rx="7" fill="var(--bg-card)"
                    opacity=".55" />
                <rect x="205" y="40" width="255" height="82" rx="7" fill="var(--bg-card)"
                    opacity=".55" />
                <rect x="520" y="25" width="265" height="100" rx="7" fill="var(--bg-card)"
                    opacity=".55" />
                <rect x="25" y="175" width="115" height="95" rx="7" fill="var(--bg-card)"
                    opacity=".55" />
                <rect x="205" y="165" width="255" height="105" rx="7" fill="var(--bg-card)"
                    opacity=".55" />
                <rect x="520" y="165" width="265" height="105" rx="7" fill="var(--bg-card)"
                    opacity=".55" />
                <rect x="25" y="310" width="115" height="95" rx="7" fill="var(--bg-card)"
                    opacity=".55" />
                <rect x="205" y="310" width="255" height="95" rx="7" fill="var(--bg-card)"
                    opacity=".55" />
                <rect x="520" y="310" width="265" height="95" rx="7" fill="var(--bg-card)"
                    opacity=".55" />
                <text x="333" y="218" text-anchor="middle" font-family="Bricolage Grotesque,sans-serif"
                    font-size="11" font-weight="800" fill="var(--accent)" opacity=".85" letter-spacing="1">DIU
                    MAIN CAMPUS</text>
                <polyline points="82,410 82,215 165,215 490,215 490,145 810,145 810,55 895,55" fill="none"
                    stroke="var(--accent)" stroke-width="3.5" stroke-dasharray="14 9" class="ra"
                    opacity=".9" />
                <circle cx="360" cy="215" r="17" fill="var(--accent)" />
                <text x="360" y="220" text-anchor="middle" font-size="14" fill="white">🚌</text>
                <circle cx="360" cy="215" r="17" fill="none" stroke="var(--accent)" stroke-width="2"
                    opacity=".3">
                    <animate attributeName="r" values="17;30;17" dur="2.2s" repeatCount="indefinite" />
                    <animate attributeName="opacity" values="0.35;0;0.35" dur="2.2s" repeatCount="indefinite" />
                </circle>
                <circle cx="210" cy="145" r="8" fill="#f97316" />
                <circle cx="210" cy="145" r="14" fill="none" stroke="#f97316" stroke-width="1.5"
                    opacity=".45" />
                <circle cx="490" cy="290" r="8" fill="#f97316" />
                <circle cx="490" cy="290" r="14" fill="none" stroke="#f97316" stroke-width="1.5"
                    opacity=".45" />
                <circle cx="650" cy="145" r="8" fill="#22c55e" />
                <rect x="368" y="148" width="148" height="50" rx="9" fill="var(--bg-card)"
                    stroke="var(--accent)" stroke-width="1.5" />
                <text x="388" y="169" font-family="Bricolage Grotesque,sans-serif" font-size="10.5" font-weight="700"
                    fill="var(--txt-1)">Route 04 · Bus B</text>
                <circle cx="387" cy="185" r="4" fill="var(--accent)" />
                <text x="396" y="189" font-family="Nunito,sans-serif" font-size="9.5" fill="var(--txt-2)">ETA: 3 min
                    · On time</text>
                <circle cx="910" cy="380" r="24" fill="var(--bg-card)" stroke="var(--border)"
                    stroke-width="1.5" />
                <text x="910" y="386" text-anchor="middle" font-size="12" fill="var(--accent)" font-weight="700">N
                    ↑</text>
            </svg>
        </div>

        <a href="#features" class="absolute bottom-6 left-1/2 -translate-x-1/2 by flex flex-col items-center gap-1"
            style="color:var(--txt-m); text-decoration:none;">
            <span style="font-size:11px; letter-spacing:.07em; font-weight:700;">SCROLL</span>
            <i class="fa-solid fa-chevron-down text-sm" style="color:var(--accent);"></i>
        </a>
    </section>


    <!-- ════════ FEATURES ════════ -->
    <section id="features" class="py-24 px-5" aria-labelledby="feat-h">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 rev">
                <div class="slb mb-3">Platform Features</div>
                <h2 id="feat-h"
                    style="font-size:clamp(1.9rem,4vw,2.8rem); font-weight:800; color:var(--txt-1); margin-bottom:14px;">
                    Everything to Keep You<br /><span class="grad">On Schedule</span>
                </h2>
                <p style="color:var(--txt-2); max-width:490px; margin:0 auto; line-height:1.75; font-size:15px;">
                    Real-time GPS, smart notifications, and seamless route management — all in one platform.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <article class="card p-7 rev">
                    <div class="fi mb-5"><i class="fa-solid fa-location-crosshairs"></i></div>
                    <h3 style="font-size:17px;font-weight:700;color:var(--txt-1);margin-bottom:9px;">Real-Time GPS
                        Tracking</h3>
                    <p style="color:var(--txt-2);font-size:14px;line-height:1.75;">Watch every bus move live on Google
                        Maps, updated every few seconds — no manual refresh needed.</p>
                </article>
                <article class="card p-7 rev">
                    <div class="fi mb-5"><i class="fa-solid fa-bell"></i></div>
                    <h3 style="font-size:17px;font-weight:700;color:var(--txt-1);margin-bottom:9px;">Arrival
                        Notifications</h3>
                    <p style="color:var(--txt-2);font-size:14px;line-height:1.75;">Get alerted when your bus is 5
                        minutes away so you never miss your ride again.</p>
                </article>
                <article class="card p-7 rev">
                    <div class="fi mb-5"><i class="fa-solid fa-route"></i></div>
                    <h3 style="font-size:17px;font-weight:700;color:var(--txt-1);margin-bottom:9px;">Smart Route
                        Planning</h3>
                    <p style="color:var(--txt-2);font-size:14px;line-height:1.75;">Browse all DIU routes, pick your
                        nearest stop, and plan your commute with confidence every day.</p>
                </article>
                <article class="card p-7 rev">
                    <div class="fi mb-5"><i class="fa-solid fa-users-viewfinder"></i></div>
                    <h3 style="font-size:17px;font-weight:700;color:var(--txt-1);margin-bottom:9px;">Driver View — See
                        Your Students</h3>
                    <p style="color:var(--txt-2);font-size:14px;line-height:1.75;">Drivers see student pick-up pins on
                        their own map, making route management faster and smarter.</p>
                </article>
                <article class="card p-7 rev">
                    <div class="fi mb-5"><i class="fa-solid fa-map-location-dot"></i></div>
                    <h3 style="font-size:17px;font-weight:700;color:var(--txt-1);margin-bottom:9px;">Google Maps
                        Integration</h3>
                    <p style="color:var(--txt-2);font-size:14px;line-height:1.75;">Powered by Google Maps JavaScript
                        API for accurate, familiar, and fluid navigation for everyone.</p>
                </article>
                <article class="card p-7 rev">
                    <div class="fi mb-5"><i class="fa-solid fa-shield-halved"></i></div>
                    <h3 style="font-size:17px;font-weight:700;color:var(--txt-1);margin-bottom:9px;">Secure Role-Based
                        Access</h3>
                    <p style="color:var(--txt-2);font-size:14px;line-height:1.75;">Student and Driver roles — each with
                        precisely scoped permissions and secure, encrypted logins.</p>
                </article>
            </div>
        </div>
    </section>


    <!-- ════════ ROLES ════════ -->
    <section id="roles" class="py-24 px-5" style="background:var(--bg-card2);" aria-labelledby="roles-h">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16 rev">
                <div class="slb mb-3">Two Portals, One Platform</div>
                <h2 id="roles-h"
                    style="font-size:clamp(1.9rem,4vw,2.8rem); font-weight:800; color:var(--txt-1); margin-bottom:14px;">
                    Built for <span class="grad">Every Role</span>
                </h2>
                <p style="color:var(--txt-2); max-width:430px; margin:0 auto; font-size:15px; line-height:1.75;">
                    Choose your portal and experience a tailored interface designed around your daily needs.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">

                <!-- Student -->
                <article class="card p-8 rev" style="border-top:3px solid #f97316;">
                    <div
                        style="width:72px;height:72px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px;border:2px solid #f9731630;background:#f9731610;color:#f97316;margin:0 auto 20px;">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <h3
                        style="font-size:20px;font-weight:800;color:var(--txt-1);text-align:center;margin-bottom:12px;">
                        Student</h3>
                    <p style="color:var(--txt-2);font-size:14px;line-height:1.8;margin-bottom:22px;text-align:center;">
                        View live bus positions on Google Maps, check ETAs, browse all active routes, and receive timely
                        arrival alerts — from any device.
                    </p>
                    <ul
                        style="font-size:13.5px;color:var(--txt-2);display:flex;flex-direction:column;gap:10px;margin-bottom:28px;">
                        <li style="display:flex;align-items:center;gap:9px;"><i class="fa-solid fa-check"
                                style="color:#f97316;"></i> Live map with real-time bus positions</li>
                        <li style="display:flex;align-items:center;gap:9px;"><i class="fa-solid fa-check"
                                style="color:#f97316;"></i> ETA countdowns &amp; arrival alerts</li>
                        <li style="display:flex;align-items:center;gap:9px;"><i class="fa-solid fa-check"
                                style="color:#f97316;"></i> Route browsing &amp; stop info</li>
                        <li style="display:flex;align-items:center;gap:9px;"><i class="fa-solid fa-check"
                                style="color:#f97316;"></i> Daily schedule view</li>
                    </ul>
                    <a href="{{ route('login') }}" class="btn w-full justify-center"
                        style="background:#f97316;box-shadow:0 4px 20px #f9731635;">
                        Student Login &nbsp;<i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </article>

                <!-- Driver -->
                <article class="card p-8 rev" style="border-top:3px solid var(--accent);">
                    <div
                        style="width:72px;height:72px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px;border:2px solid var(--border);background:var(--glow);color:var(--accent);margin:0 auto 20px;">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <h3
                        style="font-size:20px;font-weight:800;color:var(--txt-1);text-align:center;margin-bottom:12px;">
                        Driver</h3>
                    <p style="color:var(--txt-2);font-size:14px;line-height:1.8;margin-bottom:22px;text-align:center;">
                        Broadcast your live GPS location, see student pick-up requests on the map, and manage your
                        assigned route for the day.
                    </p>
                    <ul
                        style="font-size:13.5px;color:var(--txt-2);display:flex;flex-direction:column;gap:10px;margin-bottom:28px;">
                        <li style="display:flex;align-items:center;gap:9px;"><i class="fa-solid fa-check"
                                style="color:var(--accent);"></i> Broadcast live GPS position</li>
                        <li style="display:flex;align-items:center;gap:9px;"><i class="fa-solid fa-check"
                                style="color:var(--accent);"></i> View students on interactive map</li>
                        <li style="display:flex;align-items:center;gap:9px;"><i class="fa-solid fa-check"
                                style="color:var(--accent);"></i> Route assignment &amp; management</li>
                        <li style="display:flex;align-items:center;gap:9px;"><i class="fa-solid fa-check"
                                style="color:var(--accent);"></i> Trip status updates</li>
                    </ul>
                    <a href="{{ route('login') }}" class="btn w-full justify-center">
                        Driver Login &nbsp;<i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </article>

            </div>
        </div>
    </section>


    <!-- ════════ HOW IT WORKS ════════ -->
    <section id="how-it-works" class="py-24 px-5" aria-labelledby="hiw-h">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16 rev">
                <div class="slb mb-3">Simple Process</div>
                <h2 id="hiw-h"
                    style="font-size:clamp(1.9rem,4vw,2.8rem); font-weight:800; color:var(--txt-1); margin-bottom:14px;">
                    Up &amp; Running in <span class="grad">3 Steps</span>
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card p-8 text-center rev">
                    <div
                        style="width:64px;height:64px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Bricolage Grotesque',sans-serif;font-size:24px;font-weight:900;background:var(--glow);border:2px solid var(--accent);color:var(--accent);margin:0 auto 22px;">
                        1</div>
                    <h3 style="font-size:17px;font-weight:700;color:var(--txt-1);margin-bottom:10px;">Login with Your
                        Role</h3>
                    <p style="color:var(--txt-2);font-size:14px;line-height:1.75;">Sign in as a Student or Driver. Your
                        personalized dashboard and permissions are instantly ready.</p>
                </div>
                <div class="card p-8 text-center rev">
                    <div
                        style="width:64px;height:64px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Bricolage Grotesque',sans-serif;font-size:24px;font-weight:900;background:var(--glow);border:2px solid var(--accent);color:var(--accent);margin:0 auto 22px;">
                        2</div>
                    <h3 style="font-size:17px;font-weight:700;color:var(--txt-1);margin-bottom:10px;">Open the Live Map
                    </h3>
                    <p style="color:var(--txt-2);font-size:14px;line-height:1.75;">Powered by Google Maps API — see
                        active buses, your assigned route, or students awaiting pickup in real time.</p>
                </div>
                <div class="card p-8 text-center rev">
                    <div
                        style="width:64px;height:64px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Bricolage Grotesque',sans-serif;font-size:24px;font-weight:900;background:var(--glow);border:2px solid var(--accent);color:var(--accent);margin:0 auto 22px;">
                        3</div>
                    <h3 style="font-size:17px;font-weight:700;color:var(--txt-1);margin-bottom:10px;">Stay Informed
                    </h3>
                    <p style="color:var(--txt-2);font-size:14px;line-height:1.75;">Receive notifications, track your
                        route, and keep the whole DIU transport system running smoothly.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- ════════ POWERED BY (real PNG logos) ════════ -->
    <section class="py-16 px-5"
        style="background:var(--bg-card2); border-top:1px solid var(--border); border-bottom:1px solid var(--border);"
        aria-label="Technology stack">
        <div class="max-w-5xl mx-auto">
            <p class="text-center slb mb-10">Powered By</p>
            <div class="flex flex-wrap items-center justify-center gap-10 md:gap-16">

                <!-- Google Maps – PNG from Wikimedia -->
                <a href="https://developers.google.com/maps" target="_blank" rel="noopener"
                    aria-label="Google Maps API">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Google_Maps_Logo_2020.svg/512px-Google_Maps_Logo_2020.svg.png"
                        alt="Google Maps API" class="tlogo" loading="lazy" />
                </a>

                <!-- Firebase – PNG from Wikimedia -->
                <a href="https://firebase.google.com" target="_blank" rel="noopener" aria-label="Firebase">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/37/Firebase_Logo_2016.svg/512px-Firebase_Logo_2016.svg.png"
                        alt="Firebase" class="tlogo" loading="lazy" />
                </a>

                <!-- Node.js – PNG from Wikimedia -->
                <a href="https://nodejs.org" target="_blank" rel="noopener" aria-label="Node.js">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d9/Node.js_logo.svg/512px-Node.js_logo.svg.png"
                        alt="Node.js" class="tlogo" loading="lazy" />
                </a>

                <!-- MongoDB – PNG from Wikimedia -->
                <a href="https://www.mongodb.com" target="_blank" rel="noopener" aria-label="MongoDB">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/93/MongoDB_Logo.svg/512px-MongoDB_Logo.svg.png"
                        alt="MongoDB" class="tlogo" loading="lazy" />
                </a>

                <!-- Google Cloud – PNG from Wikimedia -->
                <a href="https://cloud.google.com" target="_blank" rel="noopener" aria-label="Google Cloud">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Google_Cloud_logo.svg/512px-Google_Cloud_logo.svg.png"
                        alt="Google Cloud" class="tlogo" loading="lazy" />
                </a>

            </div>
        </div>
    </section>


    <!-- ════════ FAQ ════════ -->
    <section id="faq" class="py-24 px-5" aria-labelledby="faq-h">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-14 rev">
                <div class="slb mb-3">Got Questions?</div>
                <h2 id="faq-h" style="font-size:clamp(1.9rem,4vw,2.8rem); font-weight:800; color:var(--txt-1);">
                    Frequently Asked <span class="grad">Questions</span>
                </h2>
            </div>

            <div id="faq-list" class="rev">
                <div class="faq-item">
                    <button class="faq-btn" aria-expanded="false">Is DIU Routes available for all students? <i
                            class="fa-solid fa-chevron-down ch"></i></button>
                    <div class="faq-body">
                        <p>Yes! Any enrolled student at Dhaka International University can create an account and start
                            tracking campus buses immediately after registration.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-btn" aria-expanded="false">How accurate is the live GPS tracking? <i
                            class="fa-solid fa-chevron-down ch"></i></button>
                    <div class="faq-body">
                        <p>We use Google Maps JavaScript API with real-time GPS broadcasts from driver devices. The map
                            updates every few seconds, giving you highly accurate, current bus locations.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-btn" aria-expanded="false">Can drivers use it without a smartphone? <i
                            class="fa-solid fa-chevron-down ch"></i></button>
                    <div class="faq-body">
                        <p>The driver portal is a fully responsive web app. A GPS-enabled smartphone is recommended for
                            best accuracy, but any modern browser on a GPS-capable device works perfectly.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-btn" aria-expanded="false">Is my location data kept private? <i
                            class="fa-solid fa-chevron-down ch"></i></button>
                    <div class="faq-body">
                        <p>Absolutely. Student location data is never broadcast publicly. Only authorized drivers can
                            see relevant pick-up data. All connections are encrypted and secured.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-btn" aria-expanded="false">Does it work on mobile phones? <i
                            class="fa-solid fa-chevron-down ch"></i></button>
                    <div class="faq-body">
                        <p>Yes, DIU Routes is fully responsive and works seamlessly on mobile phones, tablets, laptops,
                            and desktops — no app download required.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ════════ CTA ════════ -->
    <section id="get-started" class="py-24 px-5" aria-labelledby="cta-h">
        <div class="max-w-2xl mx-auto text-center">
            <div class="card p-12 rev"
                style="border:1.5px solid var(--accent); background:linear-gradient(135deg, var(--bg-card) 0%, var(--bg-card2) 100%);">

                <div
                    style="width:80px;height:80px;border-radius:22px;display:flex;align-items:center;justify-content:center;font-size:34px;background:var(--glow);border:2px solid var(--accent);color:var(--accent);margin:0 auto 28px;">
                    <i class="fa-solid fa-bus-simple"></i>
                </div>

                <h2 id="cta-h"
                    style="font-size:clamp(1.8rem,4vw,2.6rem); font-weight:800; color:var(--txt-1); margin-bottom:14px;">
                    Ready to Board <span class="grad">DIU Routes?</span>
                </h2>
                <p style="color:var(--txt-2); font-size:16px; line-height:1.75; margin-bottom:36px;">
                    Your smarter, stress-free campus commute starts here.<br />Log in and see your bus on the map
                    instantly.
                </p>

                <a href="{{ route('login') }}" class="btn" style="font-size:17px; padding:16px 52px;">
                    <i class="fa-solid fa-right-to-bracket"></i> Login to DIU Routes
                </a>

            </div>
        </div>
    </section>


    <!-- ════════ FOOTER ════════ -->
    <footer style="background:var(--bg-card2); border-top:1px solid var(--border);" role="contentinfo">
        <div class="max-w-7xl mx-auto px-5 py-14">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <div class="md:col-span-1">
                    <div class="flex items-center gap-2.5 mb-5">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white"
                            style="background:var(--accent); font-size:14px;">
                            <i class="fa-solid fa-bus-simple"></i>
                        </div>
                        <span
                            style="font-family:'Bricolage Grotesque',sans-serif; font-weight:800; font-size:18px; color:var(--txt-1);">
                            DIU<span style="color:var(--accent);">Routes</span>
                        </span>
                    </div>
                    <p style="color:var(--txt-m); font-size:13px; line-height:1.75;">
                        The official transport tracking platform of Dhaka International University.
                    </p>
                </div>
                <div>
                    <h4
                        style="font-family:'Bricolage Grotesque',sans-serif; font-weight:700; font-size:14px; color:var(--txt-1); margin-bottom:16px;">
                        Platform</h4>
                    <ul class="space-y-2.5 list-none">
                        <li><a href="#features" class="fl">Features</a></li>
                        <li><a href="#roles" class="fl">Roles</a></li>
                        <li><a href="#how-it-works" class="fl">How It Works</a></li>
                    </ul>
                </div>
                <div>
                    <h4
                        style="font-family:'Bricolage Grotesque',sans-serif; font-weight:700; font-size:14px; color:var(--txt-1); margin-bottom:16px;">
                        Portals</h4>
                    <ul class="space-y-2.5 list-none">
                        <li><a href="{{ route('login') }}" class="fl">Student Login</a></li>
                        <li><a href="{{ route('login') }}" class="fl">Driver Login</a></li>
                    </ul>
                </div>
                <div>
                    <h4
                        style="font-family:'Bricolage Grotesque',sans-serif; font-weight:700; font-size:14px; color:var(--txt-1); margin-bottom:16px;">
                        University</h4>
                    <ul class="space-y-2.5 list-none">
                        <li><a href="https://diu.edu.bd" target="_blank" rel="noopener" class="fl">DIU Official
                                Website</a></li>
                        <li><a href="#faq" class="fl">FAQ</a></li>
                        <li><a href="#" class="fl">Contact Support</a></li>
                    </ul>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8"
                style="border-top:1px solid var(--border);">
                <p style="color:var(--txt-m); font-size:13px;">
                    © 2025 DIU Routes &nbsp;·&nbsp; Dhaka International University
                </p>
                <div class="flex items-center gap-2" style="color:var(--txt-m); font-size:13px;">
                    <div class="pdot"></div>
                    All systems operational
                </div>
            </div>
        </div>
    </footer>

    <div id="toast" role="alert" aria-live="polite">
        <i class="fa-solid fa-circle-info" style="color:var(--accent);"></i>
        <span id="toast-msg">Message</span>
    </div>


    <script>
        /* Theme */
        const html = document.documentElement;
        const tBtn = document.getElementById('theme-toggle');
        const tIco = document.getElementById('theme-icon');

        function applyTheme(t) {
            html.setAttribute('data-theme', t);
            tIco.className = t === 'dark' ? 'fa-solid fa-moon' : 'fa-solid fa-sun';
            localStorage.setItem('diu-theme', t);
        }
        const saved = localStorage.getItem('diu-theme') ||
            (window.matchMedia('(prefers-color-scheme:dark)').matches ? 'dark' : 'light');
        applyTheme(saved);
        tBtn.addEventListener('click', () =>
            applyTheme(html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark'));

        /* Mobile menu */
        const ham = document.getElementById('ham');
        const mob = document.getElementById('mob');
        ham.addEventListener('click', () => {
            const open = mob.classList.toggle('open');
            ham.setAttribute('aria-expanded', open);
            ham.innerHTML = open ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
        });
        document.querySelectorAll('.mlink').forEach(l => l.addEventListener('click', () => {
            mob.classList.remove('open');
            ham.setAttribute('aria-expanded', false);
            ham.innerHTML = '<i class="fa-solid fa-bars"></i>';
        }));

        /* Scroll reveal */
        const ro = new IntersectionObserver((entries) => {
            entries.forEach((e, i) => {
                if (e.isIntersecting) setTimeout(() => e.target.classList.add('on'), i * 90);
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.rev').forEach(el => ro.observe(el));

        /* Navbar shadow */
        window.addEventListener('scroll', () => {
            document.getElementById('navbar').style.boxShadow =
                window.scrollY > 20 ? '0 4px 28px rgba(0,0,0,.14)' : 'none';
        });

        /* FAQ */
        document.querySelectorAll('.faq-btn').forEach(b => {
            b.addEventListener('click', function() {
                const body = this.nextElementSibling;
                const open = body.classList.contains('open');
                document.querySelectorAll('.faq-body').forEach(x => x.classList.remove('open'));
                document.querySelectorAll('.faq-btn').forEach(x => {
                    x.classList.remove('open');
                    x.setAttribute('aria-expanded', false);
                });
                if (!open) {
                    body.classList.add('open');
                    this.classList.add('open');
                    this.setAttribute('aria-expanded', true);
                }
            });
        });
    </script>
</body>

</html>
