<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DIU Routes — Live Map</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Outfit:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="{{ asset('assets/student/js/config.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/student/css/student.css') }}">

</head>

<body>

    <!-- ════════════════════════════════════════
     NAVBAR
════════════════════════════════════════ -->
    <nav id="navbar">

        <!-- Logo -->
        <a href="#" class="logo-wrap">
            <div class="logo-icon">
                <i class="fa-solid fa-route"></i>
            </div>
            <span class="logo-name">DIU <span>Routes</span></span>
        </a>

        <div class="nav-spacer"></div>

        <!-- Notification Bell -->
        <div class="relative" id="notif-wrap">
            <button class="nav-action" id="notif-btn" aria-label="Notifications" title="Notifications">
                <i class="fa-regular fa-bell"></i>
                <span class="badge" id="notif-badge"></span>
            </button>

            <div class="dropdown" id="notif-dropdown" style="min-width:272px;">
                <div class="dropdown-header">Notifications <span id="unread-count" style="color:var(--accent);">3
                        unread</span></div>

                <div class="notif-item">
                    <span class="notif-dot"></span>
                    <div>
                        <div class="notif-text">Bus <strong>R-04</strong> is now near Main Gate. Estimated 3 min
                            arrival.</div>
                        <div class="notif-time"><i class="fa-regular fa-clock" style="font-size:11px;"></i> 2 minutes
                            ago</div>
                    </div>
                </div>
                <div class="notif-item">
                    <span class="notif-dot"></span>
                    <div>
                        <div class="notif-text"><strong>Route 2</strong> schedule updated for today.</div>
                        <div class="notif-time"><i class="fa-regular fa-clock" style="font-size:11px;"></i> 15 minutes
                            ago</div>
                    </div>
                </div>
                <div class="notif-item">
                    <span class="notif-dot"></span>
                    <div>
                        <div class="notif-text">Hiace <strong>H-11</strong> capacity is full. Next one in 8 min.</div>
                        <div class="notif-time"><i class="fa-regular fa-clock" style="font-size:11px;"></i> 32 minutes
                            ago</div>
                    </div>
                </div>
                <div class="dd-divider"></div>
                <div class="notif-item">
                    <span class="notif-dot read"></span>
                    <div>
                        <div class="notif-text" style="opacity:0.6;">System maintenance scheduled for Sunday 2 AM.</div>
                        <div class="notif-time"><i class="fa-regular fa-clock" style="font-size:11px;"></i> 1 hour ago
                        </div>
                    </div>
                </div>
                <div class="dd-divider"></div>
                <a href="#" class="dd-link"
                    style="justify-content:center; color:var(--accent); font-size:0.82rem; font-weight:600;">
                    View all notifications
                </a>
            </div>
        </div>

        <!-- Theme Toggle -->
        <button class="theme-toggle" id="theme-btn" aria-label="Toggle theme" title="Toggle dark/light mode">
            <i class="fa-solid fa-sun sun-icon"></i>
            <i class="fa-solid fa-moon moon-icon"></i>
        </button>

        <!-- User Menu -->
        <div class="relative" id="user-wrap">
            @if (Auth::user()->photo)
                <div class="user-avatar" id="user-btn" title="Account"><img src="{{ Auth::user()->photo }}"
                        alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-1xl"></div>
            @else
                <div class="user-avatar" id="user-btn" title="Account">AS</div>
            @endif

            <div class="dropdown" id="user-dropdown" style="min-width:220px;">
                <div class="user-info">
                    <div>
                        <div class="user-name">{{ Auth::user()->name ?? 'User Name' }}</div>
                        <div class="user-role">{{ Str::ucfirst(Auth::user()->role) ?? 'Student' }} · DIU</div>
                    </div>
                </div>
                <div class="dd-divider"></div>
                <a href="#" class="dd-link"><i class="fa-regular fa-user"></i> My Profile</a>
                <a href="#" class="dd-link"><i class="fa-regular fa-bell"></i> Preferences</a>
                <a href="#" class="dd-link"><i class="fa-regular fa-circle-question"></i> Help & Support</a>
                <div class="dd-divider"></div>
                <a href="{{ route('student.logout') }}" class="dd-link danger">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </a>
            </div>
        </div>

    </nav>

    <!-- ════════════════════════════════════════
     MAP
════════════════════════════════════════ -->
    <div id="map-wrap">
        <div id="map"></div>
    </div>

    <!-- ════════════════════════════════════════
     PANEL TOGGLE ARROW
════════════════════════════════════════ -->
    <button id="panel-toggle" aria-label="Toggle panel" title="Map controls">
        <i class="fa-solid fa-chevron-left"></i>
    </button>



    {{-- Take Data From Blade to JS --}}
    <input type="hidden" value="{{ Auth::user()->photo }}" id="user_photo">
    <input type="hidden" value="{{ Auth::user()->email }}" id="user_email">
    <input type="hidden" value="{{ Auth::user()->id }}" id="user_id">
    <input type="hidden" value="{{ Auth::user()->name }}" id="user_name">
    <input type="hidden" value="{{ csrf_token() }}" id="csrf_token">
    <input type="hidden" value="{{ Auth::user()->lat ?? 23.8313306 }}" id="my_lat">
    <input type="hidden" value="{{ Auth::user()->lng ?? 90.4212535 }}" id="my_lng">

    <!-- ════════════════════════════════════════
     SIDE PANEL
════════════════════════════════════════ -->
    @include('student.student-sidebar')

    {{-- My Location --}}
    <div class="mylocation">
        <button onclick="getCurrentLocationView()"><i class="fa-solid fa-location-dot"></i></button>
    </div>

    <!-- Toast Container -->
    <div id="toast-container"></div>


    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('assets/student/js/default.js') }}"></script>
    <script src="{{ asset('assets/student/js/student.js') }}"></script>
    <script src="{{ asset('assets/student/js/functions.js') }}"></script>
    <script src="{{ asset('assets/student/js/element.js') }}"></script>


</body>

</html>
