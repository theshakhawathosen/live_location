<!DOCTYPE html>
<html lang="en" class="light scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DIU Bus Tracker — Real-Time University Bus Tracking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Outfit', 'sans-serif'],
                        body: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#edfaf3',
                            100: '#d3f4e2',
                            200: '#aae8c9',
                            300: '#72d5a8',
                            400: '#38ba83',
                            500: '#16a067',
                            600: '#0b8053',
                            700: '#096644',
                            800: '#0a5138',
                            900: '#09422f',
                        }
                    },
                    animation: {
                        'float': 'float 4s ease-in-out infinite',
                        'float2': 'float 4s ease-in-out infinite 1s',
                        'float3': 'float 4s ease-in-out infinite 2s',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'slide-up': 'slideUp 0.6s ease forwards',
                        'fade-in': 'fadeIn 0.8s ease forwards',
                        'spin-slow': 'spin 20s linear infinite',
                        'ping-slow': 'ping 2s cubic-bezier(0,0,0.2,1) infinite',
                        'move-bus': 'moveBus 8s linear infinite',
                        'draw-line': 'drawLine 2s ease forwards',
                    },
                    keyframes: {
                        float: {
                            '0%,100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-12px)'
                            }
                        },
                        slideUp: {
                            from: {
                                opacity: '0',
                                transform: 'translateY(30px)'
                            },
                            to: {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        fadeIn: {
                            from: {
                                opacity: '0'
                            },
                            to: {
                                opacity: '1'
                            }
                        },
                        moveBus: {
                            '0%': {
                                left: '10%'
                            },
                            '100%': {
                                left: '80%'
                            }
                        },
                        drawLine: {
                            from: {
                                strokeDashoffset: '1000'
                            },
                            to: {
                                strokeDashoffset: '0'
                            }
                        },
                    }
                }
            }
        }
    </script>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        :root {
            --surface: #f7f9f8;
            --surface-alt: #eef1ef;
            --nav-bg: rgba(247, 249, 248, 0.85);
            --nav-border: rgba(0, 0, 0, 0.07);
            --text-primary: #0d1a10;
            --text-muted: #4a5e50;
            --card-bg: #ffffff;
            --card-border: rgba(0, 0, 0, 0.07);
            --accent: #16a067;
            --accent-2: #38ba83;
            --accent-glow: rgba(22, 160, 103, 0.18);
            --accent-glow-strong: rgba(22, 160, 103, 0.35);
            --grid-color: rgba(22, 160, 103, 0.06);
        }

        html.dark {
            --surface: #080f0a;
            --surface-alt: #0d1710;
            --nav-bg: rgba(8, 15, 10, 0.88);
            --nav-border: rgba(255, 255, 255, 0.07);
            --text-primary: #e4ede6;
            --text-muted: #6b886f;
            --card-bg: #0d1a10;
            --card-border: rgba(255, 255, 255, 0.07);
            --accent: #38ba83;
            --accent-2: #72d5a8;
            --accent-glow: rgba(56, 186, 131, 0.14);
            --accent-glow-strong: rgba(56, 186, 131, 0.28);
            --grid-color: rgba(56, 186, 131, 0.05);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--surface);
            color: var(--text-primary);
            transition: background 0.3s, color 0.3s;
            overflow-x: hidden;
        }

        /* Grid pattern bg */
        .grid-bg {
            background-image:
                linear-gradient(var(--grid-color) 1px, transparent 1px),
                linear-gradient(90deg, var(--grid-color) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Glassmorphism */
        .glass {
            background: var(--nav-bg);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--nav-border);
        }

        /* Glow orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }

        /* Navbar */
        #navbar {
            transition: background 0.3s, border-color 0.3s;
        }

        .nav-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-muted);
            transition: color 0.2s;
            position: relative;
            padding-bottom: 2px;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1.5px;
            background: var(--accent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.25s ease;
            border-radius: 2px;
        }

        .nav-link:hover {
            color: var(--accent);
        }

        .nav-link:hover::after {
            transform: scaleX(1);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #16a067, #0b8053);
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            border-radius: 12px;
            transition: transform 0.15s, box-shadow 0.2s, opacity 0.2s;
            box-shadow: 0 4px 18px rgba(22, 160, 103, 0.35);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), transparent);
            pointer-events: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(22, 160, 103, 0.45);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        html.dark .btn-primary {
            background: linear-gradient(135deg, #38ba83, #16a067);
            box-shadow: 0 4px 18px rgba(56, 186, 131, 0.3);
        }

        .btn-secondary {
            border: 1.5px solid var(--card-border);
            background: var(--card-bg);
            color: var(--text-primary);
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            border-radius: 12px;
            transition: background 0.2s, border-color 0.2s, transform 0.15s;
        }

        .btn-secondary:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-glow);
            transform: translateY(-1px);
        }

        .btn-ghost {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--text-muted);
            border-radius: 10px;
            padding: 8px 16px;
            transition: background 0.2s, color 0.2s;
        }

        .btn-ghost:hover {
            background: var(--accent-glow);
            color: var(--accent);
        }

        /* Cards */
        .feature-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 28px 24px;
            transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent-glow-strong), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
            border-color: rgba(22, 160, 103, 0.25);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        html.dark .feature-card:hover {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        /* Feature icon */
        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 18px;
            position: relative;
        }

        /* Step connector */
        .step-connector {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, var(--accent), transparent);
            opacity: 0.3;
            margin: 0 8px;
            position: relative;
            top: -16px;
        }

        /* Map preview card */
        .map-preview {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        html.dark .map-preview {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
        }

        /* Stat cards */
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 28px 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 20%;
            right: 20%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            border-radius: 2px;
        }

        /* Theme toggle */
        .theme-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid var(--card-border);
            background: var(--surface-alt);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            flex-shrink: 0;
            transition: background 0.2s, transform 0.15s;
            position: relative;
            overflow: hidden;
        }

        .theme-btn:hover {
            background: var(--accent-glow);
            transform: scale(1.06);
        }

        .theme-btn .sun {
            color: #f59e0b;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.3s;
            position: absolute;
        }

        .theme-btn .moon {
            color: #818cf8;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.3s;
            position: absolute;
        }

        html.light .theme-btn .sun {
            transform: translateY(0);
            opacity: 1;
        }

        html.light .theme-btn .moon {
            transform: translateY(20px);
            opacity: 0;
        }

        html.dark .theme-btn .sun {
            transform: translateY(-20px);
            opacity: 0;
        }

        html.dark .theme-btn .moon {
            transform: translateY(0);
            opacity: 1;
        }

        /* Mobile menu */
        #mobile-menu {
            transition: max-height 0.35s ease, opacity 0.25s ease;
            max-height: 0;
            overflow: hidden;
            opacity: 0;
        }

        #mobile-menu.open {
            max-height: 480px;
            opacity: 1;
        }

        /* Map SVG animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-10px)
            }
        }

        @keyframes floatB {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-6px)
            }
        }

        @keyframes pulsePing {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            100% {
                transform: scale(2.5);
                opacity: 0;
            }
        }

        @keyframes dashMove {
            to {
                stroke-dashoffset: -40;
            }
        }

        @keyframes busMove {
            0% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(40px);
            }

            100% {
                transform: translateX(0);
            }
        }

        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes glowPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 var(--accent-glow-strong);
            }

            50% {
                box-shadow: 0 0 0 10px transparent;
            }
        }

        .bus-float {
            animation: float 3.5s ease-in-out infinite;
        }

        .bus-float-2 {
            animation: floatB 4s ease-in-out infinite 1.2s;
        }

        .bus-float-3 {
            animation: floatB 3.8s ease-in-out infinite 0.6s;
        }

        .ping-ring {
            animation: pulsePing 2s ease-out infinite;
        }

        .ping-ring-2 {
            animation: pulsePing 2s ease-out infinite 0.7s;
        }

        .route-dash {
            stroke-dasharray: 8 4;
            animation: dashMove 1.5s linear infinite;
        }

        .route-dash-2 {
            stroke-dasharray: 8 4;
            animation: dashMove 2s linear infinite 0.5s;
        }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent-glow-strong);
            border-radius: 6px;
        }

        /* Footer */
        footer {
            background: var(--surface-alt);
            border-top: 1px solid var(--card-border);
        }

        /* CTA glow */
        .cta-glow {
            background: radial-gradient(ellipse at center, var(--accent-glow-strong) 0%, transparent 70%);
            position: absolute;
            inset: -40px;
            pointer-events: none;
        }
    </style>
</head>

<body>

    <!-- ══════════════════════════════════════════
     1. NAVBAR
══════════════════════════════════════════ -->
    <header id="navbar" class="glass fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center gap-4">

            <!-- Logo -->
            <a href="#" class="flex items-center gap-2.5 flex-shrink-0 mr-4">
                <div class="relative w-9 h-9 flex-shrink-0">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                        style="background:linear-gradient(135deg,#16a067,#0b8053);box-shadow:0 0 0 3px var(--accent-glow);">
                        <i class="fa-solid fa-bus text-white text-sm"></i>
                    </div>
                    <div class="absolute -bottom-0.5 -right-0.5 w-4 h-4 rounded-full flex items-center justify-center"
                        style="background:#16a067;border:2px solid var(--surface);">
                        <i class="fa-solid fa-location-dot text-white" style="font-size:7px;"></i>
                    </div>
                </div>
                <div>
                    <div class="font-display font-800 text-base leading-none"
                        style="color:var(--text-primary);font-weight:800;">DIU <span
                            style="color:var(--accent);">Bus</span></div>
                    <div class="font-display text-xs leading-none mt-0.5"
                        style="color:var(--text-muted);font-weight:500;letter-spacing:0.04em;">TRACKER</div>
                </div>
            </a>

            <!-- Center Nav -->
            <nav class="hidden lg:flex items-center gap-6 flex-1 justify-center">
                <a href="#hero" class="nav-link">Home</a>
                <a href="#features" class="nav-link">Features</a>
                <a href="#how-it-works" class="nav-link">How It Works</a>
                <a href="#map-preview" class="nav-link">Live Map</a>
                <a href="#contact" class="nav-link">Contact</a>
            </nav>

            <div class="flex-1 lg:flex-none"></div>

            <!-- Right Actions -->
            <div class="flex items-center gap-2">
                <button class="theme-btn" id="theme-btn" title="Toggle theme">
                    <i class="fa-solid fa-sun sun"></i>
                    <i class="fa-solid fa-moon moon"></i>
                </button>
                @if (!Auth::check())
                    <a href="{{ route('login') }}"
                        class="btn-primary px-4 py-2 text-sm hidden sm:flex items-center gap-2">
                        <i class="fa-solid fa-user text-xs"></i> Login
                    </a>
                @else
                    <a href="{{ route('login.redirectByRole') }}"
                        class="btn-primary px-4 py-2 text-sm hidden sm:flex items-center gap-2">
                        <i class="fa-solid fa-tachometer text-xs"></i> Dashboard
                    </a>
                @endif
                <!-- Mobile hamburger -->
                <button id="hamburger"
                    class="lg:hidden w-9 h-9 flex flex-col items-center justify-center gap-1.5 rounded-xl"
                    style="border:1px solid var(--card-border);background:var(--surface-alt);">
                    <span class="w-4 h-0.5 rounded-full transition-all duration-300"
                        style="background:var(--text-muted);"></span>
                    <span class="w-4 h-0.5 rounded-full transition-all duration-300"
                        style="background:var(--text-muted);"></span>
                    <span class="w-3 h-0.5 rounded-full transition-all duration-300"
                        style="background:var(--text-muted);"></span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden border-t" style="border-color:var(--nav-border);">
            <div class="px-4 py-4 flex flex-col gap-1">
                <a href="#hero"
                    class="nav-link py-3 px-2 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/10 block">Home</a>
                <a href="#features"
                    class="nav-link py-3 px-2 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/10 block">Features</a>
                <a href="#how-it-works"
                    class="nav-link py-3 px-2 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/10 block">How It
                    Works</a>
                <a href="#map-preview"
                    class="nav-link py-3 px-2 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/10 block">Live
                    Map</a>
                <a href="#contact"
                    class="nav-link py-3 px-2 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/10 block">Contact</a>
                <div class="flex gap-2 mt-2">
                    <a href="#" class="btn-secondary flex-1 py-2.5 text-center text-sm">Login</a>
                    <a href="#" class="btn-primary flex-1 py-2.5 text-center text-sm">Register</a>
                </div>
            </div>
        </div>
    </header>


    <!-- ══════════════════════════════════════════
     2. HERO SECTION
══════════════════════════════════════════ -->
    <section id="hero" class="relative min-h-screen flex items-center pt-16 overflow-hidden grid-bg">

        <!-- Orbs -->
        <div class="orb w-96 h-96 opacity-40"
            style="top:-80px;left:-80px;background:radial-gradient(circle,rgba(22,160,103,0.4),transparent 70%);"></div>
        <div class="orb w-80 h-80 opacity-30"
            style="bottom:0;right:-40px;background:radial-gradient(circle,rgba(56,186,131,0.35),transparent 70%);">
        </div>
        <div class="orb w-64 h-64 opacity-20"
            style="top:40%;left:40%;background:radial-gradient(circle,rgba(22,160,103,0.3),transparent 70%);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-20 w-full">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">

                <!-- Left Content -->
                <div class="reveal order-2 lg:order-1">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold mb-6"
                        style="background:var(--accent-glow);border:1px solid rgba(22,160,103,0.25);color:var(--accent);">
                        <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse inline-block"></span>
                        Live Tracking Active &mdash; DIU Campus
                    </div>

                    <h1 class="font-display font-black text-4xl sm:text-5xl xl:text-6xl leading-[1.08] tracking-tight mb-6"
                        style="color:var(--text-primary);">
                        Track Your University Bus
                        <span class="block mt-1"
                            style="background:linear-gradient(135deg,var(--accent),var(--accent-2));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">In
                            Real Time</span>
                    </h1>

                    <p class="text-base sm:text-lg mb-8 leading-relaxed max-w-lg" style="color:var(--text-muted);">
                        Never miss your ride again. Monitor live bus locations, routes, and arrival times directly from
                        your phone — for students, drivers, and admins.
                    </p>

                    <div class="flex flex-wrap gap-3 mb-10">
                        <a href="#map-preview" class="btn-primary px-6 py-3.5 text-sm flex items-center gap-2">
                            <i class="fa-solid fa-map-location-dot"></i>
                            View Live Map
                        </a>
                        <a href="#" class="btn-secondary px-6 py-3.5 text-sm flex items-center gap-2">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                            Get Started
                        </a>
                    </div>

                    <!-- Social proof -->
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-xs font-bold text-white"
                                style="background:linear-gradient(135deg,#16a067,#0b8053);border-color:var(--surface);">
                                S</div>
                            <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-xs font-bold text-white"
                                style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);border-color:var(--surface);">
                                R</div>
                            <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-xs font-bold text-white"
                                style="background:linear-gradient(135deg,#f59e0b,#d97706);border-color:var(--surface);">
                                A</div>
                            <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-xs font-semibold"
                                style="background:var(--surface-alt);border-color:var(--surface);color:var(--text-muted);">
                                +5k</div>
                        </div>
                        <div class="text-sm" style="color:var(--text-muted);">
                            <span class="font-semibold" style="color:var(--text-primary);">5,000+</span> students
                            tracking right now
                        </div>
                        <div class="flex items-center gap-1">
                            <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                            <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                            <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                            <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                            <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                            <span class="text-xs ml-1" style="color:var(--text-muted);">4.9/5</span>
                        </div>
                    </div>
                </div>

                <!-- Right — Map Illustration -->
                <div class="reveal order-1 lg:order-2" style="animation-delay:0.15s;">
                    <div class="relative">
                        <!-- Main map card -->
                        <div class="relative rounded-3xl overflow-hidden"
                            style="background:var(--card-bg);border:1px solid var(--card-border);box-shadow:0 30px 80px rgba(0,0,0,0.15),0 0 0 1px var(--card-border);">
                            <!-- Map header bar -->
                            <div class="flex items-center gap-2 px-4 py-3 border-b"
                                style="border-color:var(--card-border);">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                                <div class="flex-1 mx-4 px-3 py-1 rounded-lg text-xs"
                                    style="background:var(--surface-alt);color:var(--text-muted);">
                                    <i class="fa-solid fa-lock text-xs mr-1" style="color:var(--accent);"></i>
                                    bus.diu.edu.bd/live-map
                                </div>
                            </div>

                            <!-- Stylized SVG Map -->
                            <div class="relative"
                                style="background:linear-gradient(135deg,#e8f5ee 0%,#d3ede0 100%);height:300px;">
                                <!-- Dark mode map bg via JS class -->
                                <div id="map-bg" class="absolute inset-0"></div>

                                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 400 300" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <!-- Road network -->
                                    <path d="M0 150 Q100 120 200 150 Q300 180 400 150" stroke="rgba(255,255,255,0.5)"
                                        stroke-width="12" fill="none" />
                                    <path d="M200 0 Q220 100 200 150 Q180 200 200 300" stroke="rgba(255,255,255,0.5)"
                                        stroke-width="10" fill="none" />
                                    <path d="M0 220 Q120 210 200 150 Q280 90 400 80" stroke="rgba(255,255,255,0.4)"
                                        stroke-width="8" fill="none" />
                                    <!-- Road center lines -->
                                    <path d="M0 150 Q100 120 200 150 Q300 180 400 150" stroke="rgba(255,255,255,0.7)"
                                        stroke-width="1.5" fill="none" stroke-dasharray="12 8" />
                                    <path d="M200 0 Q220 100 200 150 Q180 200 200 300" stroke="rgba(255,255,255,0.7)"
                                        stroke-width="1.5" fill="none" stroke-dasharray="12 8" />

                                    <!-- Green areas / blocks -->
                                    <rect x="30" y="30" width="70" height="50" rx="6"
                                        fill="rgba(22,160,103,0.15)" />
                                    <rect x="30" y="30" width="70" height="50" rx="6"
                                        stroke="rgba(22,160,103,0.2)" stroke-width="1" fill="none" />
                                    <rect x="280" y="200" width="80" height="60" rx="6"
                                        fill="rgba(22,160,103,0.12)" />
                                    <rect x="260" y="40" width="90" height="55" rx="6"
                                        fill="rgba(22,160,103,0.1)" />

                                    <!-- Route line (animated) -->
                                    <path d="M50 260 Q100 200 140 180 Q180 160 200 150 Q230 138 280 120 Q330 105 360 80"
                                        stroke="#16a067" stroke-width="3" fill="none" stroke-dasharray="8 4"
                                        class="route-dash" opacity="0.9" />

                                    <!-- Bus 1 marker (animated) -->
                                    <g class="bus-float" style="transform-origin:170px 158px;">
                                        <circle cx="170" cy="158" r="16" fill="#16a067"
                                            opacity="0.15" />
                                        <circle cx="170" cy="158" r="16" fill="#16a067" opacity="0.1"
                                            class="ping-ring" />
                                        <circle cx="170" cy="158" r="10" fill="#16a067" />
                                        <text x="170" y="162" text-anchor="middle" fill="white" font-size="9"
                                            font-weight="bold">B1</text>
                                    </g>

                                    <!-- Bus 2 marker -->
                                    <g class="bus-float-2" style="transform-origin:310px 112px;">
                                        <circle cx="310" cy="112" r="14" fill="#f59e0b"
                                            opacity="0.15" />
                                        <circle cx="310" cy="112" r="14" fill="#f59e0b" opacity="0.1"
                                            class="ping-ring-2" />
                                        <circle cx="310" cy="112" r="9" fill="#f59e0b" />
                                        <text x="310" y="116" text-anchor="middle" fill="white" font-size="8"
                                            font-weight="bold">B2</text>
                                    </g>

                                    <!-- Student location -->
                                    <g class="bus-float-3" style="transform-origin:80px 220px;">
                                        <circle cx="80" cy="220" r="10" fill="#3b82f6"
                                            opacity="0.2" />
                                        <circle cx="80" cy="220" r="6" fill="#3b82f6" />
                                        <circle cx="80" cy="220" r="3" fill="white" />
                                    </g>

                                    <!-- DIU Campus marker -->
                                    <g style="transform-origin:200px 150px;">
                                        <rect x="185" y="130" width="30" height="20" rx="5"
                                            fill="#0b8053" />
                                        <text x="200" y="144" text-anchor="middle" fill="white" font-size="7"
                                            font-weight="bold">DIU</text>
                                        <polygon points="200,155 195,163 205,163" fill="#0b8053" />
                                    </g>

                                    <!-- Stop markers -->
                                    <circle cx="140" cy="180" r="5" fill="white" stroke="#16a067"
                                        stroke-width="2" />
                                    <circle cx="240" cy="138" r="5" fill="white" stroke="#16a067"
                                        stroke-width="2" />
                                    <circle cx="340" cy="98" r="5" fill="white" stroke="#16a067"
                                        stroke-width="2" />
                                </svg>

                                <!-- Popup overlay on map -->
                                <div class="absolute top-4 right-4 rounded-xl px-3 py-2.5 text-xs shadow-lg"
                                    style="background:var(--card-bg);border:1px solid var(--card-border);min-width:130px;">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-6 h-6 rounded-lg flex items-center justify-center"
                                            style="background:rgba(22,160,103,0.15);">
                                            <i class="fa-solid fa-bus"
                                                style="color:var(--accent);font-size:10px;"></i>
                                        </div>
                                        <div>
                                            <div class="font-display font-bold"
                                                style="color:var(--text-primary);font-size:11px;">Bus DIU-04</div>
                                            <div class="flex items-center gap-1" style="color:var(--accent);">
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full bg-current animate-pulse inline-block"></span>
                                                <span style="font-size:10px;">Live</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-1">
                                        <div class="flex justify-between"
                                            style="color:var(--text-muted);font-size:10px;">
                                            <span>Speed</span><span class="font-semibold"
                                                style="color:var(--text-primary);">42 km/h</span>
                                        </div>
                                        <div class="flex justify-between"
                                            style="color:var(--text-muted);font-size:10px;">
                                            <span>ETA</span><span class="font-semibold" style="color:var(--accent);">4
                                                min</span>
                                        </div>
                                        <div class="flex justify-between"
                                            style="color:var(--text-muted);font-size:10px;">
                                            <span>Passengers</span><span class="font-semibold"
                                                style="color:var(--text-primary);">24</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom info bar -->
                            <div class="px-4 py-3 flex items-center justify-between"
                                style="border-top:1px solid var(--card-border);">
                                <div class="flex items-center gap-2 text-xs" style="color:var(--text-muted);">
                                    <div class="w-1.5 h-1.5 rounded-full animate-pulse"
                                        style="background:var(--accent);"></div>
                                    3 vehicles active
                                </div>
                                <div class="flex gap-3 text-xs" style="color:var(--text-muted);">
                                    <span><i class="fa-solid fa-bus mr-1" style="color:#f59e0b;"></i>Route 4</span>
                                    <span><i class="fa-solid fa-bus mr-1" style="color:var(--accent);"></i>Route
                                        7</span>
                                </div>
                            </div>
                        </div>

                        <!-- Floating notification card -->
                        <div class="absolute -left-4 sm:-left-8 bottom-16 rounded-2xl px-4 py-3 shadow-2xl bus-float-2 hidden sm:block"
                            style="background:var(--card-bg);border:1px solid var(--card-border);min-width:180px;">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                                    style="background:rgba(22,160,103,0.15);">
                                    <i class="fa-solid fa-bell" style="color:var(--accent);font-size:14px;"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-xs" style="color:var(--text-primary);">Bus is
                                        nearby!</div>
                                    <div class="text-xs mt-0.5" style="color:var(--text-muted);">Arriving in <span
                                            style="color:var(--accent);font-weight:700;">2 minutes</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating accuracy badge -->
                        <div class="absolute -right-2 sm:-right-6 top-20 rounded-2xl px-3 py-2.5 shadow-xl bus-float-3 hidden sm:flex items-center gap-2"
                            style="background:var(--card-bg);border:1px solid var(--card-border);">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                                style="background:rgba(16,185,129,0.12);">
                                <i class="fa-solid fa-satellite-dish text-emerald-500 text-sm"></i>
                            </div>
                            <div>
                                <div class="font-display font-bold text-sm" style="color:var(--text-primary);">99.9%
                                </div>
                                <div class="text-xs" style="color:var(--text-muted);">Accuracy</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════════
     3. FEATURES SECTION
══════════════════════════════════════════ -->
    <section id="features" class="py-24 relative overflow-hidden">
        <div class="orb w-80 h-80 opacity-20"
            style="top:0;right:0;background:radial-gradient(circle,rgba(22,160,103,0.3),transparent 70%);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <!-- Header -->
            <div class="text-center mb-16 reveal">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold mb-4"
                    style="background:var(--accent-glow);border:1px solid rgba(22,160,103,0.2);color:var(--accent);">
                    <i class="fa-solid fa-bolt text-xs"></i>
                    Powerful Features
                </div>
                <h2 class="font-display font-black text-3xl sm:text-4xl xl:text-5xl tracking-tight mb-4"
                    style="color:var(--text-primary);">
                    Everything You Need to
                    <span class="block" style="color:var(--accent);">Never Miss a Bus</span>
                </h2>
                <p class="max-w-xl mx-auto text-base leading-relaxed" style="color:var(--text-muted);">
                    A complete transport management solution for students, drivers, and university administrators.
                </p>
            </div>

            <!-- Feature Cards Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">

                <!-- Card 1 -->
                <div class="feature-card reveal" style="animation-delay:0.05s;">
                    <div class="feature-icon" style="background:rgba(22,160,103,0.12);color:#16a067;">
                        <i class="fa-solid fa-satellite-dish"></i>
                    </div>
                    <h3 class="font-display font-700 text-lg mb-2" style="color:var(--text-primary);font-weight:700;">
                        Live Bus Tracking</h3>
                    <p class="text-sm leading-relaxed" style="color:var(--text-muted);">Track buses and university
                        vehicles on a live map with real-time location updates every few seconds.</p>
                    <div class="mt-4 flex items-center gap-1.5 text-xs font-semibold" style="color:var(--accent);">
                        <span>Learn more</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="feature-card reveal" style="animation-delay:0.1s;">
                    <div class="feature-icon" style="background:rgba(59,130,246,0.1);color:#3b82f6;">
                        <i class="fa-solid fa-route"></i>
                    </div>
                    <h3 class="font-display font-700 text-lg mb-2" style="color:var(--text-primary);font-weight:700;">
                        Route Information</h3>
                    <p class="text-sm leading-relaxed" style="color:var(--text-muted);">See all bus routes, stops, and
                        schedules so you always know where each vehicle is heading.</p>
                    <div class="mt-4 flex items-center gap-1.5 text-xs font-semibold" style="color:#3b82f6;">
                        <span>Learn more</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="feature-card reveal" style="animation-delay:0.15s;">
                    <div class="feature-icon" style="background:rgba(245,158,11,0.1);color:#f59e0b;">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <h3 class="font-display font-700 text-lg mb-2" style="color:var(--text-primary);font-weight:700;">
                        Smart Notifications</h3>
                    <p class="text-sm leading-relaxed" style="color:var(--text-muted);">Get instant push notifications
                        when your bus is nearby, delayed, or about to leave your stop.</p>
                    <div class="mt-4 flex items-center gap-1.5 text-xs font-semibold" style="color:#f59e0b;">
                        <span>Learn more</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="feature-card reveal" style="animation-delay:0.2s;">
                    <div class="feature-icon" style="background:rgba(168,85,247,0.1);color:#a855f7;">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <h3 class="font-display font-700 text-lg mb-2" style="color:var(--text-primary);font-weight:700;">
                        Multi-Vehicle Monitor</h3>
                    <p class="text-sm leading-relaxed" style="color:var(--text-muted);">Track multiple buses, hiaces,
                        and vehicles simultaneously on a single unified map view.</p>
                    <div class="mt-4 flex items-center gap-1.5 text-xs font-semibold" style="color:#a855f7;">
                        <span>Learn more</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════════
     4. HOW IT WORKS
══════════════════════════════════════════ -->
    <section id="how-it-works" class="py-24 relative" style="background:var(--surface-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <div class="text-center mb-16 reveal">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold mb-4"
                    style="background:var(--accent-glow);border:1px solid rgba(22,160,103,0.2);color:var(--accent);">
                    <i class="fa-solid fa-circle-info text-xs"></i>
                    How It Works
                </div>
                <h2 class="font-display font-black text-3xl sm:text-4xl xl:text-5xl tracking-tight mb-4"
                    style="color:var(--text-primary);">
                    Simple as <span style="color:var(--accent);">3 Steps</span>
                </h2>
                <p class="max-w-md mx-auto text-base" style="color:var(--text-muted);">
                    From driver to student in real time — the entire process is seamless and instant.
                </p>
            </div>

            <!-- Steps -->
            <div class="grid md:grid-cols-3 gap-8 relative reveal">

                <!-- Connector lines (desktop) -->
                <div class="hidden md:block absolute top-12 left-1/3 right-1/3 h-px"
                    style="background:linear-gradient(90deg,transparent,var(--accent),var(--accent),transparent);opacity:0.3;">
                </div>

                <!-- Step 1 -->
                <div class="text-center">
                    <div class="relative inline-flex mb-6">
                        <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto relative z-10"
                            style="background:linear-gradient(135deg,#16a067,#0b8053);box-shadow:0 8px 32px rgba(22,160,103,0.4);">
                            <i class="fa-solid fa-mobile-screen-button text-white text-2xl"></i>
                        </div>
                        <div class="absolute inset-0 rounded-2xl animate-ping-slow"
                            style="background:rgba(22,160,103,0.2);"></div>
                        <div class="absolute -top-2 -right-2 w-7 h-7 rounded-full flex items-center justify-center font-display font-black text-sm text-white"
                            style="background:#16a067;">1</div>
                    </div>
                    <h3 class="font-display font-700 text-xl mb-3" style="color:var(--text-primary);font-weight:700;">
                        Driver Shares Location</h3>
                    <p class="text-sm leading-relaxed" style="color:var(--text-muted);">The driver opens the app and
                        goes online. Their GPS location is immediately activated and starts broadcasting to the server.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center" style="animation-delay:0.1s;">
                    <div class="relative inline-flex mb-6">
                        <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto relative z-10"
                            style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);box-shadow:0 8px 32px rgba(59,130,246,0.35);">
                            <i class="fa-solid fa-server text-white text-2xl"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-7 h-7 rounded-full flex items-center justify-center font-display font-black text-sm text-white"
                            style="background:#3b82f6;">2</div>
                    </div>
                    <h3 class="font-display font-700 text-xl mb-3" style="color:var(--text-primary);font-weight:700;">
                        Server Gets Location</h3>
                    <p class="text-sm leading-relaxed" style="color:var(--text-muted);">Location data is sent to the
                        server in real time via WebSocket, processed instantly, and pushed to all connected students.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center" style="animation-delay:0.2s;">
                    <div class="relative inline-flex mb-6">
                        <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto relative z-10"
                            style="background:linear-gradient(135deg,#f59e0b,#d97706);box-shadow:0 8px 32px rgba(245,158,11,0.35);">
                            <i class="fa-solid fa-users text-white text-2xl"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-7 h-7 rounded-full flex items-center justify-center font-display font-black text-sm text-white"
                            style="background:#f59e0b;">3</div>
                    </div>
                    <h3 class="font-display font-700 text-xl mb-3" style="color:var(--text-primary);font-weight:700;">
                        Students See Live Map</h3>
                    <p class="text-sm leading-relaxed" style="color:var(--text-muted);">Students instantly see the bus
                        moving on the map, see the ETA, and get notifications when their bus is approaching.</p>
                </div>

            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════════
     5. LIVE MAP PREVIEW SECTION
══════════════════════════════════════════ -->
    <section id="map-preview" class="py-24 relative overflow-hidden">
        <div class="orb w-96 h-96 opacity-25"
            style="bottom:-100px;left:-80px;background:radial-gradient(circle,rgba(22,160,103,0.35),transparent 70%);">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12 reveal">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold mb-4"
                    style="background:var(--accent-glow);border:1px solid rgba(22,160,103,0.2);color:var(--accent);">
                    <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse inline-block"></span>
                    Live Map Preview
                </div>
                <h2 class="font-display font-black text-3xl sm:text-4xl xl:text-5xl tracking-tight mb-4"
                    style="color:var(--text-primary);">
                    See It In <span style="color:var(--accent);">Action</span>
                </h2>
                <p class="max-w-md mx-auto text-base" style="color:var(--text-muted);">
                    A preview of the live map dashboard — exactly what students see in real time.
                </p>
            </div>

            <div class="reveal">
                <div class="map-preview">
                    <!-- Top bar -->
                    <div class="flex items-center justify-between px-5 py-4 border-b"
                        style="border-color:var(--card-border);">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                                style="background:linear-gradient(135deg,#16a067,#0b8053);">
                                <i class="fa-solid fa-map-location-dot text-white text-sm"></i>
                            </div>
                            <div>
                                <div class="font-display font-bold text-sm" style="color:var(--text-primary);">DIU
                                    Live Map</div>
                                <div class="flex items-center gap-1.5 text-xs" style="color:var(--accent);">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-current animate-pulse inline-block"></span>
                                    3 vehicles active
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="px-2.5 py-1 rounded-lg text-xs font-medium"
                                style="background:var(--accent-glow);color:var(--accent);">
                                <i class="fa-solid fa-circle text-xs mr-1 animate-pulse"></i>Live
                            </div>
                        </div>
                    </div>

                    <!-- Main content: map + sidebar -->
                    <div class="flex flex-col lg:flex-row">
                        <!-- Large map area -->
                        <div class="flex-1 relative overflow-hidden"
                            style="background:linear-gradient(135deg,#d4edda 0%,#c3e6cb 50%,#b8dfc2 100%);min-height:360px;"
                            id="preview-map-bg">
                            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 700 360" fill="none">
                                <!-- Roads -->
                                <path d="M0 180 Q175 150 350 180 Q525 210 700 180" stroke="rgba(255,255,255,0.6)"
                                    stroke-width="18" fill="none" />
                                <path d="M350 0 Q370 120 350 180 Q330 240 350 360" stroke="rgba(255,255,255,0.5)"
                                    stroke-width="14" fill="none" />
                                <path d="M0 280 Q200 265 350 180 Q500 95 700 80" stroke="rgba(255,255,255,0.4)"
                                    stroke-width="11" fill="none" />
                                <path d="M0 60 Q150 80 280 120 Q350 145 450 140 Q580 130 700 120"
                                    stroke="rgba(255,255,255,0.35)" stroke-width="9" fill="none" />
                                <!-- Center lines -->
                                <path d="M0 180 Q175 150 350 180 Q525 210 700 180" stroke="rgba(255,255,255,0.8)"
                                    stroke-width="1.5" fill="none" stroke-dasharray="16 10" />
                                <path d="M350 0 Q370 120 350 180 Q330 240 350 360" stroke="rgba(255,255,255,0.8)"
                                    stroke-width="1.5" fill="none" stroke-dasharray="16 10" />
                                <!-- Campus blocks -->
                                <rect x="50" y="40" width="110" height="80" rx="8"
                                    fill="rgba(22,160,103,0.15)" stroke="rgba(22,160,103,0.25)" stroke-width="1" />
                                <text x="105" y="86" text-anchor="middle" fill="rgba(11,128,83,0.7)" font-size="10"
                                    font-weight="600">Campus A</text>
                                <rect x="450" y="220" width="130" height="90" rx="8"
                                    fill="rgba(22,160,103,0.12)" stroke="rgba(22,160,103,0.2)" stroke-width="1" />
                                <text x="515" y="271" text-anchor="middle" fill="rgba(11,128,83,0.7)" font-size="10"
                                    font-weight="600">Campus B</text>
                                <rect x="440" y="50" width="120" height="75" rx="8"
                                    fill="rgba(22,160,103,0.1)" stroke="rgba(22,160,103,0.15)" stroke-width="1" />
                                <!-- Route line animated -->
                                <path d="M80 300 Q150 250 220 220 Q290 190 350 180 Q420 168 490 148 Q560 128 620 100"
                                    stroke="#16a067" stroke-width="3.5" fill="none" stroke-dasharray="10 5"
                                    class="route-dash" opacity="0.9" />
                                <path d="M80 60 Q160 90 240 120 Q300 140 350 180 Q400 220 460 250 Q540 280 620 290"
                                    stroke="#3b82f6" stroke-width="3" fill="none" stroke-dasharray="10 5"
                                    class="route-dash-2" opacity="0.8" />
                                <!-- Stop markers -->
                                <circle cx="220" cy="220" r="7" fill="white" stroke="#16a067"
                                    stroke-width="2.5" />
                                <circle cx="490" cy="148" r="7" fill="white" stroke="#16a067"
                                    stroke-width="2.5" />
                                <circle cx="240" cy="120" r="7" fill="white" stroke="#3b82f6"
                                    stroke-width="2.5" />
                                <circle cx="460" cy="250" r="7" fill="white" stroke="#3b82f6"
                                    stroke-width="2.5" />
                                <!-- Bus 1 (green) -->
                                <g class="bus-float" style="transform-origin:350px 180px;">
                                    <circle cx="350" cy="180" r="22" fill="#16a067" opacity="0.12" />
                                    <circle cx="350" cy="180" r="22" fill="#16a067" opacity="0.08"
                                        class="ping-ring" />
                                    <circle cx="350" cy="180" r="14" fill="#16a067" />
                                    <circle cx="350" cy="180" r="14" fill="white"
                                        fill-opacity="0.1" />
                                    <text x="350" y="185" text-anchor="middle" fill="white" font-size="10"
                                        font-weight="bold">B4</text>
                                </g>
                                <!-- Bus 2 (amber) -->
                                <g class="bus-float-2" style="transform-origin:490px 148px;">
                                    <circle cx="490" cy="148" r="20" fill="#f59e0b" opacity="0.12" />
                                    <circle cx="490" cy="148" r="12" fill="#f59e0b" />
                                    <text x="490" y="153" text-anchor="middle" fill="white" font-size="10"
                                        font-weight="bold">B7</text>
                                </g>
                                <!-- Hiace (blue) -->
                                <g class="bus-float-3" style="transform-origin:240px 120px;">
                                    <circle cx="240" cy="120" r="18" fill="#3b82f6" opacity="0.12" />
                                    <circle cx="240" cy="120" r="11" fill="#3b82f6" />
                                    <text x="240" y="125" text-anchor="middle" fill="white" font-size="9"
                                        font-weight="bold">H2</text>
                                </g>
                                <!-- Student dot -->
                                <g class="bus-float-3" style="transform-origin:130px 270px;">
                                    <circle cx="130" cy="270" r="12" fill="#6366f1" opacity="0.2" />
                                    <circle cx="130" cy="270" r="7" fill="#6366f1" />
                                    <circle cx="130" cy="270" r="3.5" fill="white" />
                                </g>
                                <!-- DIU marker -->
                                <g>
                                    <rect x="328" y="150" width="44" height="26" rx="6"
                                        fill="#0b8053" opacity="0.95" />
                                    <text x="350" y="167" text-anchor="middle" fill="white" font-size="9"
                                        font-weight="bold">DIU HQ</text>
                                    <polygon points="350,177 344,186 356,186" fill="#0b8053" opacity="0.95" />
                                </g>
                            </svg>
                        </div>

                        <!-- Right sidebar -->
                        <div class="lg:w-64 xl:w-72 border-t lg:border-t-0 lg:border-l p-4 space-y-3 flex-shrink-0"
                            style="border-color:var(--card-border);">
                            <div class="text-xs font-bold uppercase tracking-wider mb-3"
                                style="color:var(--text-muted);">Active Vehicles</div>

                            <!-- Vehicle item -->
                            <div class="flex items-center gap-3 p-3 rounded-xl hover:scale-[1.01] transition-transform cursor-pointer"
                                style="background:var(--surface-alt);">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                                    style="background:rgba(22,160,103,0.15);">
                                    <i class="fa-solid fa-bus" style="color:#16a067;font-size:14px;"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-display font-bold text-sm" style="color:var(--text-primary);">Bus
                                        DIU-04</div>
                                    <div class="text-xs truncate" style="color:var(--text-muted);">Route 4 · Mirpur
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <div class="font-display font-bold text-sm" style="color:var(--accent);">4 min
                                    </div>
                                    <div class="text-xs" style="color:var(--text-muted);">42 km/h</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-xl hover:scale-[1.01] transition-transform cursor-pointer"
                                style="background:var(--surface-alt);">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                                    style="background:rgba(245,158,11,0.12);">
                                    <i class="fa-solid fa-bus" style="color:#f59e0b;font-size:14px;"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-display font-bold text-sm" style="color:var(--text-primary);">Bus
                                        DIU-07</div>
                                    <div class="text-xs truncate" style="color:var(--text-muted);">Route 7 · Uttara
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <div class="font-display font-bold text-sm" style="color:var(--accent);">12 min
                                    </div>
                                    <div class="text-xs" style="color:var(--text-muted);">35 km/h</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-xl hover:scale-[1.01] transition-transform cursor-pointer"
                                style="background:var(--surface-alt);">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                                    style="background:rgba(99,102,241,0.1);">
                                    <i class="fa-solid fa-van-shuttle" style="color:#6366f1;font-size:13px;"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-display font-bold text-sm" style="color:var(--text-primary);">
                                        Hiace H-02</div>
                                    <div class="text-xs truncate" style="color:var(--text-muted);">Ashulia · DIU Gate
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <div class="font-display font-bold text-sm" style="color:var(--accent);">8 min
                                    </div>
                                    <div class="text-xs" style="color:var(--text-muted);">28 km/h</div>
                                </div>
                            </div>

                            <div class="pt-2">
                                <a href="#"
                                    class="btn-primary w-full py-2.5 text-sm text-center flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-maximize text-xs"></i>
                                    Open Full Map
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════════
     6. STATISTICS SECTION
══════════════════════════════════════════ -->
    <section id="stats" class="py-20 relative" style="background:var(--surface-alt);">
        <div class="orb w-96 h-96 opacity-20"
            style="top:-100px;right:0;background:radial-gradient(circle,rgba(22,160,103,0.3),transparent 70%);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 reveal">

                <div class="stat-card">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mx-auto mb-4"
                        style="background:rgba(22,160,103,0.12);">
                        <i class="fa-solid fa-users" style="color:var(--accent);font-size:18px;"></i>
                    </div>
                    <div class="font-display font-black text-3xl sm:text-4xl mb-1" style="color:var(--text-primary);">
                        5,000<span style="color:var(--accent);">+</span></div>
                    <div class="text-sm font-medium" style="color:var(--text-muted);">Students Tracking</div>
                </div>

                <div class="stat-card" style="animation-delay:0.08s;">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mx-auto mb-4"
                        style="background:rgba(245,158,11,0.1);">
                        <i class="fa-solid fa-bus" style="color:#f59e0b;font-size:18px;"></i>
                    </div>
                    <div class="font-display font-black text-3xl sm:text-4xl mb-1" style="color:var(--text-primary);">
                        50<span style="color:#f59e0b;">+</span></div>
                    <div class="text-sm font-medium" style="color:var(--text-muted);">University Vehicles</div>
                </div>

                <div class="stat-card" style="animation-delay:0.16s;">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mx-auto mb-4"
                        style="background:rgba(16,185,129,0.1);">
                        <i class="fa-solid fa-satellite-dish" style="color:#10b981;font-size:18px;"></i>
                    </div>
                    <div class="font-display font-black text-3xl sm:text-4xl mb-1" style="color:var(--text-primary);">
                        99.9<span style="color:#10b981;">%</span></div>
                    <div class="text-sm font-medium" style="color:var(--text-muted);">Real-Time Accuracy</div>
                </div>

                <div class="stat-card" style="animation-delay:0.24s;">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mx-auto mb-4"
                        style="background:rgba(99,102,241,0.1);">
                        <i class="fa-solid fa-shield-halved" style="color:#6366f1;font-size:18px;"></i>
                    </div>
                    <div class="font-display font-black text-3xl sm:text-4xl mb-1" style="color:var(--text-primary);">
                        24<span style="color:#6366f1;">/7</span></div>
                    <div class="text-sm font-medium" style="color:var(--text-muted);">Live Monitoring</div>
                </div>

            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════════
     7. CALL TO ACTION
══════════════════════════════════════════ -->
    <section id="cta" class="py-28 relative overflow-hidden">
        <div class="orb w-[600px] h-[400px] opacity-30"
            style="top:50%;left:50%;transform:translate(-50%,-50%);background:radial-gradient(ellipse,rgba(22,160,103,0.4),transparent 70%);">
        </div>
        <div class="grid-bg absolute inset-0 opacity-50"></div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center relative reveal">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold mb-6"
                style="background:var(--accent-glow);border:1px solid rgba(22,160,103,0.25);color:var(--accent);">
                <i class="fa-solid fa-rocket text-xs"></i>
                Get Started Today — It's Free
            </div>

            <h2 class="font-display font-black text-4xl sm:text-5xl xl:text-6xl tracking-tight leading-[1.05] mb-6"
                style="color:var(--text-primary);">
                Start Tracking Your
                <span class="block"
                    style="background:linear-gradient(135deg,var(--accent),var(--accent-2));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Bus
                    Today</span>
            </h2>

            <p class="text-base sm:text-lg mb-10 leading-relaxed max-w-xl mx-auto" style="color:var(--text-muted);">
                Join over 5,000 DIU students who never miss their bus anymore. Sign up free and start tracking in under
                2 minutes.
            </p>

            <div class="flex flex-wrap justify-center gap-4">
                <a href="#" class="btn-primary px-8 py-4 text-base flex items-center gap-2.5 animate-glowPulse">
                    <i class="fa-solid fa-user-plus"></i>
                    Register Now
                </a>
                <a href="#map-preview" class="btn-secondary px-8 py-4 text-base flex items-center gap-2.5">
                    <i class="fa-solid fa-map-location-dot text-sm" style="color:var(--accent);"></i>
                    View Live Map
                </a>
            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════════
     8. FOOTER
══════════════════════════════════════════ -->
    <footer id="contact">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

                <!-- Col 1: Brand -->
                <div class="col-span-2 lg:col-span-1">
                    <a href="#" class="flex items-center gap-2.5 mb-4">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center relative"
                            style="background:linear-gradient(135deg,#16a067,#0b8053);">
                            <i class="fa-solid fa-bus text-white text-sm"></i>
                            <div class="absolute -bottom-0.5 -right-0.5 w-4 h-4 rounded-full flex items-center justify-center"
                                style="background:#16a067;border:2px solid var(--surface-alt);">
                                <i class="fa-solid fa-location-dot text-white" style="font-size:7px;"></i>
                            </div>
                        </div>
                        <span class="font-display font-black text-base" style="color:var(--text-primary);">DIU <span
                                style="color:var(--accent);">Bus</span> Tracker</span>
                    </a>
                    <p class="text-sm leading-relaxed mb-5" style="color:var(--text-muted);">
                        Real-time university bus tracking system for Daffodil International University. Built for
                        students, drivers & admins.
                    </p>
                    <div class="flex items-center gap-2 text-xs font-medium px-3 py-2 rounded-xl w-fit"
                        style="background:var(--accent-glow);color:var(--accent);border:1px solid rgba(22,160,103,0.2);">
                        <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse inline-block"></span>
                        System Online · 3 vehicles active
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <div class="font-display font-bold text-sm mb-4 uppercase tracking-wider"
                        style="color:var(--text-primary);">Quick Links</div>
                    <ul class="space-y-2.5">
                        <li><a href="#hero"
                                class="text-sm transition-colors hover:translate-x-1 inline-block transition-transform duration-200"
                                style="color:var(--text-muted);" onmouseover="this.style.color='var(--accent)'"
                                onmouseout="this.style.color='var(--text-muted)'">Home</a></li>
                        <li><a href="#features"
                                class="text-sm inline-block transition-transform duration-200 hover:translate-x-1"
                                style="color:var(--text-muted);" onmouseover="this.style.color='var(--accent)'"
                                onmouseout="this.style.color='var(--text-muted)'">Features</a></li>
                        <li><a href="#how-it-works"
                                class="text-sm inline-block transition-transform duration-200 hover:translate-x-1"
                                style="color:var(--text-muted);" onmouseover="this.style.color='var(--accent)'"
                                onmouseout="this.style.color='var(--text-muted)'">How It Works</a></li>
                        <li><a href="#map-preview"
                                class="text-sm inline-block transition-transform duration-200 hover:translate-x-1"
                                style="color:var(--text-muted);" onmouseover="this.style.color='var(--accent)'"
                                onmouseout="this.style.color='var(--text-muted)'">Live Map</a></li>
                        <li><a href="#"
                                class="text-sm inline-block transition-transform duration-200 hover:translate-x-1"
                                style="color:var(--text-muted);" onmouseover="this.style.color='var(--accent)'"
                                onmouseout="this.style.color='var(--text-muted)'">Login</a></li>
                        <li><a href="#"
                                class="text-sm inline-block transition-transform duration-200 hover:translate-x-1"
                                style="color:var(--text-muted);" onmouseover="this.style.color='var(--accent)'"
                                onmouseout="this.style.color='var(--text-muted)'">Register</a></li>
                    </ul>
                </div>

                <!-- Col 3: Contact -->
                <div>
                    <div class="font-display font-bold text-sm mb-4 uppercase tracking-wider"
                        style="color:var(--text-primary);">Contact</div>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-2.5 text-sm" style="color:var(--text-muted);">
                            <i class="fa-solid fa-location-dot mt-0.5 flex-shrink-0" style="color:var(--accent);"></i>
                            Daffodil Smart City, Ashulia, Savar, Dhaka-1341
                        </li>
                        <li class="flex items-center gap-2.5 text-sm" style="color:var(--text-muted);">
                            <i class="fa-solid fa-envelope flex-shrink-0" style="color:var(--accent);"></i>
                            <a href="mailto:transport@diu.edu.bd" onmouseover="this.style.color='var(--accent)'"
                                onmouseout="this.style.color='var(--text-muted)'">transport@diu.edu.bd</a>
                        </li>
                        <li class="flex items-center gap-2.5 text-sm" style="color:var(--text-muted);">
                            <i class="fa-solid fa-phone flex-shrink-0" style="color:var(--accent);"></i>
                            +880 1847-140-244
                        </li>
                        <li class="flex items-center gap-2.5 text-sm" style="color:var(--text-muted);">
                            <i class="fa-solid fa-globe flex-shrink-0" style="color:var(--accent);"></i>
                            <a href="https://diu.edu.bd" target="_blank"
                                onmouseover="this.style.color='var(--accent)'"
                                onmouseout="this.style.color='var(--text-muted)'">diu.edu.bd</a>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Social -->
                <div>
                    <div class="font-display font-bold text-sm mb-4 uppercase tracking-wider"
                        style="color:var(--text-primary);">Follow Us</div>
                    <div class="grid grid-cols-2 gap-2 mb-6">
                        <a href="#"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-xs font-medium transition-colors"
                            style="background:var(--surface);border:1px solid var(--card-border);color:var(--text-muted);"
                            onmouseover="this.style.borderColor='var(--accent)';this.style.color='var(--accent)';this.style.background='var(--accent-glow)';"
                            onmouseout="this.style.borderColor='var(--card-border)';this.style.color='var(--text-muted)';this.style.background='var(--surface)';">
                            <i class="fa-brands fa-facebook text-sm"></i> Facebook
                        </a>
                        <a href="#"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-xs font-medium transition-colors"
                            style="background:var(--surface);border:1px solid var(--card-border);color:var(--text-muted);"
                            onmouseover="this.style.borderColor='var(--accent)';this.style.color='var(--accent)';this.style.background='var(--accent-glow)';"
                            onmouseout="this.style.borderColor='var(--card-border)';this.style.color='var(--text-muted)';this.style.background='var(--surface)';">
                            <i class="fa-brands fa-twitter text-sm"></i> Twitter
                        </a>
                        <a href="#"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-xs font-medium transition-colors"
                            style="background:var(--surface);border:1px solid var(--card-border);color:var(--text-muted);"
                            onmouseover="this.style.borderColor='var(--accent)';this.style.color='var(--accent)';this.style.background='var(--accent-glow)';"
                            onmouseout="this.style.borderColor='var(--card-border)';this.style.color='var(--text-muted)';this.style.background='var(--surface)';">
                            <i class="fa-brands fa-instagram text-sm"></i> Instagram
                        </a>
                        <a href="#"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-xs font-medium transition-colors"
                            style="background:var(--surface);border:1px solid var(--card-border);color:var(--text-muted);"
                            onmouseover="this.style.borderColor='var(--accent)';this.style.color='var(--accent)';this.style.background='var(--accent-glow)';"
                            onmouseout="this.style.borderColor='var(--card-border)';this.style.color='var(--text-muted)';this.style.background='var(--surface)';">
                            <i class="fa-brands fa-linkedin text-sm"></i> LinkedIn
                        </a>
                    </div>
                    <div class="text-xs p-3 rounded-xl"
                        style="background:var(--accent-glow);border:1px solid rgba(22,160,103,0.2);color:var(--accent);">
                        <i class="fa-solid fa-code mr-1.5"></i>
                        Built by DIU CS Students
                    </div>
                </div>

            </div>

            <!-- Bottom bar -->
            <div class="pt-6 border-t flex flex-col sm:flex-row items-center justify-between gap-3"
                style="border-color:var(--card-border);">
                <div class="text-xs" style="color:var(--text-muted);">
                    &copy; 2025 DIU Bus Tracker. All rights reserved. Daffodil International University.
                </div>
                <div class="flex items-center gap-4 text-xs" style="color:var(--text-muted);">
                    <a href="#" onmouseover="this.style.color='var(--accent)'"
                        onmouseout="this.style.color='var(--text-muted)'">Privacy Policy</a>
                    <a href="#" onmouseover="this.style.color='var(--accent)'"
                        onmouseout="this.style.color='var(--text-muted)'">Terms of Service</a>
                    <a href="#" onmouseover="this.style.color='var(--accent)'"
                        onmouseout="this.style.color='var(--text-muted)'">Support</a>
                </div>
            </div>
        </div>
    </footer>


    <!-- ══════════════════════════════════════════
     SCRIPTS
══════════════════════════════════════════ -->
    <script>
        /* ── Theme ── */
        (function() {
            const s = localStorage.getItem('diu-landing-theme') || 'light';
            document.documentElement.className = s + ' scroll-smooth';
            updateMapBg(s);
        })();

        function updateMapBg(theme) {
            const mapBgs = document.querySelectorAll('#map-bg, #preview-map-bg');
            mapBgs.forEach(el => {
                if (theme === 'dark') {
                    el.style.background = 'linear-gradient(135deg,#0d1f12 0%,#111e14 50%,#0f1c11 100%)';
                } else {
                    el.style.background = 'linear-gradient(135deg,#d4edda 0%,#c3e6cb 50%,#b8dfc2 100%)';
                }
            });
            const svgTexts = document.querySelectorAll('[fill="rgba(11,128,83,0.7)"]');
            svgTexts.forEach(t => t.setAttribute('fill', theme === 'dark' ? 'rgba(56,186,131,0.6)' :
                'rgba(11,128,83,0.7)'));
        }

        document.getElementById('theme-btn').addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            document.documentElement.classList.toggle('light', !isDark);
            const theme = isDark ? 'dark' : 'light';
            localStorage.setItem('diu-landing-theme', theme);
            updateMapBg(theme);
        });

        /* ── Hamburger ── */
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');
        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });
        // close on nav link click
        mobileMenu.querySelectorAll('a').forEach(a => {
            a.addEventListener('click', () => mobileMenu.classList.remove('open'));
        });

        /* ── Navbar scroll effect ── */
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.style.boxShadow = '0 4px 30px rgba(0,0,0,0.1)';
            } else {
                navbar.style.boxShadow = 'none';
            }
        });

        /* ── Scroll reveal ── */
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 60);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        /* ── Active nav link on scroll ── */
        const sections = document.querySelectorAll('section[id], footer[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(sec => {
                if (window.scrollY >= sec.offsetTop - 120) current = sec.id;
            });
            navLinks.forEach(link => {
                link.style.color = '';
                if (link.getAttribute('href') === '#' + current) {
                    link.style.color = 'var(--accent)';
                }
            });
        });
    </script>
</body>

</html>
