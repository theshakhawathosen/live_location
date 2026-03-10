<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="DIU Routes is currently under maintenance. We'll be back shortly."/>
    <title>Maintenance — DIU Routes</title>

    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --accent:        #16a067;
            --accent-2:      #38ba83;
            --accent-light:  #72d5a8;
            --accent-glow:   rgba(22,160,103,0.16);
            --accent-glow-s: rgba(22,160,103,0.30);
        }

        html[data-theme="dark"] {
            --bg:           #080f0a;
            --bg-card:      #0d1710;
            --bg-alt:       #111e14;
            --text-primary: #e4ede6;
            --text-muted:   #5a7860;
            --text-faint:   #2d4232;
            --border:       rgba(22,160,103,0.13);
            --border-h:     rgba(22,160,103,0.32);
            --shadow:       0 30px 90px rgba(0,0,0,0.6), 0 0 0 1px rgba(22,160,103,0.08);
            --grid:         rgba(22,160,103,0.045);
            --nav-bg:       rgba(8,15,10,0.82);
            --warn-bg:      rgba(245,158,11,0.08);
            --warn-border:  rgba(245,158,11,0.22);
        }

        html[data-theme="light"] {
            --bg:           #f2f8f4;
            --bg-card:      #ffffff;
            --bg-alt:       #eaf3ec;
            --text-primary: #0d1a10;
            --text-muted:   #4a6450;
            --text-faint:   #b8d4be;
            --border:       rgba(22,160,103,0.14);
            --border-h:     rgba(22,160,103,0.38);
            --shadow:       0 20px 70px rgba(22,160,103,0.09), 0 2px 10px rgba(0,0,0,0.05);
            --grid:         rgba(22,160,103,0.065);
            --nav-bg:       rgba(242,248,244,0.88);
            --warn-bg:      rgba(245,158,11,0.07);
            --warn-border:  rgba(245,158,11,0.22);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
            transition: background 0.3s, color 0.3s;
            overflow-x: hidden;
        }

        /* ── GRID BG ── */
        .bg-grid {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image:
                linear-gradient(var(--grid) 1px, transparent 1px),
                linear-gradient(90deg, var(--grid) 1px, transparent 1px);
            background-size: 44px 44px;
        }

        /* ── ORBS ── */
        .orb { position: fixed; border-radius: 50%; filter: blur(110px); pointer-events: none; z-index: 0; }
        html[data-theme="dark"] .orb-1  { width:580px; height:580px; top:-150px; left:-130px; background:radial-gradient(circle,rgba(22,160,103,0.11),transparent 70%); }
        html[data-theme="light"] .orb-1 { width:580px; height:580px; top:-150px; left:-130px; background:radial-gradient(circle,rgba(22,160,103,0.13),transparent 70%); }
        html[data-theme="dark"] .orb-2  { width:440px; height:440px; bottom:-80px; right:-70px; background:radial-gradient(circle,rgba(56,186,131,0.07),transparent 70%); }
        html[data-theme="light"] .orb-2 { width:440px; height:440px; bottom:-80px; right:-70px; background:radial-gradient(circle,rgba(56,186,131,0.09),transparent 70%); }
        html[data-theme="dark"] .orb-3  { width:300px; height:300px; top:50%; left:50%; transform:translate(-50%,-50%); background:radial-gradient(circle,rgba(245,158,11,0.04),transparent 70%); }
        html[data-theme="light"] .orb-3 { width:300px; height:300px; top:50%; left:50%; transform:translate(-50%,-50%); background:radial-gradient(circle,rgba(245,158,11,0.05),transparent 70%); }

        /* ── NAVBAR ── */
        nav {
            position: fixed; top:0; left:0; right:0; z-index:100;
            height:62px; display:flex; align-items:center; justify-content:space-between;
            padding:0 1.5rem;
            background:var(--nav-bg);
            border-bottom:1px solid var(--border);
            backdrop-filter:blur(18px) saturate(180%);
            -webkit-backdrop-filter:blur(18px) saturate(180%);
            transition:background 0.3s, border-color 0.3s;
        }
        .nav-logo { display:flex; align-items:center; gap:10px; text-decoration:none; flex-shrink:0; }
        .logo-icon-wrap { position:relative; width:36px; height:36px; }
        .logo-icon-wrap .icon-bg {
            width:36px; height:36px; border-radius:10px;
            background:linear-gradient(135deg,#16a067,#0b8053);
            display:flex; align-items:center; justify-content:center;
            box-shadow:0 0 0 3px var(--accent-glow);
        }
        .logo-icon-wrap .icon-bg i { color:#fff; font-size:15px; }
        .logo-icon-wrap .icon-pin {
            position:absolute; bottom:-2px; right:-2px;
            width:15px; height:15px; border-radius:50%;
            background:#16a067; border:2px solid var(--bg);
            display:flex; align-items:center; justify-content:center;
            transition:border-color 0.3s;
        }
        .logo-icon-wrap .icon-pin i { color:#fff; font-size:6px; }
        .logo-name {
            font-family:'Outfit',sans-serif; font-weight:800;
            font-size:1.05rem; letter-spacing:-0.02em;
            color:var(--text-primary); line-height:1;
        }
        .logo-name span { color:var(--accent); }

        .theme-toggle {
            width:40px; height:40px; border-radius:50%;
            border:1px solid var(--border); background:transparent;
            cursor:pointer; display:grid; place-items:center; font-size:15px;
            transition:background 0.2s, border-color 0.2s, transform 0.15s;
            position:relative; overflow:hidden;
        }
        .theme-toggle:hover { background:var(--accent-glow); border-color:var(--border-h); transform:scale(1.06); }
        .theme-toggle .t-sun  { color:#f59e0b; position:absolute; transition:transform 0.4s cubic-bezier(0.34,1.56,0.64,1),opacity 0.3s; }
        .theme-toggle .t-moon { color:#818cf8; position:absolute; transition:transform 0.4s cubic-bezier(0.34,1.56,0.64,1),opacity 0.3s; }
        html[data-theme="dark"]  .theme-toggle .t-sun  { transform:translateY(-20px); opacity:0; }
        html[data-theme="dark"]  .theme-toggle .t-moon { transform:translateY(0); opacity:1; }
        html[data-theme="light"] .theme-toggle .t-sun  { transform:translateY(0); opacity:1; }
        html[data-theme="light"] .theme-toggle .t-moon { transform:translateY(20px); opacity:0; }

        /* ── MAIN ── */
        main {
            min-height:100vh; display:flex; align-items:center; justify-content:center;
            padding:80px 1rem 2rem; position:relative; z-index:1;
        }

        /* ── CARD ── */
        .card {
            width:100%; max-width:500px;
            background:var(--bg-card); border:1px solid var(--border);
            border-radius:28px; padding:2.75rem 2.5rem;
            box-shadow:var(--shadow);
            position:relative; overflow:hidden;
            animation:fadeUp 0.6s cubic-bezier(0.34,1.28,0.64,1) both;
        }
        .card::before {
            content:''; position:absolute; top:0; left:10%; right:10%; height:1px;
            background:linear-gradient(90deg, transparent, var(--accent), transparent);
            opacity:0.55;
        }
        .card::after {
            content:''; position:absolute; top:-80px; left:-80px;
            width:240px; height:240px; border-radius:50%;
            background:radial-gradient(circle, var(--accent-glow), transparent 70%);
            pointer-events:none;
        }
        @keyframes fadeUp {
            from { opacity:0; transform:translateY(30px) scale(0.97); }
            to   { opacity:1; transform:translateY(0) scale(1); }
        }

        /* ── GEAR ICON AREA ── */
        .icon-wrap {
            width:80px; height:80px; margin:0 auto 1.75rem;
            position:relative; display:flex; align-items:center; justify-content:center;
        }
        .icon-wrap .ring {
            position:absolute; inset:0; border-radius:50%;
            border:1.5px solid var(--border);
            animation:spinRing 12s linear infinite;
        }
        .icon-wrap .ring-2 {
            position:absolute; inset:6px; border-radius:50%;
            border:1px dashed var(--accent-glow-s);
            animation:spinRing 8s linear infinite reverse;
        }
        @keyframes spinRing { to { transform:rotate(360deg); } }
        .icon-wrap .icon-core {
            width:56px; height:56px; border-radius:18px;
            background:linear-gradient(135deg, rgba(22,160,103,0.15), rgba(22,160,103,0.05));
            border:1px solid var(--border-h);
            display:flex; align-items:center; justify-content:center;
            position:relative; z-index:1;
        }
        .icon-wrap .icon-core i {
            font-size:24px; color:var(--accent);
            animation:gearSpin 6s linear infinite;
        }
        @keyframes gearSpin { to { transform:rotate(360deg); } }

        /* ── WARNING BANNER ── */
        .warn-banner {
            display:flex; align-items:flex-start; gap:12px;
            padding:14px 16px; border-radius:14px; margin-bottom:1.75rem;
            background:var(--warn-bg); border:1px solid var(--warn-border);
        }
        .warn-icon {
            width:30px; height:30px; border-radius:9px; flex-shrink:0;
            background:rgba(245,158,11,0.12);
            display:flex; align-items:center; justify-content:center;
            font-size:13px; color:#f59e0b; margin-top:1px;
        }
        .warn-text { font-size:0.83rem; line-height:1.6; color:var(--text-muted); }
        .warn-text strong { color:var(--text-primary); font-weight:700; }

        /* ── TITLE ── */
        .card-title {
            font-family:'Outfit',sans-serif; font-weight:900;
            font-size:clamp(1.6rem,5vw,2.1rem); line-height:1.15;
            letter-spacing:-0.03em; color:var(--text-primary);
            margin-bottom:0.6rem; text-align:center;
        }
        .card-title .highlight {
            background:linear-gradient(135deg,#16a067,#38ba83);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent;
            background-clip:text;
        }
        .card-sub {
            font-size:0.875rem; line-height:1.7; color:var(--text-muted);
            text-align:center; margin-bottom:2rem;
        }

        /* ── PROGRESS BAR ── */
        .progress-wrap { margin-bottom:1.75rem; }
        .progress-label {
            display:flex; justify-content:space-between; align-items:center;
            margin-bottom:8px;
        }
        .progress-label span { font-size:0.78rem; font-weight:600; color:var(--text-muted); }
        .progress-label .pct { color:var(--accent); font-family:'Outfit',sans-serif; font-weight:800; }
        .progress-track {
            height:7px; border-radius:99px; overflow:hidden;
            background:var(--bg-alt); border:1px solid var(--border);
        }
        .progress-fill {
            height:100%; border-radius:99px; width:72%;
            background:linear-gradient(90deg,#16a067,#38ba83,#72d5a8);
            background-size:200% 100%;
            animation:progressShimmer 2.5s linear infinite;
            position:relative;
        }
        .progress-fill::after {
            content:''; position:absolute; right:0; top:0; bottom:0;
            width:20px;
            background:linear-gradient(90deg, transparent, rgba(255,255,255,0.35));
            animation:progressGlow 1.5s ease-in-out infinite;
        }
        @keyframes progressShimmer { to { background-position:200% 0; } }
        @keyframes progressGlow { 0%,100%{opacity:0.5} 50%{opacity:1} }

        /* ── COUNTDOWN ── */
        .countdown-row {
            display:flex; justify-content:center; gap:10px; margin-bottom:1.75rem;
        }
        .countdown-block {
            flex:1; max-width:80px; text-align:center;
            background:var(--bg-alt); border:1px solid var(--border);
            border-radius:14px; padding:14px 8px;
            transition:border-color 0.2s;
        }
        .countdown-block:hover { border-color:var(--border-h); }
        .countdown-num {
            font-family:'Outfit',sans-serif; font-weight:900;
            font-size:1.75rem; color:var(--accent); line-height:1;
            letter-spacing:-0.02em;
        }
        .countdown-label {
            font-size:0.65rem; font-weight:700; letter-spacing:0.08em;
            text-transform:uppercase; color:var(--text-muted); margin-top:4px;
        }
        .countdown-sep {
            font-family:'Outfit',sans-serif; font-weight:900; font-size:1.5rem;
            color:var(--text-faint); align-self:center; padding-bottom:4px;
        }

        /* ── STATUS ROW ── */
        .status-row {
            display:flex; flex-direction:column; gap:8px; margin-bottom:1.75rem;
        }
        .status-item {
            display:flex; align-items:center; justify-content:space-between;
            padding:10px 14px; border-radius:12px;
            background:var(--bg-alt); border:1px solid var(--border);
        }
        .status-left { display:flex; align-items:center; gap:10px; }
        .status-dot { width:8px; height:8px; border-radius:50%; flex-shrink:0; }
        .status-dot.ok      { background:#16a067; animation:pulseDot 2s infinite; }
        .status-dot.warn    { background:#f59e0b; animation:pulseDot 2s infinite 0.5s; }
        .status-dot.offline { background:#ef4444; }
        @keyframes pulseDot {
            0%,100%{ box-shadow:0 0 0 0 currentColor; }
            50%    { box-shadow:0 0 0 4px transparent; }
        }
        .status-name { font-size:0.82rem; font-weight:600; color:var(--text-primary); }
        .status-badge {
            font-size:0.68rem; font-weight:700; padding:3px 10px;
            border-radius:99px; letter-spacing:0.04em;
        }
        .status-badge.ok      { background:rgba(22,160,103,0.12); color:var(--accent); }
        .status-badge.warn    { background:rgba(245,158,11,0.1);  color:#f59e0b; }
        .status-badge.offline { background:rgba(239,68,68,0.1);   color:#ef4444; }

        /* ── NOTIFY FORM ── */
        .notify-wrap {
            display:flex; gap:8px; margin-bottom:1.25rem;
        }
        .notify-input {
            flex:1; padding:11px 14px; border-radius:12px;
            border:1px solid var(--border); background:var(--bg-alt);
            font-family:'Plus Jakarta Sans',sans-serif; font-size:0.875rem;
            color:var(--text-primary); outline:none;
            transition:border-color 0.2s, box-shadow 0.2s;
        }
        .notify-input::placeholder { color:var(--text-muted); }
        .notify-input:focus { border-color:var(--border-h); box-shadow:0 0 0 3px var(--accent-glow); }
        .notify-btn {
            padding:11px 18px; border-radius:12px; border:none; cursor:pointer;
            background:linear-gradient(135deg,#16a067,#0b8053);
            color:#fff; font-family:'Outfit',sans-serif;
            font-size:0.875rem; font-weight:700;
            box-shadow:0 4px 14px rgba(22,160,103,0.3);
            transition:transform 0.15s, box-shadow 0.15s, opacity 0.15s;
            position:relative; overflow:hidden; white-space:nowrap;
        }
        .notify-btn::before {
            content:''; position:absolute; inset:0;
            background:linear-gradient(135deg,rgba(255,255,255,0.14),transparent);
            pointer-events:none;
        }
        .notify-btn:hover { transform:translateY(-2px); box-shadow:0 8px 22px rgba(22,160,103,0.4); }
        .notify-btn:active { transform:translateY(0); }

        /* ── SUCCESS MSG ── */
        .success-msg {
            display:none; align-items:center; gap:8px;
            padding:10px 14px; border-radius:12px; margin-bottom:1rem;
            background:rgba(22,160,103,0.1); border:1px solid rgba(22,160,103,0.25);
            font-size:0.82rem; font-weight:600; color:var(--accent);
            animation:fadeUp 0.3s ease;
        }
        .success-msg.show { display:flex; }

        /* ── FOOTER LINKS ── */
        .footer-links {
            display:flex; justify-content:center; gap:16px; flex-wrap:wrap;
            margin-top:1.5rem; padding-top:1.25rem; border-top:1px solid var(--border);
        }
        .footer-link {
            font-size:0.76rem; font-weight:600; color:var(--text-muted);
            text-decoration:none; display:flex; align-items:center; gap:5px;
            transition:color 0.2s;
        }
        .footer-link:hover { color:var(--accent); }
        .footer-link i { font-size:11px; }

        /* ── RESPONSIVE ── */
        @media (max-width:480px) {
            .card { padding:2rem 1.4rem; border-radius:20px; }
            nav  { padding:0 1rem; }
            .countdown-num { font-size:1.4rem; }
            .countdown-block { padding:12px 6px; }
        }
    </style>
</head>
<body>

<div class="bg-grid"></div>
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>
<div class="orb orb-3"></div>

<!-- ════════════ NAVBAR ════════════ -->
<nav>
    <a href="#" class="nav-logo">
        <div class="logo-icon-wrap">
            <div class="icon-bg"><i class="fa-solid fa-bus"></i></div>
            <div class="icon-pin"><i class="fa-solid fa-location-dot"></i></div>
        </div>
        <span class="logo-name">DIU <span>Routes</span></span>
    </a>
    <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
        <i class="fa-solid fa-sun t-sun"></i>
        <i class="fa-solid fa-moon t-moon"></i>
    </button>
</nav>

<!-- ════════════ MAIN ════════════ -->
<main>
    <div class="card">

        <!-- Animated Gear -->
        <div class="icon-wrap">
            <div class="ring"></div>
            <div class="ring-2"></div>
            <div class="icon-core">
                <i class="fa-solid fa-gear"></i>
            </div>
        </div>

        <!-- Title -->
        <h1 class="card-title">
            Under <span class="highlight">Maintenance</span>
        </h1>
        <p class="card-sub">
            We're upgrading <strong style="color:var(--text-primary);">DIU Routes</strong> to bring you a better real-time tracking experience. We'll be back online very soon.
        </p>

        <!-- Warning Banner -->
        <div class="warn-banner">
            <div class="warn-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="warn-text">
                <strong>Scheduled Maintenance:</strong> Sunday, March 09 · 2:00 AM – 6:00 AM (BDT). Live bus tracking and notifications are temporarily unavailable.
            </div>
        </div>

        <!-- Progress -->
        <div class="progress-wrap">
            <div class="progress-label">
                <span>Restoration Progress</span>
                <span class="pct" id="progress-pct">72%</span>
            </div>
            <div class="progress-track">
                <div class="progress-fill" id="progress-fill" style="width:72%;"></div>
            </div>
        </div>

        <!-- Countdown -->
        <div class="countdown-row">
            <div class="countdown-block">
                <div class="countdown-num" id="cd-h">03</div>
                <div class="countdown-label">Hours</div>
            </div>
            <div class="countdown-sep">:</div>
            <div class="countdown-block">
                <div class="countdown-num" id="cd-m">45</div>
                <div class="countdown-label">Minutes</div>
            </div>
            <div class="countdown-sep">:</div>
            <div class="countdown-block">
                <div class="countdown-num" id="cd-s">00</div>
                <div class="countdown-label">Seconds</div>
            </div>
        </div>

        <!-- System Status -->
        <div class="status-row">
            <div class="status-item">
                <div class="status-left">
                    <div class="status-dot ok"></div>
                    <div class="status-name">Database Server</div>
                </div>
                <span class="status-badge ok">Operational</span>
            </div>
            <div class="status-item">
                <div class="status-left">
                    <div class="status-dot warn"></div>
                    <div class="status-name">Live Location API</div>
                </div>
                <span class="status-badge warn">Updating</span>
            </div>
            <div class="status-item">
                <div class="status-left">
                    <div class="status-dot offline"></div>
                    <div class="status-name">Bus Tracking Service</div>
                </div>
                <span class="status-badge offline">Offline</span>
            </div>
            <div class="status-item">
                <div class="status-left">
                    <div class="status-dot ok"></div>
                    <div class="status-name">Authentication</div>
                </div>
                <span class="status-badge ok">Operational</span>
            </div>
        </div>

        <!-- Notify Form -->
        <div class="notify-wrap">
            <input
                type="email"
                class="notify-input"
                id="notify-email"
                placeholder="your@diu.edu.bd — notify me when back"
                autocomplete="email"
            />
            <button class="notify-btn" onclick="submitNotify()">
                <i class="fa-solid fa-paper-plane mr-1"></i> Notify
            </button>
        </div>
        <div class="success-msg" id="success-msg">
            <i class="fa-solid fa-circle-check"></i>
            Done! We'll email you when DIU Routes is back online.
        </div>

        <!-- Footer links -->
        <div class="footer-links">
            <a href="https://diu.edu.bd" target="_blank" class="footer-link">
                <i class="fa-solid fa-globe"></i> DIU Website
            </a>
            <a href="mailto:transport@diu.edu.bd" class="footer-link">
                <i class="fa-solid fa-envelope"></i> Contact Support
            </a>
            <a href="#" class="footer-link">
                <i class="fa-brands fa-facebook"></i> Facebook
            </a>
            <a href="#" class="footer-link" style="color:var(--text-muted);">
                <i class="fa-regular fa-copyright" style="font-size:10px;"></i>
                2025 DIU Routes
            </a>
        </div>

    </div>
</main>

<script>
    /* ── Theme ── */
    const html   = document.documentElement;
    const toggle = document.getElementById('themeToggle');
    const saved  = localStorage.getItem('diu-routes-theme') || 'dark';
    html.setAttribute('data-theme', saved);

    toggle.addEventListener('click', () => {
        const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', next);
        localStorage.setItem('diu-routes-theme', next);
    });

    /* ── Countdown ── */
    // Target: 3h 45m from now
    const target = new Date(Date.now() + ((3 * 60 + 45) * 60 * 1000));

    function pad(n) { return String(n).padStart(2, '0'); }

    function tick() {
        const diff = Math.max(0, target - Date.now());
        const h = Math.floor(diff / 3600000);
        const m = Math.floor((diff % 3600000) / 60000);
        const s = Math.floor((diff % 60000) / 1000);
        document.getElementById('cd-h').textContent = pad(h);
        document.getElementById('cd-m').textContent = pad(m);
        document.getElementById('cd-s').textContent = pad(s);
        if (diff === 0) clearInterval(timer);
    }
    const timer = setInterval(tick, 1000);
    tick();

    /* ── Progress (slow creep) ── */
    let pct = 72;
    setInterval(() => {
        if (pct >= 99) return;
        pct = Math.min(99, pct + (Math.random() * 0.15));
        const p = pct.toFixed(0) + '%';
        document.getElementById('progress-pct').textContent = p;
        document.getElementById('progress-fill').style.width = p;
    }, 4000);

    /* ── Notify ── */
    function submitNotify() {
        const input = document.getElementById('notify-email');
        const msg   = document.getElementById('success-msg');
        if (!input.value || !input.value.includes('@')) {
            input.style.borderColor = 'rgba(239,68,68,0.5)';
            input.style.boxShadow   = '0 0 0 3px rgba(239,68,68,0.12)';
            setTimeout(() => {
                input.style.borderColor = '';
                input.style.boxShadow   = '';
            }, 1800);
            return;
        }
        input.value = '';
        msg.classList.add('show');
        setTimeout(() => msg.classList.remove('show'), 5000);
    }

    document.getElementById('notify-email').addEventListener('keydown', e => {
        if (e.key === 'Enter') submitNotify();
    });
</script>
</body>
</html>