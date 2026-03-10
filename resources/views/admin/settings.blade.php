@extends('layouts.admin-layout')
@section('title', 'Admin Profile')
@section('header_title')
    <div>
        <div class="text-sm font-bold text-t1 leading-tight">
            Settings
        </div>
        <div class="text-xs text-tm">
            View and update your settings
        </div>
    </div>
@endsection

@section('content')
    <main class="flex-1 p-4 md:p-6 overflow-auto">
        <!-- Heading -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-xs text-tm mb-1.5">
                <a href="dashboard.html" class="hover:text-accent transition-colors"><i class="fa-solid fa-house"></i></a>
                <i class="fa-solid fa-chevron-right text-[9px]"></i>
                <span class="text-t2 font-semibold">Settings</span>
            </div>
            <h1 class="text-xl font-extrabold text-t1">Platform Settings</h1>
            <p class="text-sm text-tm">
                Configure system-wide preferences for DIU Routes
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- ── General ── -->
            <div class="bg-[#161b27]  rounded-2xl border border-[#232b3e] overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-[#232b3e]">
                    <div
                        class="w-9 h-9 rounded-xl bg-[rgba(99,102,241,0.12)] flex items-center justify-center text-accent text-sm flex-shrink-0">
                        <i class="fa-solid fa-sliders"></i>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold text-t1">General</div>
                        <div class="text-[11px] text-tm">Core platform behaviour</div>
                    </div>
                </div>
                <div class="divide-y divide-[#232b3e]">
                    <!-- row -->
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Maintenance Mode
                                </div>
                                <div class="text-[11px] text-tm">
                                    Take the platform offline for maintenance
                                </div>
                            </div>
                        </div>
                        @php
                            $on_color =
                                'text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1';

                            $off_color =
                                'text-[10px] font-bold px-2 py-0.5 rounded-md bg-[#232b3e] text-tm flex items-center gap-1';
                        @endphp
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-maint" class="{{ $setting->maintenance ? $on_color : $off_color }}">
                                <i class="fa-solid fa-circle text-[5px]"></i>
                                {{ $setting->maintenance ? 'ON' : 'OFF' }}</span>
                            <label class="relative inline-flex cursor-pointer">
                                <input type="checkbox" class="toggle-input" {{ $setting->maintenance ? 'checked' : '' }}
                                    data-url="{{ route('admin.system.maintenance') }}"
                                    onchange="maintenanceToggle(this,'tag-maint')" id="sw-maint" />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Allow New Registrations
                                </div>
                                <div class="text-[11px] text-tm">
                                    Let new users sign up via Google
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-reg" class="{{ $setting->allow_registration ? $on_color : $off_color }}"><i
                                    class="fa-solid fa-circle text-[5px]"></i>
                                {{ $setting->allow_registration ? 'ON' : 'OFF' }}</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox" class="toggle-input"
                                    id="sw-reg" data-url="{{ route('admin.system.allow-registration') }}"
                                    onchange="allowRegistration(this,'tag-reg')"
                                    {{ $setting->allow_registration ? 'checked' : '' }} />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Force Email Verification
                                </div>
                                <div class="text-[11px] text-tm">
                                    Require users to verify @diu.edu.bd email
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-email-ver"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> On</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox" class="toggle-input"
                                    id="sw-email-ver" checked
                                    onchange="
                          ht('sw-email-ver', 'tag-email-ver', 'On', 'Off')
                        " />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-moon"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Auto Dark Mode for Users
                                </div>
                                <div class="text-[11px] text-tm">
                                    Follow system theme for all users
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-dark"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> On</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox" class="toggle-input"
                                    id="sw-dark" checked onchange="ht('sw-dark', 'tag-dark', 'On', 'Off')" />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── Tracking & Map ── -->
            <div class="bg-[#161b27]  rounded-2xl border border-[#232b3e] overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-[#232b3e]">
                    <div
                        class="w-9 h-9 rounded-xl bg-[rgba(99,102,241,0.12)] flex items-center justify-center text-accent text-sm flex-shrink-0">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold text-t1">
                            Tracking & Map
                        </div>
                        <div class="text-[11px] text-tm">
                            GPS and live map settings
                        </div>
                    </div>
                </div>
                <div class="divide-y divide-[#232b3e]">
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-satellite-dish"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Live GPS Tracking
                                </div>
                                <div class="text-[11px] text-tm">
                                    Enable real-time driver location updates
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-gps"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> On</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox"
                                    class="toggle-input" id="sw-gps" checked
                                    onchange="ht('sw-gps', 'tag-gps', 'On', 'Off')" />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Student Location Visible to Drivers
                                </div>
                                <div class="text-[11px] text-tm">
                                    Allow drivers to see student pick-up pins
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-stu-loc"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> On</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox"
                                    class="toggle-input" id="sw-stu-loc" checked
                                    onchange="
                          ht('sw-stu-loc', 'tag-stu-loc', 'On', 'Off')
                        " />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-route"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Auto Route Assignment
                                </div>
                                <div class="text-[11px] text-tm">
                                    Automatically assign nearest route to drivers
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-auto-route"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-[#232b3e] text-tm flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> Off</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox"
                                    class="toggle-input" id="sw-auto-route"
                                    onchange="
                          ht('sw-auto-route', 'tag-auto-route', 'On', 'Off')
                        " />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-map"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Show Route Paths on Map
                                </div>
                                <div class="text-[11px] text-tm">
                                    Display polyline routes on student map view
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-paths"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> On</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox"
                                    class="toggle-input" id="sw-paths" checked
                                    onchange="ht('sw-paths', 'tag-paths', 'On', 'Off')" />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── Notifications ── -->
            <div class="bg-[#161b27]  rounded-2xl border border-[#232b3e] overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-[#232b3e]">
                    <div
                        class="w-9 h-9 rounded-xl bg-[rgba(99,102,241,0.12)] flex items-center justify-center text-accent text-sm flex-shrink-0">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold text-t1">
                            Notifications
                        </div>
                        <div class="text-[11px] text-tm">
                            System alerts and push settings
                        </div>
                    </div>
                </div>
                <div class="divide-y divide-[#232b3e]">
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-bell"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Push Notifications
                                </div>
                                <div class="text-[11px] text-tm">
                                    Send bus arrival alerts to students
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-push"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> On</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox"
                                    class="toggle-input" id="sw-push" checked
                                    onchange="ht('sw-push', 'tag-push', 'On', 'Off')" />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">Delay Alerts</div>
                                <div class="text-[11px] text-tm">
                                    Notify students when a route is delayed
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-delay"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> On</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox"
                                    class="toggle-input" id="sw-delay" checked
                                    onchange="ht('sw-delay', 'tag-delay', 'On', 'Off')" />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Email Reports to Admin
                                </div>
                                <div class="text-[11px] text-tm">
                                    Send daily activity summary via email
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-email-rep"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-[#232b3e] text-tm flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> Off</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox"
                                    class="toggle-input" id="sw-email-rep"
                                    onchange="
                          ht('sw-email-rep', 'tag-email-rep', 'On', 'Off')
                        " />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-user-shield"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Admin Login Alerts
                                </div>
                                <div class="text-[11px] text-tm">
                                    Notify on each admin panel login
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-admin-alert"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> On</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox"
                                    class="toggle-input" id="sw-admin-alert" checked
                                    onchange="
                          ht('sw-admin-alert', 'tag-admin-alert', 'On', 'Off')
                        " />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── Security ── -->
            <div class="bg-[#161b27]  rounded-2xl border border-[#232b3e] overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-[#232b3e]">
                    <div
                        class="w-9 h-9 rounded-xl bg-[rgba(99,102,241,0.12)] flex items-center justify-center text-accent text-sm flex-shrink-0">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold text-t1">Security</div>
                        <div class="text-[11px] text-tm">
                            Access control and audit
                        </div>
                    </div>
                </div>
                <div class="divide-y divide-[#232b3e]">
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Session Timeout
                                </div>
                                <div class="text-[11px] text-tm">
                                    Auto logout after 30 min of inactivity
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-sess"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> On</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox"
                                    class="toggle-input" id="sw-sess" checked
                                    onchange="ht('sw-sess', 'tag-sess', 'On', 'Off')" />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">Audit Logging</div>
                                <div class="text-[11px] text-tm">
                                    Log all admin actions for review
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-audit"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> On</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox"
                                    class="toggle-input" id="sw-audit" checked
                                    onchange="ht('sw-audit', 'tag-audit', 'On', 'Off')" />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-xl bg-[rgba(99,102,241,0.08)] flex items-center justify-center text-accent text-xs flex-shrink-0">
                                <i class="fa-solid fa-key"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Two-Factor Authentication
                                </div>
                                <div class="text-[11px] text-tm">
                                    Require 2FA for all admin logins
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                            <span id="tag-2fa"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-[#232b3e] text-tm flex items-center gap-1"><i
                                    class="fa-solid fa-circle text-[5px]"></i> Off</span>
                            <label class="relative inline-flex cursor-pointer"><input type="checkbox"
                                    class="toggle-input" id="sw-2fa"
                                    onchange="ht('sw-2fa', 'tag-2fa', 'On', 'Off')" />
                                <div class="toggle-track">
                                    <div class="toggle-thumb"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── System Info ── -->
            <div class="bg-[#161b27]  rounded-2xl border border-[#232b3e] p-5">
                <div class="text-xs font-extrabold text-t2 uppercase tracking-widest mb-4">
                    System Information
                </div>
                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-tm mb-1">
                            Platform Version
                        </div>
                        <div class="text-sm font-bold text-t1">DIU Routes v2.0.1</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-tm mb-1">
                            Last Updated
                        </div>
                        <div class="text-sm font-bold text-t1">March 2, 2025</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-tm mb-1">
                            Maps API
                        </div>
                        <div class="text-sm font-bold text-t1">
                            Google Maps JS API v3
                        </div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-tm mb-1">
                            Auth Provider
                        </div>
                        <div class="text-sm font-bold text-t1">
                            Firebase Google OAuth
                        </div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-tm mb-1">
                            Database
                        </div>
                        @if (env('DB_DATABASE') == 'mysql')
                            <div class="text-sm font-bold text-t1">Mysql</div>
                        @else
                            <div class="text-sm font-bold text-t1">Sqlite</div>
                        @endif
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-tm mb-1">
                            Environment
                        </div>
                        @if (env('APP_ENV') == 'production')
                            <span
                                class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-emerald-500/15 text-emerald-400 text-[11px] font-bold border border-emerald-500/20">Production</span>
                        @else
                            <span
                                class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-red-500/15 text-red-400 text-[11px] font-bold border border-red-500/20">Local</span>
                        @endif
                    </div>
                </div>
                <div class="pt-4 border-t border-[#232b3e] flex flex-wrap gap-2">
                    <button onclick="showToast('Cache cleared.', 'success')"
                        class="flex items-center gap-2 px-3 py-2 rounded-xl text-t2 hover:bg-[#232b3e] hover:text-t1 text-xs font-bold border border-[#232b3e] transition-all">
                        <i class="fa-solid fa-trash-can-arrow-up"></i> Clear Cache
                    </button>
                    <button onclick="showToast('Logs exported.', 'success')"
                        class="flex items-center gap-2 px-3 py-2 rounded-xl text-t2 hover:bg-[#232b3e] hover:text-t1 text-xs font-bold border border-[#232b3e] transition-all">
                        <i class="fa-solid fa-file-export"></i> Export Logs
                    </button>
                    <button onclick="showToast('Backup started…', 'success')"
                        class="flex items-center gap-2 px-3 py-2 rounded-xl text-t2 hover:bg-[#232b3e] hover:text-t1 text-xs font-bold border border-[#232b3e] transition-all">
                        <i class="fa-solid fa-database"></i> Backup Now
                    </button>
                </div>
            </div>

            <!-- ── Danger Zone ── -->
            <div class="bg-[#161b27]  rounded-2xl border border-red-500/30 overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-red-500/20 bg-red-500/5">
                    <div
                        class="w-9 h-9 rounded-xl bg-red-500/15 flex items-center justify-center text-red-400 text-sm flex-shrink-0">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold text-red-400">
                            Danger Zone
                        </div>
                        <div class="text-[11px] text-tm">
                            Irreversible system actions
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <p class="text-sm text-t2 leading-relaxed mb-4">
                        These actions affect the entire platform and
                        <strong class="text-red-400">cannot be undone</strong>.
                        Proceed only if you are absolutely sure.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <button
                            onclick="
                      confirmReset(
                        'Clear All User Data',
                        'This will remove all user accounts permanently.',
                      )
                    "
                            class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500/20 text-xs font-bold border border-red-500/25 hover:border-red-500/50 transition-all">
                            <i class="fa-solid fa-users-slash"></i> Clear User Data
                        </button>
                        <button
                            onclick="
                      confirmReset(
                        'Reset Platform',
                        'This will factory-reset all settings.',
                      )
                    "
                            class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500/20 text-xs font-bold border border-red-500/25 hover:border-red-500/50 transition-all">
                            <i class="fa-solid fa-rotate-left"></i> Reset Platform
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /stack -->
    </main>
@endsection

@push('js')
    <script>
        // Avatar preview
        function previewAv(e) {
            const f = e.target.files[0];
            if (!f) return;
            const r = new FileReader();
            r.onload = (ev) => {
                const w = document.getElementById("pro-av");
                w.innerHTML =
                    `<img src="${ev.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:18px;"/>`;
            };
            r.readAsDataURL(f);
        }
    </script>
@endpush
