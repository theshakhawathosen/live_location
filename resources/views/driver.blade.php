<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DIU Routes — Driver Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Outfit:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Outfit', 'sans-serif'],
                        body: ['Plus Jakarta Sans', 'sans-serif'],
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

        :root {
            --nav-bg: rgba(255, 255, 255, 0.88);
            --nav-border: rgba(0, 0, 0, 0.07);
            --surface: #f7f9f8;
            --surface-alt: #eef1ef;
            --text-primary: #0d1a10;
            --text-muted: #5a6b5e;
            --accent: #16a067;
            --accent-glow: rgba(22, 160, 103, 0.16);
            --accent-dark: #0b8053;
            --danger: #ef4444;
            --danger-glow: rgba(239, 68, 68, 0.12);
            --warn: #f59e0b;
            --warn-glow: rgba(245, 158, 11, 0.12);
            --shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
            --panel-bg: rgba(255, 255, 255, 0.97);
            --panel-border: rgba(0, 0, 0, 0.07);
            --switch-off: #d1d5db;
            --switch-on: #16a067;
            --toggle-bg: #eaedeb;
            --badge-bg: #ef4444;
            --status-bar: #16a067;
        }

        html.dark {
            --nav-bg: rgba(10, 17, 12, 0.9);
            --nav-border: rgba(255, 255, 255, 0.07);
            --surface: #0a110c;
            --surface-alt: #111a13;
            --text-primary: #e4ede6;
            --text-muted: #6b886f;
            --accent: #38ba83;
            --accent-glow: rgba(56, 186, 131, 0.14);
            --accent-dark: #16a067;
            --shadow: 0 4px 24px rgba(0, 0, 0, 0.45);
            --panel-bg: rgba(10, 17, 12, 0.98);
            --panel-border: rgba(255, 255, 255, 0.07);
            --switch-off: #2d3d30;
            --toggle-bg: #141e16;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--surface);
            color: var(--text-primary);
            overflow: hidden;
            height: 100vh;
            transition: background 0.3s, color 0.3s;
        }

        /* ── NAVBAR ── */
        #navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 62px;
            background: var(--nav-bg);
            border-bottom: 1px solid var(--nav-border);
            backdrop-filter: blur(20px) saturate(180%);
            display: flex;
            align-items: center;
            padding: 0 1.25rem;
            gap: 0.65rem;
            transition: background 0.3s, border-color 0.3s;
        }

        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #16a067, #0b8053);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 3px var(--accent-glow);
            position: relative;
            overflow: hidden;
        }

        .logo-icon::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.18) 0%, transparent 60%);
        }

        .logo-icon i {
            color: #fff;
            font-size: 16px;
            z-index: 1;
        }

        .logo-name {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.05rem;
            letter-spacing: -0.02em;
            color: var(--text-primary);
            line-height: 1.1;
        }

        .logo-name span {
            color: var(--accent);
        }

        .logo-badge {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            background: var(--accent);
            color: #fff;
            padding: 1px 6px;
            border-radius: 20px;
            text-transform: uppercase;
            margin-left: 2px;
            vertical-align: middle;
        }

        .nav-spacer {
            flex: 1;
        }

        /* Trip status pill */
        #trip-status-pill {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 5px 12px 5px 8px;
            border-radius: 20px;
            border: 1px solid var(--panel-border);
            background: var(--toggle-bg);
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
            flex-shrink: 0;
        }

        #trip-status-pill.active {
            border-color: rgba(22, 160, 103, 0.3);
            background: var(--accent-glow);
            color: var(--accent);
        }

        #trip-status-pill.active .pill-dot {
            background: var(--accent);
            animation: pulse-online 1.8s infinite;
        }

        #trip-status-pill .pill-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--switch-off);
            flex-shrink: 0;
        }

        .nav-action {
            position: relative;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid var(--nav-border);
            background: var(--toggle-bg);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 15px;
            flex-shrink: 0;
            transition: background 0.2s, color 0.2s, transform 0.15s;
        }

        .nav-action:hover {
            background: var(--accent-glow);
            color: var(--accent);
            transform: scale(1.06);
        }

        .badge {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 8px;
            height: 8px;
            background: var(--badge-bg);
            border-radius: 50%;
            border: 2px solid var(--surface);
            animation: pulse-badge 2s infinite;
        }

        @keyframes pulse-badge {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.5);
            }

            50% {
                box-shadow: 0 0 0 4px rgba(239, 68, 68, 0);
            }
        }

        @keyframes pulse-online {
            0% {
                box-shadow: 0 0 0 0 var(--accent-glow);
            }

            70% {
                box-shadow: 0 0 0 5px transparent;
            }

            100% {
                box-shadow: 0 0 0 0 transparent;
            }
        }

        /* Dropdowns */
        .dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            min-width: 240px;
            background: var(--panel-bg);
            border: 1px solid var(--panel-border);
            border-radius: 14px;
            box-shadow: var(--shadow);
            padding: 8px;
            opacity: 0;
            pointer-events: none;
            transform: translateY(-8px) scale(0.97);
            transition: opacity 0.2s, transform 0.2s;
            z-index: 2000;
            backdrop-filter: blur(20px);
        }

        .dropdown.open {
            opacity: 1;
            pointer-events: all;
            transform: translateY(0) scale(1);
        }

        .dropdown-header {
            font-family: 'Outfit', sans-serif;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 6px 10px 4px;
        }

        .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .notif-item:hover {
            background: var(--accent-glow);
        }

        .notif-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            flex-shrink: 0;
            margin-top: 5px;
        }

        .notif-dot.read {
            background: var(--switch-off);
        }

        .notif-text {
            font-size: 0.82rem;
            color: var(--text-primary);
            line-height: 1.45;
        }

        .notif-time {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .dd-divider {
            height: 1px;
            background: var(--panel-border);
            margin: 6px 0;
        }

        .dd-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 0.88rem;
            color: var(--text-primary);
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
            text-decoration: none;
        }

        .dd-link:hover {
            background: var(--accent-glow);
            color: var(--accent);
        }

        .dd-link.danger:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .dd-link i {
            width: 18px;
            text-align: center;
            font-size: 13px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border: 1px solid var(--nav-border);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            color: #fff;
            letter-spacing: 0.03em;
            transition: transform 0.15s, box-shadow 0.2s;
            flex-shrink: 0;
        }

        .user-avatar:hover {
            transform: scale(1.06);
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
        }

        .user-info {
            padding: 10px 12px 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info-avatar {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.78rem;
            color: #fff;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--text-primary);
        }

        .user-role {
            font-size: 0.74rem;
            color: var(--text-muted);
        }

        .theme-toggle {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid var(--nav-border);
            background: var(--toggle-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            overflow: hidden;
            position: relative;
            flex-shrink: 0;
            transition: background 0.2s, transform 0.15s;
        }

        .theme-toggle:hover {
            transform: scale(1.06);
            background: var(--accent-glow);
        }

        .theme-toggle .sun-icon,
        .theme-toggle .moon-icon {
            position: absolute;
            font-size: 15px;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.3s;
        }

        .theme-toggle .sun-icon {
            color: #f59e0b;
        }

        .theme-toggle .moon-icon {
            color: #818cf8;
        }

        html.light .theme-toggle .sun-icon {
            transform: translateY(0);
            opacity: 1;
        }

        html.light .theme-toggle .moon-icon {
            transform: translateY(20px);
            opacity: 0;
        }

        html.dark .theme-toggle .sun-icon {
            transform: translateY(-20px);
            opacity: 0;
        }

        html.dark .theme-toggle .moon-icon {
            transform: translateY(0);
            opacity: 1;
        }

        /* ── MAP ── */
        #map-wrap {
            position: absolute;
            inset: 62px 0 0 0;
            z-index: 0;
        }

        #map {
            width: 100%;
            height: 100%;
        }

        .leaflet-tile-pane {
            transition: filter 0.4s;
        }

        html.dark .leaflet-tile-pane {
            filter: brightness(0.75) saturate(0.6) hue-rotate(180deg) invert(1);
        }

        html.dark .leaflet-control-attribution {
            background: rgba(10, 17, 12, 0.85) !important;
            color: #6b886f !important;
        }

        html.dark .leaflet-control-attribution a {
            color: #38ba83 !important;
        }

        html.dark .leaflet-control-zoom a {
            background: rgba(10, 17, 12, 0.92) !important;
            color: #e4ede6 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        html.dark .leaflet-control-zoom a:hover {
            background: rgba(22, 160, 103, 0.25) !important;
        }

        /* ── PANEL TOGGLE ── */
        #panel-toggle {
            position: fixed;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            z-index: 900;
            width: 28px;
            height: 56px;
            background: var(--panel-bg);
            border: 1px solid var(--panel-border);
            border-right: none;
            border-radius: 12px 0 0 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            backdrop-filter: blur(16px);
            box-shadow: -4px 0 16px rgba(0, 0, 0, 0.1);
            transition: background 0.2s, right 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #panel-toggle:hover {
            background: var(--accent-glow);
        }

        #panel-toggle i {
            color: var(--text-muted);
            font-size: 13px;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s;
        }

        #panel-toggle:hover i {
            color: var(--accent);
        }

        #panel-toggle.panel-open {
            right: 300px;
        }

        #panel-toggle.panel-open i {
            transform: rotate(180deg);
        }

        /* ── SIDE PANEL ── */
        #side-panel {
            position: fixed;
            top: 62px;
            right: 0;
            bottom: 0;
            width: 304px;
            background: var(--panel-bg);
            border-left: 1px solid var(--panel-border);
            backdrop-filter: blur(20px) saturate(160%);
            z-index: 800;
            transform: translateX(100%);
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            padding: 18px 16px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        #side-panel.open {
            transform: translateX(0);
        }

        #side-panel::-webkit-scrollbar {
            width: 4px;
        }

        #side-panel::-webkit-scrollbar-track {
            background: transparent;
        }

        #side-panel::-webkit-scrollbar-thumb {
            background: var(--switch-off);
            border-radius: 4px;
        }

        .panel-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-primary);
            letter-spacing: -0.01em;
        }

        .panel-subtitle {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 2px;
            margin-bottom: 14px;
        }

        .panel-section-label {
            font-size: 0.67rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin: 14px 0 7px;
        }

        /* Trip info card */
        .trip-card {
            background: var(--surface-alt);
            border: 1px solid var(--panel-border);
            border-radius: 12px;
            padding: 13px 14px;
            margin-bottom: 4px;
        }

        .trip-card-route {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .trip-card-meta {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .trip-meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.76rem;
            color: var(--text-muted);
        }

        .trip-meta-item i {
            font-size: 11px;
            color: var(--accent);
        }

        /* Passenger count */
        .pax-row {
            background: var(--surface-alt);
            border: 1px solid var(--panel-border);
            border-radius: 12px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .pax-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pax-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: rgba(99, 102, 241, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            color: #6366f1;
        }

        .pax-label {
            font-size: 0.84rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .pax-sub {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .pax-counter {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pax-btn {
            width: 26px;
            height: 26px;
            border-radius: 7px;
            border: 1px solid var(--panel-border);
            background: var(--surface);
            color: var(--text-primary);
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
        }

        .pax-btn:hover {
            background: var(--accent-glow);
            color: var(--accent);
            border-color: var(--accent);
        }

        .pax-num {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-primary);
            min-width: 24px;
            text-align: center;
        }

        /* Toggle rows */
        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 13px;
            border-radius: 11px;
            background: var(--surface-alt);
            border: 1px solid var(--panel-border);
            margin-bottom: 5px;
            transition: background 0.2s;
        }

        .toggle-row:hover {
            background: var(--accent-glow);
        }

        .toggle-row-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .toggle-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .toggle-label {
            font-size: 0.84rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .toggle-desc {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 1px;
        }

        /* Switch */
        .switch {
            position: relative;
            width: 42px;
            height: 24px;
            flex-shrink: 0;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .switch-slider {
            position: absolute;
            inset: 0;
            background: var(--switch-off);
            border-radius: 24px;
            cursor: pointer;
            transition: background 0.25s;
        }

        .switch-slider::before {
            content: '';
            position: absolute;
            height: 18px;
            width: 18px;
            left: 3px;
            top: 3px;
            background: #fff;
            border-radius: 50%;
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.18);
        }

        .switch input:checked+.switch-slider {
            background: var(--switch-on);
        }

        .switch input:checked+.switch-slider::before {
            transform: translateX(18px);
        }

        /* SOS button */
        .sos-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            padding: 12px;
            background: rgba(239, 68, 68, 0.08);
            border: 1.5px solid rgba(239, 68, 68, 0.25);
            border-radius: 12px;
            cursor: pointer;
            margin-top: 4px;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            color: #ef4444;
            letter-spacing: 0.02em;
            transition: background 0.2s, border-color 0.2s, transform 0.15s;
        }

        .sos-btn:hover {
            background: rgba(239, 68, 68, 0.14);
            border-color: rgba(239, 68, 68, 0.5);
            transform: scale(1.01);
        }

        .sos-btn:active {
            transform: scale(0.98);
        }

        /* End trip button */
        .end-trip-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #16a067, #0b8053);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            color: #fff;
            letter-spacing: 0.02em;
            transition: opacity 0.2s, transform 0.15s;
            box-shadow: 0 4px 14px rgba(22, 160, 103, 0.3);
        }

        .end-trip-btn:hover {
            opacity: 0.9;
            transform: scale(1.01);
        }

        .end-trip-btn:active {
            transform: scale(0.98);
        }

        /* SOS modal */
        #sos-modal {
            position: fixed;
            inset: 0;
            z-index: 9998;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s;
        }

        #sos-modal.open {
            opacity: 1;
            pointer-events: all;
        }

        .sos-modal-box {
            background: var(--panel-bg);
            border: 1px solid var(--panel-border);
            border-radius: 18px;
            padding: 28px 24px;
            max-width: 340px;
            width: 100%;
            text-align: center;
            transform: scale(0.93);
            transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        #sos-modal.open .sos-modal-box {
            transform: scale(1);
        }

        .sos-modal-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(239, 68, 68, 0.1);
            border: 2px solid rgba(239, 68, 68, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #ef4444;
            margin: 0 auto 14px;
        }

        .sos-modal-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.15rem;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .sos-modal-desc {
            font-size: 0.84rem;
            color: var(--text-muted);
            line-height: 1.55;
            margin-bottom: 20px;
        }

        .sos-modal-actions {
            display: flex;
            gap: 10px;
        }

        .sos-cancel {
            flex: 1;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid var(--panel-border);
            background: var(--surface-alt);
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--text-muted);
            cursor: pointer;
            transition: background 0.15s;
        }

        .sos-cancel:hover {
            background: var(--toggle-bg);
        }

        .sos-confirm {
            flex: 1;
            padding: 10px;
            border-radius: 10px;
            border: none;
            background: #ef4444;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.88rem;
            color: #fff;
            cursor: pointer;
            transition: opacity 0.15s;
        }

        .sos-confirm:hover {
            opacity: 0.88;
        }

        /* Responsive */
        @media (max-width: 480px) {
            #side-panel {
                width: 100vw;
            }

            #panel-toggle.panel-open {
                right: 100vw;
            }

            .logo-name {
                font-size: 0.95rem;
            }

            #trip-status-pill span {
                display: none;
            }
        }

        /* ── TOAST ── */
        #toast-container {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            pointer-events: none;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px 10px 12px;
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--panel-bg);
            border: 1px solid var(--panel-border);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            backdrop-filter: blur(16px);
            pointer-events: all;
            white-space: nowrap;
            animation: toastIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        .toast.removing {
            animation: toastOut 0.25s ease forwards;
        }

        .toast-check {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            flex-shrink: 0;
        }

        .toast.success .toast-check {
            background: rgba(22, 160, 103, 0.14);
            color: #16a067;
        }

        .toast.error .toast-check {
            background: rgba(239, 68, 68, 0.12);
            color: #ef4444;
        }

        .toast.warn .toast-check {
            background: rgba(245, 158, 11, 0.12);
            color: #f59e0b;
        }

        html.dark .toast.success .toast-check {
            color: #38ba83;
        }

        .toast-label {
            font-size: 0.84rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateY(10px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes toastOut {
            from {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

            to {
                opacity: 0;
                transform: translateY(8px) scale(0.95);
            }
        }
    </style>
</head>

<body>

    <!-- ════════════ NAVBAR ════════════ -->
    <nav id="navbar">

        <a href="#" class="logo-wrap">
            <div class="logo-icon"><i class="fa-solid fa-bus"></i></div>
            <div>
                <span class="logo-name">DIU <span>Routes</span></span>
                <span class="logo-badge">Driver</span>
            </div>
        </a>

        <div class="nav-spacer"></div>

        <!-- Trip Status Pill -->
        <div id="trip-status-pill" onclick="toggleTrip()">
            <span class="pill-dot"></span>
            <span id="pill-label">Off Duty</span>
        </div>

        <!-- Notification -->
        <div class="relative" id="notif-wrap">
            <button class="nav-action" id="notif-btn" aria-label="Notifications">
                <i class="fa-regular fa-bell"></i>
                <span class="badge"></span>
            </button>
            <div class="dropdown" id="notif-dropdown" style="min-width:276px;">
                <div class="dropdown-header">Notifications</div>
                <div class="notif-item">
                    <span class="notif-dot"></span>
                    <div>
                        <div class="notif-text"><strong>Admin:</strong> Route 4 timing updated — depart 08:00 AM today.
                        </div>
                        <div class="notif-time"><i class="fa-regular fa-clock" style="font-size:10px;"></i> 5 min ago
                        </div>
                    </div>
                </div>
                <div class="notif-item">
                    <span class="notif-dot"></span>
                    <div>
                        <div class="notif-text">Maintenance reminder: Bus <strong>DIU-04</strong> due for servicing
                            Friday.</div>
                        <div class="notif-time"><i class="fa-regular fa-clock" style="font-size:10px;"></i> 1 hour ago
                        </div>
                    </div>
                </div>
                <div class="notif-item">
                    <span class="notif-dot read"></span>
                    <div>
                        <div class="notif-text" style="opacity:0.6;">Your attendance for yesterday has been recorded.
                        </div>
                        <div class="notif-time"><i class="fa-regular fa-clock" style="font-size:10px;"></i> Yesterday
                        </div>
                    </div>
                </div>
                <div class="dd-divider"></div>
                <a href="#" class="dd-link"
                    style="justify-content:center;color:var(--accent);font-size:0.82rem;font-weight:600;">View all</a>
            </div>
        </div>

        <!-- Theme -->
        <button class="theme-toggle" id="theme-btn" aria-label="Toggle theme">
            <i class="fa-solid fa-sun sun-icon"></i>
            <i class="fa-solid fa-moon moon-icon"></i>
        </button>

        <!-- User -->
        <div class="relative" id="user-wrap">
            <div class="user-avatar" id="user-btn">RK</div>
            <div class="dropdown" id="user-dropdown" style="min-width:220px;">
                <div class="user-info">
                    <div class="user-info-avatar">RK</div>
                    <div>
                        <div class="user-name">Rahim Khan</div>
                        <div class="user-role">Driver · Bus DIU-04</div>
                    </div>
                </div>
                <div class="dd-divider"></div>
                <a href="#" class="dd-link"><i class="fa-regular fa-id-card"></i> My Profile</a>
                <a href="#" class="dd-link"><i class="fa-solid fa-clock-rotate-left"></i> Trip History</a>
                <a href="#" class="dd-link"><i class="fa-regular fa-circle-question"></i> Help & Support</a>
                <div class="dd-divider"></div>
                <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dd-link danger">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <form id="logout-form" action="/logout" method="POST" style="display:none;"></form>

    <!-- ════════════ MAP ════════════ -->
    <div id="map-wrap">
        <div id="map"></div>
    </div>

    <!-- ════════════ PANEL TOGGLE ════════════ -->
    <button id="panel-toggle" aria-label="Toggle panel">
        <i class="fa-solid fa-chevron-left"></i>
    </button>

    <!-- ════════════ SIDE PANEL ════════════ -->
    <aside id="side-panel">

        <!-- Header -->
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:8px;margin-bottom:2px;">
            <div>
                <div class="panel-title">Driver Controls</div>
                <div class="panel-subtitle">Manage your trip & visibility settings</div>
            </div>
            <button id="panel-close-btn"
                style="flex-shrink:0;width:30px;height:30px;border-radius:8px;border:1px solid var(--panel-border);background:var(--surface-alt);color:var(--text-muted);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:13px;margin-top:2px;transition:background 0.2s,color 0.2s;"
                onmouseover="this.style.background='rgba(239,68,68,0.1)';this.style.color='#ef4444';"
                onmouseout="this.style.background='var(--surface-alt)';this.style.color='var(--text-muted)';">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Active Trip Card -->
        <div class="panel-section-label">Current Trip</div>
        <div class="trip-card">
            <div class="trip-card-route"><i class="fa-solid fa-route"
                    style="color:var(--accent);margin-right:7px;font-size:13px;"></i>Route 4 — Mirpur to DIU</div>
            <div class="trip-card-meta">
                <div class="trip-meta-item"><i class="fa-solid fa-bus"></i> DIU-04</div>
                <div class="trip-meta-item"><i class="fa-solid fa-clock"></i> Depart 08:00 AM</div>
                <div class="trip-meta-item"><i class="fa-solid fa-calendar-day"></i> Today</div>
            </div>
        </div>

        <!-- Passenger Count -->
        <div class="pax-row">
            <div class="pax-left">
                <div class="pax-icon"><i class="fa-solid fa-users"></i></div>
                <div>
                    <div class="pax-label">Passengers</div>
                    <div class="pax-sub">Onboard count</div>
                </div>
            </div>
            <div class="pax-counter">
                <button class="pax-btn" onclick="changePax(-1)">−</button>
                <div class="pax-num" id="pax-count">0</div>
                <button class="pax-btn" onclick="changePax(1)">+</button>
            </div>
        </div>

        <!-- Status -->
        <div class="panel-section-label">Status</div>

        <div class="toggle-row" id="online-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(22,160,103,0.12);">
                    <i class="fa-solid fa-satellite-dish" style="color:var(--accent);"></i>
                </div>
                <div>
                    <div class="toggle-label">Go Online</div>
                    <div class="toggle-desc">Broadcast your live location</div>
                </div>
            </div>
            <label class="switch"><input type="checkbox" id="sw-online"
                    onchange="handleSwitch(this,'online-row')"><span class="switch-slider"></span></label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(245,158,11,0.12);">
                    <i class="fa-solid fa-bus" style="color:#f59e0b;"></i>
                </div>
                <div>
                    <div class="toggle-label">Accepting Passengers</div>
                    <div class="toggle-desc">Allow students to board</div>
                </div>
            </div>
            <label class="switch"><input type="checkbox" id="sw-boarding" checked
                    onchange="handleSwitch(this)"><span class="switch-slider"></span></label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(99,102,241,0.12);">
                    <i class="fa-solid fa-bell-slash" style="color:#6366f1;"></i>
                </div>
                <div>
                    <div class="toggle-label">Mute Notifications</div>
                    <div class="toggle-desc">Silence alerts while driving</div>
                </div>
            </div>
            <label class="switch"><input type="checkbox" id="sw-mute" onchange="handleSwitch(this)"><span
                    class="switch-slider"></span></label>
        </div>

        <!-- Navigation -->
        <div class="panel-section-label">Navigation</div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(22,160,103,0.12);">
                    <i class="fa-solid fa-road" style="color:var(--accent);"></i>
                </div>
                <div>
                    <div class="toggle-label">Show My Route</div>
                    <div class="toggle-desc">Highlight your assigned route</div>
                </div>
            </div>
            <label class="switch"><input type="checkbox" id="sw-route" checked onchange="handleSwitch(this)"><span
                    class="switch-slider"></span></label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(59,130,246,0.12);">
                    <i class="fa-solid fa-location-dot" style="color:#3b82f6;"></i>
                </div>
                <div>
                    <div class="toggle-label">Show All Stops</div>
                    <div class="toggle-desc">Pickup & drop-off markers</div>
                </div>
            </div>
            <label class="switch"><input type="checkbox" id="sw-stops" checked onchange="handleSwitch(this)"><span
                    class="switch-slider"></span></label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(245,158,11,0.12);">
                    <i class="fa-solid fa-triangle-exclamation" style="color:#f59e0b;"></i>
                </div>
                <div>
                    <div class="toggle-label">Speed Alerts</div>
                    <div class="toggle-desc">Warn at 60+ km/h on campus</div>
                </div>
            </div>
            <label class="switch"><input type="checkbox" id="sw-speed" checked onchange="handleSwitch(this)"><span
                    class="switch-slider"></span></label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(16,185,129,0.1);">
                    <i class="fa-solid fa-traffic-light" style="color:#10b981;"></i>
                </div>
                <div>
                    <div class="toggle-label">Traffic Layer</div>
                    <div class="toggle-desc">Real-time road conditions</div>
                </div>
            </div>
            <label class="switch"><input type="checkbox" id="sw-traffic" onchange="handleSwitch(this)"><span
                    class="switch-slider"></span></label>
        </div>

        <!-- Display -->
        <div class="panel-section-label">Display</div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(168,85,247,0.1);">
                    <i class="fa-solid fa-van-shuttle" style="color:#a855f7;"></i>
                </div>
                <div>
                    <div class="toggle-label">Show Other Vehicles</div>
                    <div class="toggle-desc">Other buses & hiaces on map</div>
                </div>
            </div>
            <label class="switch"><input type="checkbox" id="sw-others" onchange="handleSwitch(this)"><span
                    class="switch-slider"></span></label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(99,102,241,0.12);">
                    <i class="fa-solid fa-user-group" style="color:#6366f1;"></i>
                </div>
                <div>
                    <div class="toggle-label">Show Waiting Students</div>
                    <div class="toggle-desc">Students at stops near you</div>
                </div>
            </div>
            <label class="switch"><input type="checkbox" id="sw-students" checked
                    onchange="handleSwitch(this)"><span class="switch-slider"></span></label>
        </div>

        <!-- Actions -->
        <div class="panel-section-label">Actions</div>

        <button class="end-trip-btn" onclick="endTrip()">
            <i class="fa-solid fa-flag-checkered"></i> End Trip
        </button>

        <button class="sos-btn" onclick="openSOS()" style="margin-top:8px;">
            <i class="fa-solid fa-circle-exclamation"></i> SOS — Emergency
        </button>

        <!-- Footer -->
        <div
            style="margin-top:16px;padding-top:13px;font-size:0.73rem;color:var(--text-muted);text-align:center;border-top:1px solid var(--panel-border);">
            <i class="fa-solid fa-shield-halved" style="color:var(--accent);"></i>
            DIU Routes Driver v1.0 &mdash; Stay Safe
        </div>

    </aside>

    <!-- ════════════ SOS MODAL ════════════ -->
    <div id="sos-modal">
        <div class="sos-modal-box">
            <div class="sos-modal-icon"><i class="fa-solid fa-circle-exclamation"></i></div>
            <div class="sos-modal-title">Send Emergency Alert?</div>
            <div class="sos-modal-desc">This will immediately notify the DIU transport admin and security team with
                your current GPS location.</div>
            <div class="sos-modal-actions">
                <button class="sos-cancel" onclick="closeSOS()">Cancel</button>
                <button class="sos-confirm" onclick="confirmSOS()">Send SOS</button>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast-container"></div>

    <!-- ════════════ SCRIPTS ════════════ -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        /* ── Theme ── */
        (function() {
            const s = localStorage.getItem('diu-driver-theme') || 'light';
            document.documentElement.className = s;
        })();
        document.getElementById('theme-btn').addEventListener('click', () => {
            const d = document.documentElement.classList.toggle('dark');
            document.documentElement.classList.toggle('light', !d);
            localStorage.setItem('diu-driver-theme', d ? 'dark' : 'light');
        });

        /* ── Dropdowns ── */
        function setupDropdown(b, d) {
            document.getElementById(b).addEventListener('click', e => {
                e.stopPropagation();
                const isOpen = document.getElementById(d).classList.contains('open');
                document.querySelectorAll('.dropdown').forEach(x => x.classList.remove('open'));
                if (!isOpen) document.getElementById(d).classList.add('open');
            });
        }
        setupDropdown('notif-btn', 'notif-dropdown');
        setupDropdown('user-btn', 'user-dropdown');
        document.addEventListener('click', () => document.querySelectorAll('.dropdown').forEach(d => d.classList.remove(
            'open')));
        document.querySelectorAll('.dropdown').forEach(d => d.addEventListener('click', e => e.stopPropagation()));

        /* ── Panel ── */
        const panelToggle = document.getElementById('panel-toggle');
        const sidePanel = document.getElementById('side-panel');
        panelToggle.addEventListener('click', () => {
            sidePanel.classList.toggle('open');
            panelToggle.classList.toggle('panel-open');
        });
        document.getElementById('panel-close-btn').addEventListener('click', () => {
            sidePanel.classList.remove('open');
            panelToggle.classList.remove('panel-open');
        });
        sidePanel.addEventListener('transitionend', () => map.invalidateSize());

        /* ── Trip Status Pill ── */
        let onDuty = false;

        function toggleTrip() {
            onDuty = !onDuty;
            const pill = document.getElementById('trip-status-pill');
            const label = document.getElementById('pill-label');
            const swOnline = document.getElementById('sw-online');
            pill.classList.toggle('active', onDuty);
            label.textContent = onDuty ? 'On Duty' : 'Off Duty';
            if (onDuty) {
                swOnline.checked = true;
                document.getElementById('online-row').classList.add('online-active');
                showToast('success', 'On Duty — Location broadcasting');
            } else {
                swOnline.checked = false;
                document.getElementById('online-row').classList.remove('online-active');
                showToast('warn', 'Off Duty — Location hidden');
            }
        }

        /* ── Passenger counter ── */
        let paxCount = 0;

        function changePax(delta) {
            paxCount = Math.max(0, Math.min(60, paxCount + delta));
            document.getElementById('pax-count').textContent = paxCount;
            showToast('success', `Passengers — ${paxCount} onboard`);
        }

        /* ── End trip ── */
        function endTrip() {
            onDuty = false;
            const pill = document.getElementById('trip-status-pill');
            pill.classList.remove('active');
            document.getElementById('pill-label').textContent = 'Off Duty';
            document.getElementById('sw-online').checked = false;
            document.getElementById('online-row').classList.remove('online-active');
            paxCount = 0;
            document.getElementById('pax-count').textContent = '0';
            showToast('success', 'Trip Ended — Good work!');
        }

        /* ── SOS ── */
        function openSOS() {
            document.getElementById('sos-modal').classList.add('open');
        }

        function closeSOS() {
            document.getElementById('sos-modal').classList.remove('open');
        }

        function confirmSOS() {
            closeSOS();
            showToast('error', 'SOS Sent — Help is on the way');
        }
        document.getElementById('sos-modal').addEventListener('click', function(e) {
            if (e.target === this) closeSOS();
        });

        /* ── Toast ── */
        const switchMeta = {
            'sw-online': 'Go Online',
            'sw-boarding': 'Accepting Passengers',
            'sw-mute': 'Mute Notifications',
            'sw-route': 'Show My Route',
            'sw-stops': 'Show All Stops',
            'sw-speed': 'Speed Alerts',
            'sw-traffic': 'Traffic Layer',
            'sw-others': 'Show Other Vehicles',
            'sw-students': 'Show Waiting Students',
        };

        function showToast(type, label) {
            const c = document.getElementById('toast-container');
            const t = document.createElement('div');
            t.className = `toast ${type}`;
            const icon = type === 'success' ? 'fa-check' : type === 'warn' ? 'fa-triangle-exclamation' : 'fa-xmark';
            t.innerHTML =
                `<div class="toast-check"><i class="fa-solid ${icon}"></i></div><div class="toast-label">${label}</div>`;
            c.appendChild(t);
            setTimeout(() => {
                t.classList.add('removing');
                setTimeout(() => t.remove(), 250);
            }, 2500);
        }

        function handleSwitch(input, rowId) {
            const on = input.checked;
            const id = input.id;
            const name = switchMeta[id] || id;

            if (id === 'sw-online') {
                const row = document.getElementById('online-row');
                on ? row.classList.add('online-active') : row.classList.remove('online-active');
                onDuty = on;
                document.getElementById('trip-status-pill').classList.toggle('active', on);
                document.getElementById('pill-label').textContent = on ? 'On Duty' : 'Off Duty';
            }

            if (id === 'sw-traffic') {
                input.checked = false;
                showToast('error', 'Traffic Layer — Not Available');
                return;
            }

            showToast('success', `${name} — ${on ? 'Enabled' : 'Disabled'}`);
        }

        /* ── Leaflet Map ── */
        const DIU = [23.8760, 90.3707];
        const map = L.map('map', {
            center: DIU,
            zoom: 15,
            zoomControl: true
        });
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        function makeIcon(color, icon) {
            return L.divIcon({
                className: '',
                iconSize: [36, 36],
                iconAnchor: [18, 36],
                popupAnchor: [0, -38],
                html: `<div style="width:36px;height:36px;background:${color};border-radius:50% 50% 50% 4px;transform:rotate(-45deg);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,0.25);border:2px solid rgba(255,255,255,0.8);">
            <i class="fa-solid ${icon}" style="transform:rotate(45deg);color:#fff;font-size:14px;"></i></div>`
            });
        }

        // Driver's own position (pulsing)
        const driverIcon = L.divIcon({
            className: '',
            iconSize: [46, 46],
            iconAnchor: [23, 23],
            html: `<div style="width:46px;height:46px;display:flex;align-items:center;justify-content:center;position:relative;">
        <div style="position:absolute;width:46px;height:46px;border-radius:50%;background:rgba(245,158,11,0.2);animation:pulse-badge 2s infinite;"></div>
        <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;border:2px solid #fff;box-shadow:0 3px 10px rgba(245,158,11,0.4);z-index:1;">
            <i class="fa-solid fa-bus" style="color:#fff;font-size:13px;"></i></div></div>`
        });
        L.marker(DIU, {
                icon: driverIcon
            }).addTo(map)
            .bindPopup(
                `<div style="font-family:'Plus Jakarta Sans',sans-serif;padding:4px;"><strong style="font-family:'Outfit',sans-serif;">Your Location</strong><br><small style="color:#666;">Bus DIU-04</small></div>`
                );

        // DIU campus
        L.marker([23.8790, 90.3730], {
                icon: makeIcon('#16a067', 'fa-university')
            }).addTo(map)
            .bindPopup(
                `<div style="font-family:'Plus Jakarta Sans',sans-serif;padding:4px;"><strong style="font-family:'Outfit',sans-serif;">DIU Campus</strong><br><small style="color:#666;">Final Destination</small></div>`
                );

        // Stop markers
        [
            [23.8840, 90.3610, 'Stop 1 — Hemayetpur'],
            [23.8900, 90.3540, 'Stop 2 — Bypass'],
            [23.8820, 90.3480, 'Stop 3 — Mirpur-2']
        ].forEach(([lat, lng, name]) => {
            L.marker([lat, lng], {
                    icon: makeIcon('#3b82f6', 'fa-location-dot')
                }).addTo(map)
                .bindPopup(
                    `<div style="font-family:'Plus Jakarta Sans',sans-serif;padding:4px;"><strong style="font-family:'Outfit',sans-serif;">${name}</strong><br><small style="color:#666;">Pickup Stop</small></div>`
                    );
        });

        // Waiting student icons
        [
            [23.8845, 90.3615],
            [23.8896, 90.3548]
        ].forEach(([lat, lng]) => {
            L.marker([lat, lng], {
                    icon: makeIcon('#6366f1', 'fa-person')
                }).addTo(map)
                .bindPopup(
                    `<div style="font-family:'Plus Jakarta Sans',sans-serif;padding:4px;"><strong style="font-family:'Outfit',sans-serif;">Waiting Student</strong></div>`
                    );
        });

        // Route polyline
        L.polyline([
            [23.8820, 90.3480],
            [23.8900, 90.3540],
            [23.8840, 90.3610],
            [23.8760, 90.3707],
            [23.8790, 90.3730]
        ], {
            color: '#f59e0b',
            weight: 4,
            opacity: 0.8,
            dashArray: '10,6',
            lineCap: 'round'
        }).addTo(map);

        window.addEventListener('resize', () => map.invalidateSize());
    </script>
</body>

</html>
