<!doctype html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard – DIU Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        display: ["Bricolage Grotesque", "sans-serif"],
                        body: ["Nunito", "sans-serif"],
                    },
                    colors: {
                        accent: {
                            DEFAULT: "#0ea5a8",
                            light: "#22d3d8",
                            glow: "rgba(14,165,168,0.12)",
                        },
                        surface: {
                            DEFAULT: "#0f1923",
                            card: "#162130",
                            border: "#1e3040",
                        },
                    },
                },
            },
        };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,700;12..96,800&family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        /* Minimal custom CSS — only what Tailwind can't express */
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

        body {
            font-family: "Nunito", sans-serif;
            background: var(--bg);
        }

        .font-display {
            font-family: "Bricolage Grotesque", sans-serif;
        }

        /* Sidebar transition */
        #sidebar {
            transition: transform 0.28s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--nav-bg);
            border-right-color: var(--border);
        }

        #sb-overlay {
            transition: opacity 0.25s;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        /* Chart canvas fill */
        .chart-box canvas {
            width: 100% !important;
        }

        /* Active sidebar link glow */
        .sb-active {
            background: var(--hover-bg);
            color: var(--accent) !important;
            border-left: 2.5px solid var(--accent);
        }

        /* Map iframe */
        #live-map {
            width: 100%;
            height: 280px;
            border: 0;
            display: block;
        }

        /* Pulse dot */
        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.4);
            }
        }

        .pulse {
            animation: pulse-dot 1.6s ease-in-out infinite;
        }

        /* Sub-menu */
        .sb-sub {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.28s ease;
        }

        .sb-sub.open {
            max-height: 200px;
        }

        /* Toast */
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

        /* Notification dropdown */
        .dd {
            opacity: 0;
            pointer-events: none;
            transform: translateY(6px);
            transition: all 0.2s;
        }

        .dd.open {
            opacity: 1;
            pointer-events: all;
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                z-index: 50;
                transform: translateX(-100%);
            }

            #sidebar.open {
                transform: translateX(0);
            }

            #sb-overlay.show {
                opacity: 1;
                pointer-events: all;
            }
        }

        /* ── Utility classes backed by CSS vars ── */
        .bg-card {
            background: var(--card-bg);
        }

        .bg-nav {
            background: var(--nav-bg);
        }

        .bg-footer {
            background: var(--footer-bg);
        }

        .bg-dd {
            background: var(--dd-bg);
        }

        .text-accent {
            color: var(--accent);
        }

        .text-accent2 {
            color: var(--accent2);
        }

        .text-primary {
            color: var(--txt-1);
        }

        .text-secondary {
            color: var(--txt-2);
        }

        .text-muted {
            color: var(--txt-m);
        }

        .border-theme {
            border-color: var(--border);
        }

        .accent-bg-glow {
            background: var(--glow);
        }

        .accent-icon-bg {
            background: var(--hover-bg);
        }

        .accent-badge-bg {
            background: var(--notif-unread);
        }

        /* sidebar + header + card bg using vars */
        aside#sidebar {
            background: var(--nav-bg);
        }

        header.topbar {
            background: var(--nav-bg);
            border-bottom-color: var(--border);
        }

        .card {
            background: var(--card-bg);
            border-color: var(--border);
        }

        .dd-panel {
            background: var(--dd-bg);
            border-color: var(--border);
            box-shadow: 0 8px 32px var(--dd-shadow);
        }

        footer.site-footer {
            background: var(--footer-bg);
            border-top-color: var(--border);
        }

        .divide-theme>*+* {
            border-top-color: var(--border);
        }

        .brand-icon {
            border-color: var(--border);
            color: var(--accent);
        }

        .notif-badge {
            background: var(--accent);
        }

        .live-badge {
            background: var(--notif-unread);
            border-color: var(--border);
            color: var(--accent);
        }

        .live-dot {
            background: var(--accent);
        }

        .accent-link {
            color: var(--accent);
        }

        .accent-link:hover {
            color: var(--accent2);
        }

        .view-all-btn {
            color: var(--accent);
            border-color: var(--border);
            background: var(--hover-bg);
        }

        .view-all-btn:hover {
            background: var(--glow);
        }

        .bus-id-cell {
            color: var(--accent);
        }

        .icon-accent {
            color: var(--accent);
            background: var(--hover-bg);
        }

        .icon-accent-sm {
            color: var(--accent);
            background: var(--hover-bg);
        }

        .mark-read-btn {
            color: var(--accent);
        }

        .sidebar-icon-active {
            color: var(--accent);
        }

        .sub-link:hover {
            color: var(--accent);
        }

        .brand-name-accent {
            color: var(--accent);
        }

        .error-text {
            font-size: 13px;
            color: var(--red);
            margin-top: -5px;
            margin-bottom: 10px;
        }
    </style>
    @stack('css')
</head>

<body class="text-slate-200 min-h-screen">
    <!-- Overlay -->
    <div id="sb-overlay" class="fixed inset-0 bg-black/50 z-40 opacity-0 pointer-events-none hidden md:hidden"
        onclick="closeSidebar()"></div>

    <div class="flex h-screen overflow-hidden">
        <!-- ═══════════ SIDEBAR ═══════════ -->
        @include('layouts.admin-sidebar')

        <!-- ═══════════ MAIN ═══════════ -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <header class="topbar h-16 backdrop-blur border-b flex items-center px-4 gap-4 flex-shrink-0 z-30">
                <button id="menu-btn" onclick="toggleSidebar()"
                    class="w-9 h-9 flex items-center justify-center rounded-lg text-slate-400 hover:bg-white/5 hover:text-slate-200 transition-colors md:hidden">
                    <i class="fa-solid fa-bars"></i>
                </button>

                @yield('header_title')

                <div class="flex-1"></div>

                <div class="flex items-center gap-2">
                    <!-- Notifications -->
                    <div class="relative">
                        <button onclick="toggleDd('notif-dd')"
                            class="relative w-9 h-9 flex items-center justify-center rounded-lg text-slate-400 hover:bg-white/5 hover:text-slate-200 transition-colors">
                            <i class="fa-regular fa-bell text-sm"></i>

                            @php
                                $unreadTotalNoti = Auth::user()->unReadNotifications()->count() ?? 0;
                            @endphp

                            @if ($unreadTotalNoti > 0)
                                <span id="notif-badge"
                                    class="notif-badge absolute top-1.5 right-1.5 w-4 h-4 text-white text-[9px] font-bold rounded-full flex items-center justify-center">{{ $unreadTotalNoti }}</span>
                            @endif
                        </button>
                        <div id="notif-dd"
                            class="dd-panel dd absolute right-0 top-11 w-80 rounded-2xl shadow-2xl overflow-hidden z-50">
                            <div class="flex items-center justify-between px-4 py-3 border-b border-theme">
                                <span class="font-display font-bold text-sm text-white flex items-center gap-2"><i
                                        class="fa-solid fa-bell text-accent text-xs"></i>Notifications</span>
                                <button onclick="markAllRead()"
                                    class="mark-read-btn text-[11px] font-semibold hover:underline">
                                    Mark all read
                                </button>
                            </div>
                            <div class="divide-y divide-theme">
                                <div class="flex gap-3 px-4 py-3 bg-white/[0.02] hover:bg-white/5 transition-colors">
                                    <div
                                        class="icon-accent w-8 h-8 rounded-xl text-xs flex-shrink-0 mt-0.5 flex items-center justify-center">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-200">
                                            New student registered
                                        </div>
                                        <div class="text-[11px] text-slate-500">
                                            Karim Hassan joined as Student
                                        </div>
                                        <div class="text-[10px] text-slate-600 mt-0.5">
                                            2 min ago
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-3 px-4 py-3 bg-white/[0.02] hover:bg-white/5 transition-colors">
                                    <div
                                        class="w-8 h-8 rounded-xl bg-orange-500/15 flex items-center justify-center text-orange-400 text-xs flex-shrink-0 mt-0.5">
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-200">
                                            Route 07 delayed
                                        </div>
                                        <div class="text-[11px] text-slate-500">
                                            Driver reported 20 min delay
                                        </div>
                                        <div class="text-[10px] text-slate-600 mt-0.5">
                                            15 min ago
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-3 px-4 py-3 bg-white/[0.02] hover:bg-white/5 transition-colors">
                                    <div
                                        class="icon-accent w-8 h-8 rounded-xl text-xs flex-shrink-0 mt-0.5 flex items-center justify-center">
                                        <i class="fa-solid fa-bus"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-200">
                                            Bus B maintenance due
                                        </div>
                                        <div class="text-[11px] text-slate-500">
                                            Vehicle scheduled for service
                                        </div>
                                        <div class="text-[10px] text-slate-600 mt-0.5">
                                            1 hr ago
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-3 px-4 py-3 hover:bg-white/5 transition-colors">
                                    <div
                                        class="w-8 h-8 rounded-xl bg-blue-500/15 flex items-center justify-center text-blue-400 text-xs flex-shrink-0 mt-0.5">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-200">
                                            System update available
                                        </div>
                                        <div class="text-[11px] text-slate-500">
                                            Admin panel v2.1 ready
                                        </div>
                                        <div class="text-[10px] text-slate-600 mt-0.5">
                                            3 hrs ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-2.5 border-t border-theme text-center">
                                <a href="#" class="accent-link text-xs font-semibold hover:underline">View
                                    all</a>
                            </div>
                        </div>
                    </div>

                    <!-- User -->
                    <div class="relative">
                        <button onclick="toggleDd('user-dd')"
                            class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white/5 border border-theme hover:bg-white/10 transition-colors">
                            <div class="icon-accent w-7 h-7 rounded-lg text-xs flex items-center justify-center">
                                @if (Auth::user()->photo == null)
                                    <i class="fa-solid fa-user-shield"></i>
                                @else
                                    <img src="{{ Auth::user()->photo }}" alt="User Photo"
                                        style="width:100%;height:100%;border-radius:20px;object-fit:cover;">
                                @endif

                            </div>
                            <div class="hidden sm:block">
                                <div class="text-xs font-bold text-slate-200 leading-tight">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="text-[10px] text-slate-500 leading-tight">
                                    {{ Str::ucfirst(Auth::user()->role) }}
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-down text-[9px] text-slate-500 hidden sm:block"></i>
                        </button>
                        <div id="user-dd"
                            class="dd-panel dd absolute right-0 top-11 w-52 rounded-2xl shadow-2xl overflow-hidden z-50">
                            <div class="flex items-center gap-3 px-4 py-3 border-b border-theme">
                                <div class="icon-accent w-9 h-9 rounded-xl flex items-center justify-center">
                                    @if (Auth::user()->photo == null)
                                        <i class="fa-solid fa-user-shield"></i>
                                    @else
                                        <img src="{{ Auth::user()->photo }}" alt="User Photo"
                                            style="max-width:50px;max-height:50px;">
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-slate-200">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="text-[11px] text-slate-500">
                                        {{ Auth::user()->email }}
                                    </div>
                                </div>
                            </div>
                            <div class="py-1.5 px-1.5">
                                <a href="{{ route('admin.profile') }}"
                                    class="flex items-center gap-2.5 px-3 py-2 text-xs text-slate-400 hover:text-slate-200 hover:bg-white/5 rounded-lg transition-colors"><i
                                        class="fa-regular fa-user w-3"></i>Profile</a>
                                <a href="{{ route('admin.settings') }}"
                                    class="flex items-center gap-2.5 px-3 py-2 text-xs text-slate-400 hover:text-slate-200 hover:bg-white/5 rounded-lg transition-colors"><i
                                        class="fa-solid fa-gear w-3"></i>Settings</a>
                                <div class="my-1 border-t border-theme"></div>
                                <a href="{{ route('admin.logout') }}"
                                    class="flex items-center gap-2.5 px-3 py-2 text-xs text-red-400 hover:bg-red-500/10 rounded-lg transition-colors"><i
                                        class="fa-solid fa-right-from-bracket w-3"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            @yield('content', 'No Content Available')

            <!-- Footer -->
            <footer
                class="site-footer border-t px-5 py-3 flex items-center justify-between text-[11px] text-slate-600 flex-shrink-0">
                <span>© 2025 DIU Routes · Dhaka International University</span>
                <span class="flex items-center gap-1.5"><span
                        class="w-1.5 h-1.5 rounded-full bg-emerald-400 pulse inline-block"></span>Admin Panel · All
                    systems live</span>
            </footer>
        </div>
    </div>

    <!-- Toast -->
    {{-- <div id="toast"
        class="fixed bottom-5 left-1/2 -translate-x-1/2 flex items-center gap-2.5 bg-[#162130] border border-[#1e3040] text-slate-200 text-xs font-semibold px-4 py-2.5 rounded-xl shadow-2xl z-50">
        <i class="fa-solid fa-circle-check text-emerald-400"></i><span>Login Success.</span>
    </div> --}}

    @include('errors.toast')

    <script>
        // Sidebar toggle
        function toggleSidebar() {
            const sb = document.getElementById("sidebar");
            const ov = document.getElementById("sb-overlay");
            sb.classList.toggle("open");
            ov.classList.toggle("show");
            ov.classList.toggle("hidden");
        }

        function closeSidebar() {
            document.getElementById("sidebar").classList.remove("open");
            const ov = document.getElementById("sb-overlay");
            ov.classList.remove("show");
            ov.classList.add("hidden");
        }

        // Submenu toggle
        function toggleSub(id, btn) {
            const sub = document.getElementById(id);
            const ch = btn.querySelector(".chevron");
            sub.classList.toggle("open");
            ch && ch.classList.toggle("rotate-180");
        }

        // Dropdown toggle
        function toggleDd(id) {
            document.querySelectorAll(".dd").forEach((d) => {
                if (d.id !== id) d.classList.remove("open");
            });
            document.getElementById(id).classList.toggle("open");
        }
        document.addEventListener("click", (e) => {
            if (
                !e.target.closest('[onclick*="toggleDd"]') &&
                !e.target.closest(".dd")
            )
                document
                .querySelectorAll(".dd")
                .forEach((d) => d.classList.remove("open"));
        });

        function showToast() {
            var t = document.getElementById("toast");
            t.classList.add("show");
            setTimeout(function() {
                t.classList.remove("show");
            }, 3000);
        }

        // Charts — read accent color from CSS var at runtime
        const accentHex = getComputedStyle(document.documentElement).getPropertyValue('--accent').trim();
        const txtC = getComputedStyle(document.documentElement).getPropertyValue('--txt-m').trim();
        const gridC = "rgba(255,255,255,0.05)";

        new Chart(document.getElementById("growthChart"), {
            type: "line",
            data: {
                labels: ["Oct", "Nov", "Dec", "Jan", "Feb", "Mar"],
                datasets: [{
                        label: "Students",
                        data: [820, 920, 1020, 1100, 1210, 1284],
                        borderColor: accentHex,
                        backgroundColor: "rgba(14,165,168,0.08)",
                        fill: true,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: accentHex,
                    },
                    {
                        label: "Drivers",
                        data: [38, 40, 42, 44, 46, 48],
                        borderColor: "#f97316",
                        backgroundColor: "rgba(249,115,22,0.07)",
                        fill: true,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: "#f97316",
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            color: txtC,
                            font: {
                                family: "Nunito",
                                size: 11
                            },
                            boxWidth: 10,
                            padding: 12,
                        },
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            color: txtC,
                            font: {
                                family: "Nunito",
                                size: 10
                            },
                            maxRotation: 0,
                        },
                        grid: {
                            color: gridC
                        },
                    },
                    y: {
                        ticks: {
                            color: txtC,
                            font: {
                                family: "Nunito",
                                size: 10
                            }
                        },
                        grid: {
                            color: gridC
                        },
                    },
                },
            },
        });

        new Chart(document.getElementById("tripsChart"), {
            type: "bar",
            data: {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                datasets: [{
                    label: "Trips",
                    data: [42, 58, 51, 67, 72, 38, 20],
                    backgroundColor: accentHex + "cc",
                    borderRadius: 6,
                    borderSkipped: false,
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: txtC,
                            font: {
                                family: "Nunito",
                                size: 11
                            },
                            boxWidth: 10,
                        },
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            color: txtC,
                            font: {
                                family: "Nunito",
                                size: 10
                            },
                            maxRotation: 0,
                        },
                        grid: {
                            color: gridC
                        },
                    },
                    y: {
                        ticks: {
                            color: txtC,
                            font: {
                                family: "Nunito",
                                size: 10
                            }
                        },
                        grid: {
                            color: gridC
                        },
                    },
                },
            },
        });
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
