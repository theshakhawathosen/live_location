@extends('layouts.student-layout')
@section('title', 'Profile Edit')
@section('content')
    <main id="main">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-breadcrumb">
                <a href="{{ route('student.dashboard') }}"><i class="fa-solid fa-house"></i> Home</a>
                <i class="fa-solid fa-chevron-right"></i>
                <span>My Profile</span>
            </div>
            <h1 class="page-title">My Profile</h1>
            <p class="page-sub">View and update your personal information.</p>
        </div>
        <form action="{{ route('student.updateprofile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Profile card -->
            <div class="profile-card">
                <!-- Avatar row -->
                <div class="avatar-section">
                    <div class="big-avatar" onclick="document.getElementById('avatar-input').click()"
                        title="Click to change photo">
                        @if (Auth::user()->photo == null)
                            <i class="fa-solid fa-user"></i>
                        @else
                            <img src="{{ Auth::user()->photo }}" alt="User Photo"
                                style="width:100%;height:100%;border-radius:20px;object-fit:cover;">
                        @endif
                        <div class="avatar-edit-overlay">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                    </div>
                    <input type="file" id="avatar-input" name="photo" accept="image/*" style="display: none"
                        onchange="previewAvatar(event)" />
                    <div>
                        <div class="avatar-meta-name">{{ Auth::user()->name }}</div>
                        <div class="avatar-meta-role" style="margin-bottom: 10px">
                            <i class="fa-solid fa-user-graduate" style="font-size: 11px"></i>
                            {{ Str::ucfirst(Auth::user()->role) }}
                        </div>
                        {{-- <div class="avatar-meta-id">
                        <i class="fa-solid fa-id-badge"
                            style="color: var(--accent); font-size: 11px; margin-right: 4px"></i>DIU-2021-CSE-047
                    </div> --}}
                        @error('photo')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form -->
                <div class="form-section">
                    <div class="form-section-title">Personal Information</div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="input-name">
                                <i class="fa-solid fa-user"></i> Full Name
                            </label>
                            <input class="form-input" type="text" name="name" id="input-name"
                                value="{{ old('name', auth()->user()->name) }}" placeholder="Your full name" />
                        </div>
                        @error('name')
                            <p class="error-text">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label class="form-label" for="input-email">
                                <i class="fa-solid fa-envelope"></i> Email Address
                            </label>
                            <input class="form-input" type="email" id="input-email" value="{{ Auth::user()->email }}"
                                readonly />
                            <span class="form-hint"><i class="fa-solid fa-lock"
                                    style="font-size: 10px; margin-right: 3px"></i>Email is managed by your Google account
                                and
                                cannot be changed
                                here.</span>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="input-phone">
                                <i class="fa-solid fa-phone"></i> Phone Number
                            </label>
                            <input class="form-input" type="number" id="input-phone" name="phone"
                                value="{{ old('phone', auth()->user()->phone) }}" placeholder="+880 1X XX XXX XXX" />
                        </div>
                        @error('phone')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Save row -->
                    <div class="save-row">
                        <a href="{{ route('student.dashboard') }}" class="btn-cancel" style="text-decoration: none">
                            <i class="fa-solid fa-xmark"></i> Cancel
                        </a>
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-floppy-disk"></i> Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </main>

@endsection


@push('js')
    <script>
        
        /* Avatar preview */
        function previewAvatar(e) {
            var file = e.target.files[0];
            if (!file) return;
            var reader = new FileReader();
            reader.onload = function(ev) {
                var el = document.querySelector(".big-avatar");
                el.innerHTML =
                    '<img src="' +
                    ev.target.result +
                    '" style="width:100%;height:100%;border-radius:18px;object-fit:cover;" alt="Avatar"/><div class="avatar-edit-overlay"><i class="fa-solid fa-camera"></i></div>';
                el.onclick = function() {
                    document.getElementById("avatar-input").click();
                };
            };
            reader.readAsDataURL(file);
        }

        /* Toast */
        function showToast() {
            var t = document.getElementById("toast");
            t.classList.add("show");
            setTimeout(function() {
                t.classList.remove("show");
            }, 3000);
        }
    </script>
@endpush


@push('css')
    <style>
        :root {
            --bg: #eef2f7;
            --nav-bg: rgba(255, 255, 255, 0.93);
            --nav-bdr: rgba(14, 165, 168, 0.15);
            --card: #ffffff;
            --input-bg: #f4f7fb;
            --txt-1: #0c1a2b;
            --txt-2: #3d5166;
            --txt-m: #7a8fa8;
            --bdr: rgba(14, 165, 168, 0.16);
            --accent: #0ea5a8;
            --accent2: #06b6d4;
            --glow: rgba(14, 165, 168, 0.18);
            --hover: rgba(14, 165, 168, 0.07);
            --dd-bg: #ffffff;
            --dd-shd: rgba(12, 26, 43, 0.13);
            --footer-bg: #e3eaf3;
            --red: #ef4444;
            --success: #22c55e;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #060f1a;
                --nav-bg: rgba(8, 24, 40, 0.94);
                --nav-bdr: rgba(34, 211, 216, 0.13);
                --card: #0c1f30;
                --input-bg: #091826;
                --txt-1: #dff0f5;
                --txt-2: #7aafc4;
                --txt-m: #3d6a82;
                --bdr: rgba(34, 211, 216, 0.13);
                --accent: #22d3d8;
                --accent2: #38bdf8;
                --glow: rgba(34, 211, 216, 0.15);
                --hover: rgba(34, 211, 216, 0.07);
                --dd-bg: #0d2235;
                --dd-shd: rgba(0, 0, 0, 0.4);
                --footer-bg: #091826;
                --red: #f87171;
                --success: #4ade80;
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
            font-family: "Nunito", sans-serif;
            background: var(--bg);
            color: var(--txt-1);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition:
                background 0.3s,
                color 0.3s;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: "Bricolage Grotesque", sans-serif;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 99px;
        }

        /* ── Navbar ── */
        #navbar {
            position: sticky;
            top: 0;
            z-index: 200;
            height: 62px;
            background: var(--nav-bg);
            border-bottom: 1px solid var(--nav-bdr);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 12px;
            box-shadow: 0 2px 18px rgba(0, 0, 0, 0.07);
            flex-shrink: 0;
        }

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
            font-family: "Bricolage Grotesque", sans-serif;
            font-weight: 800;
            font-size: 18px;
            color: var(--txt-1);
            line-height: 1;
        }

        .logo-text span {
            color: var(--accent);
        }

        .nav-spacer {
            flex: 1;
        }

        .nav-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .nav-icon-btn {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 11px;
            border: 1px solid var(--bdr);
            background: var(--card);
            color: var(--txt-2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            cursor: pointer;
            transition:
                background 0.18s,
                color 0.18s,
                border-color 0.18s,
                transform 0.15s;
            text-decoration: none;
        }

        .nav-icon-btn:hover {
            background: var(--hover);
            color: var(--accent);
            border-color: var(--accent);
            transform: scale(1.05);
        }

        .nav-icon-btn.active {
            background: var(--hover);
            color: var(--accent);
            border-color: var(--accent);
        }

        @keyframes pd {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(34, 211, 216, 0.5);
            }

            50% {
                box-shadow: 0 0 0 6px rgba(34, 211, 216, 0);
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
        }

        .user-btn {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 5px 10px 5px 5px;
            border-radius: 12px;
            border: 1px solid var(--bdr);
            background: var(--card);
            cursor: pointer;
            transition:
                background 0.18s,
                border-color 0.18s;
            flex-shrink: 0;
            position: relative;
        }

        .user-btn:hover,
        .user-btn.active {
            background: var(--hover);
            border-color: var(--accent);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--glow);
            border: 2px solid var(--accent);
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
            transition: transform 0.2s;
        }

        .user-btn.active .user-chevron {
            transform: rotate(180deg);
        }

        /* Dropdown */
        .dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            min-width: 220px;
            background: var(--dd-bg);
            border: 1px solid var(--bdr);
            border-radius: 18px;
            box-shadow:
                0 20px 60px var(--dd-shd),
                0 0 0 1px var(--bdr);
            z-index: 999;
            overflow: hidden;
            transform-origin: top right;
            transform: scale(0.92) translateY(-8px);
            opacity: 0;
            pointer-events: none;
            transition:
                opacity 0.2s,
                transform 0.2s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .dropdown.open {
            opacity: 1;
            transform: scale(1) translateY(0);
            pointer-events: auto;
        }

        .user-dd-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 18px 14px;
            border-bottom: 1px solid var(--bdr);
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
            transition:
                background 0.15s,
                color 0.15s;
        }

        .dd-item:hover {
            background: var(--hover);
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
            background: rgba(239, 68, 68, 0.07);
        }

        .dd-item.active-page {
            color: var(--accent);
            background: var(--hover);
        }

        .dd-item.active-page i {
            color: var(--accent);
        }

        .dd-hr {
            height: 1px;
            background: var(--bdr);
            margin: 4px 0;
        }

        .notif-dropdown {
            min-width: 300px;
        }

        .dd-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 18px 11px;
            border-bottom: 1px solid var(--bdr);
        }

        .dd-header-title {
            font-family: "Bricolage Grotesque", sans-serif;
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
        }

        .notif-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 13px 18px;
            border-bottom: 1px solid var(--bdr);
            cursor: pointer;
            transition: background 0.15s;
            position: relative;
        }

        .notif-item:last-child {
            border-bottom: none;
        }

        .notif-item:hover {
            background: var(--hover);
        }

        .notif-item.unread {
            background: rgba(34, 211, 216, 0.05);
        }

        .notif-item.unread::before {
            content: "";
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
            width: 34px;
            height: 34px;
            border-radius: 9px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .notif-icon.bus {
            background: var(--glow);
            color: var(--accent);
        }

        .notif-icon.warn {
            background: rgba(251, 146, 60, 0.12);
            color: #fb923c;
        }

        .notif-icon.info {
            background: rgba(56, 189, 248, 0.1);
            color: var(--accent2);
        }

        .notif-body-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--txt-1);
            margin-bottom: 2px;
        }

        .notif-body-sub {
            font-size: 12px;
            color: var(--txt-2);
            line-height: 1.5;
        }

        .notif-time {
            font-size: 11px;
            color: var(--txt-m);
            margin-top: 3px;
        }

        .notif-footer {
            padding: 10px 18px;
            text-align: center;
            border-top: 1px solid var(--bdr);
        }

        .notif-footer a {
            font-size: 13px;
            font-weight: 700;
            color: var(--accent);
            text-decoration: none;
        }

        @media (max-width: 520px) {

            .user-info,
            .user-chevron {
                display: none;
            }

            .user-btn {
                padding: 4px;
                border-radius: 10px;
            }
        }

        /* ── Main ── */
        #main {
            flex: 1;
            padding: 32px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .page-header {
            width: 100%;
            max-width: 640px;
            margin-bottom: 28px;
        }

        .page-breadcrumb {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            color: var(--txt-m);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .page-breadcrumb a {
            color: var(--txt-m);
            text-decoration: none;
            transition: color 0.2s;
        }

        .page-breadcrumb a:hover {
            color: var(--accent);
        }

        .page-breadcrumb i {
            font-size: 10px;
        }

        .page-title {
            font-size: 1.9rem;
            font-weight: 800;
            color: var(--txt-1);
            line-height: 1.2;
        }

        .page-sub {
            font-size: 14px;
            color: var(--txt-2);
            margin-top: 5px;
        }

        /* ── Profile card ── */
        .profile-card {
            width: 100%;
            max-width: 640px;
            background: var(--card);
            border: 1px solid var(--bdr);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.07);
        }

        /* Avatar section */
        .avatar-section {
            padding: 32px 32px 28px;
            display: flex;
            align-items: center;
            gap: 24px;
            border-bottom: 1px solid var(--bdr);
        }

        .big-avatar {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: var(--glow);
            border: 2.5px solid var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 32px;
            flex-shrink: 0;
            position: relative;
            cursor: pointer;
            transition: filter 0.2s;
        }

        .big-avatar:hover {
            filter: brightness(1.1);
        }

        .avatar-edit-overlay {
            position: absolute;
            inset: 0;
            border-radius: 18px;
            background: rgba(0, 0, 0, 0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .big-avatar:hover .avatar-edit-overlay {
            opacity: 1;
        }

        .avatar-edit-overlay i {
            color: #fff;
            font-size: 16px;
        }

        .avatar-meta-name {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--txt-1);
        }

        .avatar-meta-role {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 5px;
            padding: 4px 12px;
            border-radius: 99px;
            background: var(--glow);
            border: 1px solid var(--bdr);
            color: var(--accent);
            font-size: 12px;
            font-weight: 700;
        }

        .avatar-meta-id {
            font-size: 12.5px;
            color: var(--txt-m);
            margin-top: 6px;
        }

        /* Form section */
        .form-section {
            padding: 28px 32px 32px;
        }

        .form-section-title {
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--accent);
            margin-bottom: 20px;
        }

        .form-grid {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--txt-2);
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .form-label i {
            color: var(--accent);
            font-size: 12px;
            width: 14px;
            text-align: center;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 12px;
            border: 1.5px solid var(--bdr);
            background: var(--input-bg);
            color: var(--txt-1);
            font-family: "Nunito", sans-serif;
            font-size: 15px;
            font-weight: 600;
            outline: none;
            transition:
                border-color 0.2s,
                box-shadow 0.2s;
        }

        .form-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--glow);
        }

        .form-input[readonly] {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .form-hint {
            font-size: 12px;
            color: var(--txt-m);
            margin-top: 2px;
        }

        /* Save button */
        .save-row {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 26px;
            padding-top: 22px;
            border-top: 1px solid var(--bdr);
        }

        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 12px 26px;
            border-radius: 12px;
            background: var(--accent);
            color: #fff;
            font-family: "Bricolage Grotesque", sans-serif;
            font-weight: 700;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition:
                filter 0.2s,
                transform 0.2s,
                box-shadow 0.2s;
            box-shadow: 0 4px 18px var(--glow);
        }

        .btn-save:hover {
            filter: brightness(1.1);
            transform: translateY(-2px);
            box-shadow: 0 8px 28px var(--glow);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 12px 22px;
            border-radius: 12px;
            background: transparent;
            color: var(--txt-2);
            font-family: "Bricolage Grotesque", sans-serif;
            font-weight: 700;
            font-size: 15px;
            border: 1.5px solid var(--bdr);
            cursor: pointer;
            transition:
                background 0.2s,
                border-color 0.2s;
        }

        .btn-cancel:hover {
            background: var(--hover);
            border-color: var(--accent);
            color: var(--txt-1);
        }

        /* Toast */
        #toast {
            position: fixed;
            bottom: 26px;
            right: 26px;
            z-index: 999;
            background: var(--card);
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
            transform: translateX(130%);
            transition: transform 0.4s cubic-bezier(0.17, 0.67, 0.27, 1.3);
        }

        #toast.show {
            transform: translateX(0);
        }

        /* ── Footer ── */
        #footer {
            flex-shrink: 0;
            height: 44px;
            background: var(--footer-bg);
            border-top: 1px solid var(--bdr);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            font-size: 12.5px;
            color: var(--txt-m);
            font-weight: 600;
            gap: 12px;
        }

        #footer a {
            color: var(--txt-m);
            text-decoration: none;
            transition: color 0.2s;
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
            color: var(--bdr);
            margin: 0 2px;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
            animation: statusPulse 2.4s infinite;
            display: inline-block;
            margin-right: 5px;
        }

        @keyframes statusPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
            }

            50% {
                box-shadow: 0 0 0 6px rgba(34, 197, 94, 0);
            }
        }

        @media (max-width: 600px) {
            .footer-links {
                display: none;
            }

            .avatar-section {
                flex-direction: column;
                text-align: center;
            }

            .form-section {
                padding: 22px 20px 26px;
            }

            .avatar-section {
                padding: 24px 20px 22px;
            }

            .save-row {
                flex-direction: column;
            }

            .btn-save,
            .btn-cancel {
                justify-content: center;
            }
        }

        .error-text {
            font-size: 13px;
            color: var(--red);
            margin-top: -5px;
            margin-bottom: 10px;
        }
    </style>
@endpush
