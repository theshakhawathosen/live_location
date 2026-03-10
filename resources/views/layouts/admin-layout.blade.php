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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
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
                    <!-- Refresh -->
                    <div class="relative">
                        <button onclick="refreshApp(this,'{{ route('admin.system.refresh') }}')"
                            class="relative w-9 h-9 flex items-center justify-center rounded-lg text-slate-400 hover:bg-white/5 hover:text-slate-200 transition-colors">
                            <i class="fa fa-refresh text-sm"></i>
                        </button>
                    </div>

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

    {{-- Ajax Toast --}}
    <div id="ajax-success-toast">
        <i class="fa-solid fa-circle-check" style="color: var(--success); font-size: 16px"></i>
        <p id="text"></p>
    </div>

    @include('errors.toast')


    <script src="{{ asset('assets/admin/js/admin.js') }}"></script>
    <script src="{{ asset('assets/admin/js/ajax.js') }}"></script>
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
