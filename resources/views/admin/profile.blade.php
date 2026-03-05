@extends('layouts.admin-layout')
@section('title', 'Admin Profile')
@section('header_title')
    <div>
        <div class="text-sm font-bold text-t1 leading-tight">
            My Profile
        </div>
        <div class="text-xs text-tm">
            View and update your admin account
        </div>
    </div>
@endsection

@section('content')
    <main class="flex-1 p-4 md:p-6 overflow-auto">
        <!-- Breadcrumb + heading -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-xs text-tm mb-1.5">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-accent transition-colors"><i
                        class="fa-solid fa-house"></i></a>
                <i class="fa-solid fa-chevron-right text-[9px]"></i>
                <span class="text-t2 font-semibold">Profile</span>
            </div>
            <h1 class="text-xl font-extrabold text-t1">Admin Profile</h1>
            <p class="text-sm text-tm">
                Manage your account information and security
            </p>
        </div>

        <!-- Grid -->
        <form action="{{ route('admin.updateprofile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="grid grid-cols-1 lg:grid-cols-[260px_1fr] gap-5 max-w-5xl">
                <!-- ===== LEFT COLUMN ===== -->
                <div class="flex flex-col gap-4">
                    <!-- Avatar card -->
                    <div class="bg-[#161b27] rounded-2xl border border-[#232b3e] p-6 text-center">
                        <div class="relative w-[90px] h-[90px] mx-auto mb-4">
                            <div id="pro-av" onclick="document.getElementById('av-inp').click()"
                                class="w-[90px] h-[90px] rounded-[22px] bg-accent-glow border-2 border-accent flex items-center justify-center text-accent text-4xl cursor-pointer overflow-hidden hover:border-accent-light transition-colors">
                                @if (Auth::user()->photo == null)
                                    <i class="fa-solid fa-user-shield"></i>
                                @else
                                    <img src="{{ Auth::user()->photo }}" alt="User Photo"
                                        style="width:100%;height:100%;border-radius:20px;object-fit:cover;">
                                @endif

                            </div>
                            <div onclick="document.getElementById('av-inp').click()"
                                class="absolute -bottom-1.5 -right-1.5 w-7 h-7 rounded-lg bg-accent flex items-center justify-center text-white text-xs cursor-pointer border-2 border-[#161b27] hover:bg-accent-light transition-colors shadow">
                                <i class="fa-solid fa-camera"></i>
                            </div>
                            <input type="file" name="photo" id="av-inp" accept="image/*" class="hidden"
                                onchange="previewAv(event)" />
                        </div>
                        <div class="text-base font-extrabold text-t1">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-tm mt-0.5">{{ Auth::user()->email }}</div>
                        <div class="mt-2.5">
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-violet-500/15 text-violet-400 text-[11px] font-bold border border-violet-500/20">
                                <i class="fa-solid fa-user-shield text-[9px]"></i> {{ Str::ucfirst(Auth::user()->role) }}
                            </span>
                        </div>
                        <div class="text-[11px] text-tm mt-2">
                            Member since {{ Auth::user()->created_at->format('M Y') }}
                        </div>
                    </div>

                    <!-- Stats card -->
                    <div class="bg-[#161b27] rounded-2xl border border-[#232b3e] p-5">
                        <div class="text-xs font-extrabold text-t2 uppercase tracking-widest mb-3">
                            Account Stats
                        </div>
                        <div class="flex flex-col gap-3">
                            {{-- <div class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-xs font-semibold text-t2"><i
                                        class="fa-solid fa-users text-accent text-[10px]"></i>
                                    Users Managed</span>
                                <span class="text-sm font-extrabold text-t1">1,332</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-xs font-semibold text-t2"><i
                                        class="fa-solid fa-bus text-accent text-[10px]"></i>
                                    Vehicles</span>
                                <span class="text-sm font-extrabold text-t1">36</span>
                            </div> --}}
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-xs font-semibold text-t2"><i
                                        class="fa-solid fa-right-to-bracket text-accent text-[10px]"></i>
                                    Last Login</span>
                                @php $last = Auth::user()->last_login; @endphp

                                <span class="text-xs font-bold text-t1">
                                    @if ($last)
                                        @if ($last->isToday())
                                            Today {{ $last->format('h:i A') }}
                                        @elseif($last->isYesterday())
                                            Yesterday {{ $last->format('h:i A') }}
                                        @else
                                            {{ $last->format('d M Y h:i A') }}
                                        @endif
                                    @else
                                        Never logged in
                                    @endif
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-xs font-semibold text-t2">
                                    <i class="fa-solid fa-circle-check text-emerald-400 text-[10px]"></i>
                                    Status
                                </span>

                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold border
        {{ Auth::user()->status == 'active'
            ? 'bg-emerald-500/15 text-emerald-400 border-emerald-500/20'
            : 'bg-red-500/15 text-red-400 border-red-500/20' }}">
                                    {{ ucfirst(Auth::user()->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick actions -->
                    {{-- <div class="bg-[#161b27] rounded-2xl border border-[#232b3e] p-5">
                    <div class="text-xs font-extrabold text-t2 uppercase tracking-widest mb-3">
                        Quick Actions
                    </div>
                    <div class="flex flex-col gap-2">
                        <button onclick="showToast('Password reset email sent.', 'success')"
                            class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-t2 hover:bg-accent-glow hover:text-accent text-xs font-semibold border border-[#232b3e] hover:border-accent/30 transition-all text-left">
                            <i class="fa-solid fa-key w-4 text-center"></i> Change
                            Password
                        </button>
                        <button onclick="showToast('Logs exported.', 'success')"
                            class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-t2 hover:bg-accent-glow hover:text-accent text-xs font-semibold border border-[#232b3e] hover:border-accent/30 transition-all text-left">
                            <i class="fa-solid fa-file-export w-4 text-center"></i>
                            Export My Logs
                        </button>
                        <button
                            onclick="
                      if (confirm('Logout?'))
                        window.location.href = '../login.html';
                    "
                            class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-red-400 hover:bg-red-500/10 text-xs font-semibold border border-[#232b3e] hover:border-red-500/30 transition-all text-left">
                            <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
                            Logout
                        </button>
                    </div>
                </div> --}}
                </div>

                <!-- ===== RIGHT COLUMN ===== -->
                <div class="flex flex-col gap-4">
                    <!-- Personal info -->
                    <div class="bg-[#161b27] rounded-2xl border border-[#232b3e] p-6">
                        <div class="text-xs font-extrabold text-t2 uppercase tracking-widest mb-5">
                            Personal Information
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-t2 mb-1.5"><i
                                    class="fa-solid fa-user text-accent mr-1.5 text-[10px]"></i>First
                                Name</label>
                            <input id="f-fname" type="text" value="{{ old('name', Auth::user()->name) }}"
                                name="name"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-[#0f1117] border border-[#232b3e] text-sm text-t1 font-semibold placeholder-tm focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent/30 transition-all" />
                            @error('name')
                                <p class="error-text mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-t2 mb-1.5"><i
                                    class="fa-solid fa-envelope text-accent mr-1.5 text-[10px]"></i>Email
                                Address</label>
                            <input id="f-email" type="email" value="{{ old('email', Auth::user()->email) }}" readonly
                                name="email"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-[#232b3e]/40 border border-[#232b3e] text-sm text-tm font-semibold cursor-not-allowed focus:outline-none" />
                            <p class="text-[11px] text-tm mt-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-lock text-[9px]"></i> Email is managed
                                by Google — cannot be changed here.
                            </p>
                            @error('email')
                                <p class="error-text mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-t2 mb-1.5"><i
                                    class="fa-solid fa-phone text-accent mr-1.5 text-[10px]"></i>Phone
                                Number</label>
                            <input id="f-phone" type="number" value="{{ old('phone', Auth::user()->phone) }}"
                                name="phone"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-[#0f1117] border border-[#232b3e] text-sm text-t1 font-semibold focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent/30 transition-all" />
                            @error('phone')
                                <p class="error-text mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-[#232b3e]">
                            <a href="{{ route('admin.dashboard') }}"
                                class="px-4 py-2 rounded-xl text-xs font-bold text-t2 border border-[#232b3e] hover:bg-[#232b3e] hover:text-t1 transition-all">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-accent hover:bg-accent-light transition-all flex items-center gap-1.5 shadow-lg shadow-accent/20">
                                <i class="fa-solid fa-floppy-disk"></i> Save Changes
                            </button>
                        </div>
                    </div>

                    <!-- Security -->
                    {{-- <div class="bg-[#161b27] rounded-2xl border border-[#232b3e] p-6">
                    <div class="text-xs font-extrabold text-t2 uppercase tracking-widest mb-4">
                        Security Settings
                    </div>
                    <div class="flex flex-col divide-y divide-[#232b3e]">
                        <!-- 2FA -->
                        <div class="flex items-center justify-between py-4 first:pt-0 last:pb-0">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-accent-glow flex items-center justify-center text-accent text-sm flex-shrink-0">
                                    <i class="fa-solid fa-key"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-t1">
                                        Two-Factor Authentication
                                    </div>
                                    <div class="text-[11px] text-tm">
                                        Add an extra layer of security to your account
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2.5 flex-shrink-0 ml-4">
                                <span id="tag-2fa"
                                    class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-[#232b3e] text-tm flex items-center gap-1"><i
                                        class="fa-solid fa-circle text-[5px]"></i> Off</span>
                                <label class="relative inline-flex cursor-pointer">
                                    <input type="checkbox" class="toggle-input" id="sw-2fa"
                                        onchange="toggleTag('sw-2fa', 'tag-2fa', 'On', 'Off')" />
                                    <div class="toggle-track">
                                        <div class="toggle-thumb"></div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Login notifs -->
                        <div class="flex items-center justify-between py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-accent-glow flex items-center justify-center text-accent text-sm flex-shrink-0">
                                    <i class="fa-solid fa-bell"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-t1">
                                        Login Notifications
                                    </div>
                                    <div class="text-[11px] text-tm">
                                        Get notified on each login to this account
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2.5 flex-shrink-0 ml-4">
                                <span id="tag-login"
                                    class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1"><i
                                        class="fa-solid fa-circle text-[5px]"></i> On</span>
                                <label class="relative inline-flex cursor-pointer">
                                    <input type="checkbox" class="toggle-input" id="sw-login" checked
                                        onchange="
                            toggleTag('sw-login', 'tag-login', 'On', 'Off')
                          " />
                                    <div class="toggle-track">
                                        <div class="toggle-thumb"></div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Session timeout -->
                        <div class="flex items-center justify-between py-4 last:pb-0">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-accent-glow flex items-center justify-center text-accent text-sm flex-shrink-0">
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
                            <div class="flex items-center gap-2.5 flex-shrink-0 ml-4">
                                <span id="tag-sess"
                                    class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-accent/15 text-accent border border-accent/20 flex items-center gap-1"><i
                                        class="fa-solid fa-circle text-[5px]"></i> On</span>
                                <label class="relative inline-flex cursor-pointer">
                                    <input type="checkbox" class="toggle-input" id="sw-sess" checked
                                        onchange="
                            toggleTag('sw-sess', 'tag-sess', 'On', 'Off')
                          " />
                                    <div class="toggle-track">
                                        <div class="toggle-thumb"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div> --}}

                    <!-- Activity log -->
                    {{-- <div class="bg-[#161b27] rounded-2xl border border-[#232b3e] p-6">
                    <div class="text-xs font-extrabold text-t2 uppercase tracking-widest mb-4">
                        Recent Activity
                    </div>
                    <div class="flex flex-col gap-3.5">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-accent-glow flex items-center justify-center text-accent text-sm flex-shrink-0">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">Admin login</div>
                                <div class="text-[11px] text-tm">
                                    Today 09:14 AM · Chrome, Dhaka
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-orange-500/12 flex items-center justify-center text-orange-400 text-sm flex-shrink-0">
                                <i class="fa-solid fa-user-pen"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Edited user – Karim Hassan
                                </div>
                                <div class="text-[11px] text-tm">Yesterday 04:22 PM</div>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-accent-glow flex items-center justify-center text-accent text-sm flex-shrink-0">
                                <i class="fa-solid fa-bus"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Added vehicle BUS-008
                                </div>
                                <div class="text-[11px] text-tm">Feb 28, 11:05 AM</div>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-violet-500/12 flex items-center justify-center text-violet-400 text-sm flex-shrink-0">
                                <i class="fa-solid fa-gear"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-t1">
                                    Updated system settings
                                </div>
                                <div class="text-[11px] text-tm">Feb 27, 02:45 PM</div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                </div>
                <!-- /right col -->
            </div>
        </form>
        <!-- /grid -->
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
