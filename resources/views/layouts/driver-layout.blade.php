<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="DIU Routes – driver Panel, Dhaka International University live bus tracker." />
    <title>@yield('title', 'Dashboard – DIU Routes')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,700;12..96,800&family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <style>
        :root {
            --bg: #eef2f7;
            --nav-bg: rgba(255, 255, 255, 0.92);
            --nav-border: rgba(14, 165, 168, 0.16);
            --card-bg: #ffffff;
            --txt-1: #0c1a2b;
            --txt-2: #3d5166;
            --txt-m: #7a8fa8;
            --border: rgba(14, 165, 168, 0.16);
            --accent: #0ea5a8;
            --accent2: #06b6d4;
            --glow: rgba(14, 165, 168, 0.18);
            --hover-bg: rgba(14, 165, 168, 0.07);
            --dd-bg: #ffffff;
            --dd-shadow: rgba(12, 26, 43, 0.14);
            --notif-unread: rgba(14, 165, 168, 0.08);
            --footer-bg: #e3eaf3;
            --red: #ef4444;
            --success: #22c55e;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #060f1a;
                --nav-bg: rgba(8, 24, 40, 0.94);
                --nav-border: rgba(34, 211, 216, 0.14);
                --card-bg: #0c1f30;
                --txt-1: #dff0f5;
                --txt-2: #7aafc4;
                --txt-m: #3d6a82;
                --border: rgba(34, 211, 216, 0.14);
                --accent: #22d3d8;
                --accent2: #38bdf8;
                --glow: rgba(34, 211, 216, 0.16);
                --hover-bg: rgba(34, 211, 216, 0.07);
                --dd-bg: #0d2235;
                --dd-shadow: rgba(0, 0, 0, 0.40);
                --notif-unread: rgba(34, 211, 216, 0.06);
                --footer-bg: #091826;
                --red: #f87171;
                --success: #22c55e;
            }
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--bg);
            color: var(--txt-1);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: background .3s, color .3s;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Bricolage Grotesque', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 99px;
        }

        #navbar {
            position: sticky;
            top: 0;
            z-index: 200;
            height: 62px;
            background: var(--nav-bg);
            border-bottom: 1px solid var(--nav-border);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            display: flex;
            align-items: center;
            padding: 0 20px;
            gap: 12px;
            box-shadow: 0 2px 18px rgba(0, 0, 0, 0.07);
            transition: background .3s;
            flex-shrink: 0;
        }

        /* Logo */
        .nav-logo {
            display: flex;
            align-items: center;
            gap: 9px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
            box-shadow: 0 4px 12px var(--glow);
        }

        .logo-text {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: 18px;
            color: var(--txt-1);
            line-height: 1;
        }

        .logo-text span {
            color: var(--accent);
        }

        /* Live badge */
        .live-badge {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 99px;
            border: 1px solid var(--border);
            background: var(--glow);
            color: var(--accent);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .04em;
        }

        @keyframes pd {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(34, 211, 216, .5)
            }

            50% {
                box-shadow: 0 0 0 6px rgba(34, 211, 216, 0)
            }
        }

        .pdot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
            animation: pd 2s infinite;
            display: inline-block;
        }

        /* Route info chip */
        .route-chip {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 5px 14px;
            border-radius: 99px;
            border: 1px solid var(--border);
            background: var(--hover-bg);
            font-size: 13px;
            font-weight: 700;
            color: var(--txt-2);
        }

        .route-chip i {
            color: var(--accent);
            font-size: 13px;
        }

        .nav-spacer {
            flex: 1;
        }

        /* ── Navbar right controls ── */
        .nav-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        /* Icon button base */
        .nav-icon-btn {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 11px;
            border: 1px solid var(--border);
            background: var(--card-bg);
            color: var(--txt-2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            cursor: pointer;
            transition: background .18s, color .18s, border-color .18s, transform .15s;
            flex-shrink: 0;
        }

        .nav-icon-btn:hover {
            background: var(--hover-bg);
            color: var(--accent);
            border-color: var(--accent);
            transform: scale(1.05);
        }

        .nav-icon-btn.active {
            background: var(--hover-bg);
            color: var(--accent);
            border-color: var(--accent);
        }

        /* Notification badge */
        .notif-badge {
            position: absolute;
            top: -3px;
            right: -3px;
            min-width: 17px;
            height: 17px;
            border-radius: 99px;
            background: var(--red);
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            border: 2px solid var(--nav-bg);
            line-height: 1;
            animation: badgePop .3s cubic-bezier(.22, 1, .36, 1) both;
        }

        @keyframes badgePop {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* ── Dropdown shared styles ── */
        .dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            min-width: 300px;
            background: var(--dd-bg);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 20px 60px var(--dd-shadow), 0 0 0 1px var(--border);
            z-index: 999;
            overflow: hidden;
            transform-origin: top right;
            transform: scale(0.92) translateY(-8px);
            opacity: 0;
            pointer-events: none;
            transition: opacity .2s, transform .2s cubic-bezier(.22, 1, .36, 1);
        }

        .dropdown.open {
            opacity: 1;
            transform: scale(1) translateY(0);
            pointer-events: auto;
        }

        /* Notification dropdown */
        .notif-dropdown {
            min-width: 320px;
        }

        .dd-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 18px 12px;
            border-bottom: 1px solid var(--border);
        }

        .dd-header-title {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 700;
            font-size: 15px;
            color: var(--txt-1);
        }

        .mark-read-btn {
            font-size: 12px;
            font-weight: 700;
            color: var(--accent);
            background: none;
            border: none;
            cursor: pointer;
            transition: opacity .2s;
        }

        .mark-read-btn:hover {
            opacity: .7;
        }

        /* Notification items */
        .notif-list {
            max-height: 340px;
            overflow-y: auto;
        }

        .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 13px 18px;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            transition: background .15s;
            position: relative;
        }

        .notif-item:last-child {
            border-bottom: none;
        }

        .notif-item:hover {
            background: var(--hover-bg);
        }

        .notif-item.unread {
            background: var(--notif-unread);
        }

        .notif-item.unread::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--accent);
        }

        .notif-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .notif-icon.bus {
            background: var(--glow);
            color: var(--accent);
        }

        .notif-icon.warn {
            background: rgba(251, 146, 60, .12);
            color: #fb923c;
        }

        .notif-icon.info {
            background: rgba(56, 189, 248, .10);
            color: var(--accent2);
        }

        .notif-body-title {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--txt-1);
            margin-bottom: 2px;
        }

        .notif-body-sub {
            font-size: 12px;
            color: var(--txt-2);
            line-height: 1.55;
        }

        .notif-time {
            font-size: 11px;
            color: var(--txt-m);
            margin-top: 3px;
        }

        .notif-footer {
            padding: 11px 18px;
            text-align: center;
            border-top: 1px solid var(--border);
        }

        .notif-footer a {
            font-size: 13px;
            font-weight: 700;
            color: var(--accent);
            text-decoration: none;
            transition: opacity .2s;
        }

        .notif-footer a:hover {
            opacity: .75;
        }

        /* ── User avatar button ── */
        .user-btn {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 5px 10px 5px 5px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: var(--card-bg);
            cursor: pointer;
            transition: background .18s, border-color .18s;
            flex-shrink: 0;
            position: relative;
        }

        .user-btn:hover {
            background: var(--hover-bg);
            border-color: var(--accent);
        }

        .user-btn.active {
            background: var(--hover-bg);
            border-color: var(--accent);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid var(--accent);
            background: var(--glow);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 15px;
            flex-shrink: 0;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--txt-1);
            line-height: 1;
        }

        .user-role {
            font-size: 11px;
            color: var(--accent);
            font-weight: 700;
            line-height: 1;
        }

        .user-chevron {
            font-size: 11px;
            color: var(--txt-m);
            margin-left: 2px;
            transition: transform .2s;
        }

        .user-btn.active .user-chevron {
            transform: rotate(180deg);
        }

        /* User dropdown */
        .user-dropdown {
            min-width: 220px;
        }

        .user-dd-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 18px 14px;
            border-bottom: 1px solid var(--border);
        }

        .user-dd-avatar {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--glow);
            border: 2px solid var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 20px;
            flex-shrink: 0;
        }

        .user-dd-name {
            font-size: 14px;
            font-weight: 800;
            color: var(--txt-1);
            line-height: 1.2;
        }

        .user-dd-email {
            font-size: 12px;
            color: var(--txt-m);
            margin-top: 2px;
        }

        /* Dropdown menu items */
        .dd-menu {
            padding: 6px 0;
        }

        .dd-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 600;
            color: var(--txt-2);
            cursor: pointer;
            text-decoration: none;
            transition: background .15s, color .15s;
        }

        .dd-item:hover {
            background: var(--hover-bg);
            color: var(--txt-1);
        }

        .dd-item i {
            width: 16px;
            text-align: center;
            color: var(--txt-m);
            font-size: 13px;
        }

        .dd-item:hover i {
            color: var(--accent);
        }

        .dd-item.danger {
            color: var(--red);
        }

        .dd-item.danger i {
            color: var(--red);
        }

        .dd-item.danger:hover {
            background: rgba(239, 68, 68, .07);
            color: var(--red);
        }

        .dd-hr {
            height: 1px;
            background: var(--border);
            margin: 4px 0;
        }

        /* Mobile: hide user info text on small screens */
        @media (max-width: 520px) {
            .user-info {
                display: none;
            }

            .user-chevron {
                display: none;
            }

            .live-badge {
                display: none;
            }

            .route-chip {
                display: none;
            }

            .user-btn {
                padding: 4px;
                border-radius: 10px;
            }
        }

        #main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        /* Map container */
        #map-container {
            flex: 1;
            position: relative;
            min-height: 0;
        }

        /* Actual Google Map iframe / div fills the container */
        #map {
            width: 100%;
            height: 100%;
            min-height: calc(100vh - 62px - 44px);
            border: none;
            display: block;
        }

        /* ── Map overlay controls ── */
        .map-overlay {
            position: absolute;
            z-index: 10;
            pointer-events: none;
        }

        /* Top-left: Route selector */
        .map-top-left {
            top: 16px;
            left: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            pointer-events: all;
        }

        /* Top-right: Map type toggle */
        .map-top-right {
            top: 16px;
            right: 16px;
            display: flex;
            gap: 8px;
            pointer-events: all;
        }

        /* Bottom-left: Legend */
        .map-bottom-left {
            bottom: 60px;
            left: 16px;
            pointer-events: all;
        }

        /* Overlay card style */
        .ov-card {
            background: var(--nav-bg);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 12px 16px;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 8px 28px var(--dd-shadow);
            font-size: 13px;
            font-weight: 600;
            color: var(--txt-2);
        }

        .ov-title {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 12px;
            font-weight: 800;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 8px;
        }

        .route-select {
            width: 100%;
            min-width: 180px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 12px;
            font-family: 'Nunito', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--txt-1);
            cursor: pointer;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%2322d3d8' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 28px;
            transition: border-color .2s;
        }

        .route-select:focus {
            border-color: var(--accent);
        }

        /* Map type buttons */
        .map-type-btn {
            padding: 8px 14px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--nav-bg);
            color: var(--txt-2);
            font-family: 'Nunito', sans-serif;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            backdrop-filter: blur(16px);
            transition: background .18s, color .18s, border-color .18s;
        }

        .map-type-btn:hover,
        .map-type-btn.active {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        /* Legend */
        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
            font-size: 12.5px;
            font-weight: 600;
        }

        .legend-item:last-child {
            margin-bottom: 0;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* ETA ticker at top of map */
        .eta-bar {
            position: absolute;
            top: 16px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            background: var(--nav-bg);
            border: 1px solid var(--border);
            border-radius: 99px;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 700;
            backdrop-filter: blur(16px);
            white-space: nowrap;
            box-shadow: 0 4px 18px var(--dd-shadow);
            pointer-events: none;
        }

        .eta-label {
            color: var(--txt-m);
            font-weight: 600;
        }

        .eta-val {
            color: var(--accent);
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 14px;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .4
            }
        }

        .eta-blink {
            animation: blink 1.6s ease-in-out infinite;
        }

        /* ── Map placeholder (shown before real API loads) ── */
        #map-placeholder {
            width: 100%;
            height: 100%;
            background: var(--card-bg);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            position: absolute;
            inset: 0;
        }

        .placeholder-map {
            width: 100%;
            height: 100%;
        }

        #toast {
            position: fixed;
            bottom: 26px;
            right: 26px;
            z-index: 999;
            background: var(--card-bg);
            border: 1px solid var(--success);
            color: var(--txt-1);
            padding: 13px 20px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
            transform: translateX(200%);
            transition: transform 0.4s cubic-bezier(0.17, 0.67, 0.27, 1.3);
        }

        #toast.show {
            transform: translateX(0);
        }

        #footer {
            flex-shrink: 0;
            height: 44px;
            background: var(--footer-bg);
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            font-size: 12.5px;
            color: var(--txt-m);
            font-weight: 600;
            gap: 12px;
        }

        #footer a {
            color: var(--txt-m);
            text-decoration: none;
            transition: color .2s;
        }

        #footer a:hover {
            color: var(--accent);
        }

        .footer-links {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .footer-links span {
            color: var(--border);
            margin: 0 2px;
        }

        .footer-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 0 rgba(34, 197, 94, .4);
            animation: statusPulse 2.4s infinite;
            display: inline-block;
        }

        @keyframes statusPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, .4)
            }

            50% {
                box-shadow: 0 0 0 6px rgba(34, 197, 94, 0)
            }
        }

        @media (max-width: 600px) {
            .footer-links {
                display: none;
            }
        }
    </style>
    @stack('css')
</head>

<body>

    <nav id="navbar" role="navigation" aria-label="User panel navigation">

        <!-- Logo -->
        <a href="{{ route('driver.dashboard') }}" class="nav-logo" aria-label="DIU Routes Home">
            <div class="logo-icon">
                <i class="fa-solid fa-bus-simple"></i>
            </div>
            <span class="logo-text">DIU<span>Routes</span></span>
        </a>

        <!-- Live badge -->
        <div class="live-badge">
            <span class="pdot"></span> Live
        </div>

        <div class="nav-spacer"></div>

        <!-- Right controls -->
        <div class="nav-controls">

            <!-- ── NOTIFICATION BELL ── -->
            <div style="position:relative;" id="notif-wrapper">
                <button class="nav-icon-btn" id="notif-btn" aria-label="Notifications" aria-expanded="false"
                    aria-haspopup="true">
                    <i class="fa-regular fa-bell"></i>
                    <!-- Badge — shows unread count -->
                    @php
                        $unreadNotifications = auth()->user()->unReadNotifications()->count();
                    @endphp
                    @if ($unreadNotifications > 0)
                        <span class="notif-badge" id="notif-badge">{{ $unreadNotifications }}</span>
                    @endif
                </button>

                <!-- Notification Dropdown -->
                <div class="dropdown notif-dropdown" id="notif-dropdown" role="menu">
                    <div class="dd-header">
                        <span class="dd-header-title"><i class="fa-solid fa-bell"
                                style="color:var(--accent);margin-right:6px;font-size:13px;"></i>Notifications</span>
                        <button class="mark-read-btn" onclick="markAllRead()">Mark all read</button>
                    </div>

                    <div class="notif-list" id="notif-list">

                        <div class="notif-item unread" data-id="1">
                            <div class="notif-icon bus"><i class="fa-solid fa-bus-simple"></i></div>
                            <div style="flex:1;min-width:0;">
                                <div class="notif-body-title">Bus B is 3 mins away</div>
                                <div class="notif-body-sub">Route 04 approaching Dhanmondi stop</div>
                                <div class="notif-time"><i class="fa-regular fa-clock"
                                        style="font-size:10px;margin-right:3px;"></i>Just now</div>
                            </div>
                        </div>

                        <div class="notif-item unread" data-id="2">
                            <div class="notif-icon warn"><i class="fa-solid fa-triangle-exclamation"></i></div>
                            <div style="flex:1;min-width:0;">
                                <div class="notif-body-title">Route 07 delayed</div>
                                <div class="notif-body-sub">Estimated 15 min delay due to traffic</div>
                                <div class="notif-time"><i class="fa-regular fa-clock"
                                        style="font-size:10px;margin-right:3px;"></i>5 mins ago</div>
                            </div>
                        </div>

                        <div class="notif-item unread" data-id="3">
                            <div class="notif-icon info"><i class="fa-solid fa-circle-info"></i></div>
                            <div style="flex:1;min-width:0;">
                                <div class="notif-body-title">Schedule updated</div>
                                <div class="notif-body-sub">Friday schedule changed for Route 04 & 06</div>
                                <div class="notif-time"><i class="fa-regular fa-clock"
                                        style="font-size:10px;margin-right:3px;"></i>1 hr ago</div>
                            </div>
                        </div>

                        <div class="notif-item" data-id="4">
                            <div class="notif-icon bus"><i class="fa-solid fa-bus-simple"></i></div>
                            <div style="flex:1;min-width:0;">
                                <div class="notif-body-title">Trip completed</div>
                                <div class="notif-body-sub">Bus A completed Route 02 – Mirpur run</div>
                                <div class="notif-time"><i class="fa-regular fa-clock"
                                        style="font-size:10px;margin-right:3px;"></i>3 hrs ago</div>
                            </div>
                        </div>

                        <div class="notif-item" data-id="5">
                            <div class="notif-icon info"><i class="fa-solid fa-circle-info"></i></div>
                            <div style="flex:1;min-width:0;">
                                <div class="notif-body-title">New route added</div>
                                <div class="notif-body-sub">Route 12 – Uttara now available</div>
                                <div class="notif-time"><i class="fa-regular fa-clock"
                                        style="font-size:10px;margin-right:3px;"></i>Yesterday</div>
                            </div>
                        </div>

                    </div>

                    <div class="notif-footer">
                        <a href="#">View all notifications</a>
                    </div>
                </div>
            </div><!-- /notif-wrapper -->


            <!-- ── USER BUTTON ── -->
            <div style="position:relative;" id="user-wrapper">
                <button class="user-btn" id="user-btn" aria-label="User menu" aria-expanded="false"
                    aria-haspopup="true">
                    <!-- Avatar: replace src with actual user photo -->
                    <div class="user-avatar">
                        @if (Auth::user()->photo == null)
                            <i class="fa-solid fa-user"></i>
                        @else
                            <img src="{{ Auth::user()->photo }}" alt="User Photo"
                                style="width:100%;height:100%;border-radius:20px;object-fit:cover;">
                        @endif
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">{{ Str::ucfirst(Auth::user()->role) }}</span>
                    </div>
                    <i class="fa-solid fa-chevron-down user-chevron"></i>
                </button>

                <!-- User Dropdown -->
                <div class="dropdown user-dropdown" id="user-dropdown" role="menu">
                    <!-- Profile header -->
                    <div class="user-dd-profile">
                        <div class="user-dd-avatar">
                            @if (Auth::user()->photo == null)
                                <i class="fa-solid fa-user"></i>
                            @else
                                <img src="{{ Auth::user()->photo }}" alt="User Photo"
                                    style="width:100%;height:100%;border-radius:6px;object-fit:cover;">
                            @endif
                        </div>
                        <div>
                            <div class="user-dd-name">{{ Auth::user()->name }}</div>
                            <div class="user-dd-email">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <!-- Menu items -->
                    <div class="dd-menu">
                        <a href="{{ route('driver.profile') }}" class="dd-item" role="menuitem">
                            <i class="fa-regular fa-user"></i> My Profile
                        </a>
                        <a href="{{ route('driver.settings') }}" class="dd-item" role="menuitem">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>

                        <div class="dd-hr"></div>

                        <a href="#" class="dd-item" role="menuitem">
                            <i class="fa-solid fa-circle-question"></i> Help & Support
                        </a>

                        <div class="dd-hr"></div>

                        <a href="{{ route('driver.logout') }}" class="dd-item danger" role="menuitem">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </div>
                </div>
            </div><!-- /user-wrapper -->

        </div><!-- /nav-controls -->
    </nav>

    @yield('content')


    <!-- Toast -->
    @include('errors.toast')

    <footer id="footer" role="contentinfo">
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <span>·</span>
            <a href="#">Terms</a>
            <span>·</span>
            <a href="#">Support</a>
            <span>·</span>
            <a href="https://diu.ac" target="_blank" rel="noopener">DIU Official</a>
        </div>

        <span>© 2025 DIU Routes &nbsp;·&nbsp; Dhaka International University</span>

        <div class="footer-right">
            <span class="status-dot"></span>
            <span>All systems live</span>
        </div>
    </footer>


    <!-- ══════════════════════════════════
     JAVASCRIPT
══════════════════════════════════ -->
    <script>
        /* ── Dropdown toggle helper ── */
        function toggleDropdown(ddId, btnId) {
            var dd = document.getElementById(ddId);
            var btn = document.getElementById(btnId);
            var isOpen = dd.classList.contains('open');

            // Close all dropdowns first
            document.querySelectorAll('.dropdown').forEach(function(el) {
                el.classList.remove('open');
            });
            document.querySelectorAll('.nav-icon-btn, .user-btn').forEach(function(el) {
                el.classList.remove('active');
                el.setAttribute('aria-expanded', 'false');
            });

            if (!isOpen) {
                dd.classList.add('open');
                btn.classList.add('active');
                btn.setAttribute('aria-expanded', 'true');
            }
        }

        /* ── Notification button ── */
        document.getElementById('notif-btn').addEventListener('click', function(e) {
            e.stopPropagation();
            toggleDropdown('notif-dropdown', 'notif-btn');
        });

        /* ── User button ── */
        document.getElementById('user-btn').addEventListener('click', function(e) {
            e.stopPropagation();
            toggleDropdown('user-dropdown', 'user-btn');
        });

        /* ── Close on outside click ── */
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown').forEach(function(el) {
                el.classList.remove('open');
            });
            document.querySelectorAll('.nav-icon-btn, .user-btn').forEach(function(el) {
                el.classList.remove('active');
                el.setAttribute('aria-expanded', 'false');
            });
        });

        /* Prevent dropdown close when clicking inside */
        document.querySelectorAll('.dropdown').forEach(function(dd) {
            dd.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });


        /* ── Mark all notifications as read ── */
        var unreadCount = 3;

        function markAllRead() {
            document.querySelectorAll('.notif-item.unread').forEach(function(el) {
                el.classList.remove('unread');
            });
            unreadCount = 0;
            updateBadge();
        }

        /* Click single notification to mark read */
        document.querySelectorAll('.notif-item').forEach(function(item) {
            item.addEventListener('click', function() {
                if (this.classList.contains('unread')) {
                    this.classList.remove('unread');
                    unreadCount = Math.max(0, unreadCount - 1);
                    updateBadge();
                }
            });
        });

        function updateBadge() {
            var badge = document.getElementById('notif-badge');
            if (unreadCount === 0) {
                badge.style.display = 'none';
            } else {
                badge.style.display = 'flex';
                badge.textContent = unreadCount;
            }
        }


        /* ── Map type toggle ── */
        function setMapType(type) {
            document.querySelectorAll('.map-type-btn').forEach(function(b) {
                b.classList.remove('active');
            });
            document.getElementById('btn-' + type).classList.add('active');
            // TODO: call google.maps API here — map.setMapTypeId(...)
        }


        /* ── Route change ── */
        function changeRoute(val) {
            // TODO: update map markers/polyline for selected route
            console.log('Route changed to:', val);
        }


        /* ── ETA countdown (simulated) ── */
        var etaSeconds = 3 * 60;
        setInterval(function() {
            if (etaSeconds > 0) etaSeconds--;
            var min = Math.floor(etaSeconds / 60);
            var sec = etaSeconds % 60;
            var etaEl = document.querySelector('.eta-val');
            if (etaEl) etaEl.textContent = min > 0 ? 'ETA: ' + min + ' min' : 'ETA: ' + sec + ' sec';
        }, 1000);

        function showToast() {
            var t = document.getElementById("toast");
            t.classList.add("show");
            setTimeout(function() {
                t.classList.remove("show");
            }, 3000);
        }
    </script>

    @stack('js')

    @session('success')
        <script>
            showToast();
        </script>
    @endsession

    @session('error')
        <script>
            showToast();
        </script>
    @endsession

</body>

</html>
