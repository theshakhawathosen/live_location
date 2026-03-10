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
    <main class="flex-1 overflow-y-auto p-4 lg:p-6">
        <!-- Page Header -->
        <div class="flex items-start justify-between mb-6">
            <div>
                <div class="flex items-center gap-1.5 text-[11px] text-slate-500 mb-2">
                    <a href="dashboard.html" class="hover:text-[#0ea5a8] transition-colors"><i
                            class="fa-solid fa-house"></i></a>
                    <i class="fa-solid fa-chevron-right text-[8px]"></i>
                    <a href="users.html" class="hover:text-[#0ea5a8] transition-colors">Users</a>
                    <i class="fa-solid fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-400">Add User</span>
                </div>
                <h1 class="font-display font-bold text-xl text-white">
                    Add New User
                </h1>
                <p class="text-xs text-slate-500 mt-0.5">
                    Fill in the details to register a new user
                </p>
            </div>
            <a href="{{ route('admin.user.index') }}"
                class="flex items-center gap-2 text-xs font-bold text-slate-400 border border-[#1e3040] bg-white/5 hover:bg-white/10 hover:text-slate-200 px-3.5 py-2 rounded-xl transition-colors">
                <i class="fa-solid fa-arrow-left text-[10px]"></i> Back
            </a>
        </div>

        <form class="max-w-2xl" method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="bg-[#162130] border border-[#1e3040] rounded-2xl overflow-hidden">
                <!-- ── Avatar Upload ── -->
                <div class="px-6 py-5 border-b border-[#1e3040]">
                    <div class="font-display font-bold text-sm text-slate-200 mb-4">
                        Profile Photo
                    </div>
                    <div class="flex items-center gap-5">
                        <div id="av-wrap" onclick="document.getElementById('av-inp').click()">
                            <div class="avatar-wrapper">
                                <i class="fa-solid fa-user" id="av-icon"></i>
                                <div class="av-overlay">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                            </div>
                            <input type="file" id="av-inp" accept="image/*" class="hidden"
                                onchange="previewAvatar(event)" name="photo" />
                        </div>
                        <div>
                            <div class="text-sm font-bold text-slate-200 mb-1">
                                Upload Profile Photo
                            </div>
                            <div class="text-xs text-slate-500">
                                Click avatar to upload · JPG, PNG up to 2MB
                            </div>
                            <button type="button" onclick="document.getElementById('av-inp').click()"
                                class="mt-2.5 flex items-center gap-1.5 text-xs font-bold text-slate-400 border border-[#1e3040] bg-white/5 hover:bg-white/10 hover:text-slate-200 px-3 py-1.5 rounded-lg transition-colors">
                                <i class="fa-solid fa-upload text-[10px]"></i> Upload
                            </button>
                        </div>
                    </div>
                    @error('photo')
                        <p class="error-text mt-3">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ── Form Fields ── -->
                <div class="px-6 pt-5 pb-6">
                    <div class="font-display font-bold text-sm text-slate-200 mb-5">
                        User Information
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div class="flex flex-col gap-1.5 sm:col-span-2">
                            <label class="text-xs font-bold text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-user text-[#0ea5a8] text-[10px]"></i>
                                Full Name
                            </label>
                            <input class="form-input" type="text" name="name" value="{{ old('name') }}"
                                placeholder="Full Name" />
                            @error('name')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email – full width -->
                        <div class="flex flex-col gap-1.5 sm:col-span-2">
                            <label class="text-xs font-bold text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-envelope text-[#0ea5a8] text-[10px]"></i>
                                Email Address
                            </label>
                            <input class="form-input" type="email" placeholder="user@diu.edu.bd" name="email"
                                value="{{ old('email') }}" />
                            @error('email')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone – full width -->
                        <div class="flex flex-col gap-1.5 sm:col-span-2">
                            <label class="text-xs font-bold text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-phone text-[#0ea5a8] text-[10px]"></i>
                                Phone Number
                            </label>
                            <input class="form-input" type="number" placeholder="+880 1X XX XXX XXX" name="phone"
                                value="{{ old('phone') }}" />
                            @error('phone')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-user-tag text-[#0ea5a8] text-[10px]"></i>
                                Role
                            </label>
                            <select class="form-select" name="role">
                                <option value="">Select role…</option>
                                <option {{ old('role') == 'student' ? 'selected' : '' }} value="student">Student</option>
                                <option {{ old('role') == 'driver' ? 'selected' : '' }} value="driver">Driver</option>
                                <option {{ old('role') == 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                            </select>
                            @error('role')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-dot text-[#0ea5a8] text-[10px]"></i>
                                Status
                            </label>
                            <select class="form-select" name="status">
                                <option {{ old('status') == 'active' ? 'selected' : '' }} value="active">Active</option>
                                <option {{ old('status') == 'inactive' ? 'selected' : '' }} value="inactive">Inactive
                                </option>
                            </select>
                            @error('status')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-5 mt-5 border-t border-[#1e3040]">
                        <a href="{{ route('admin.user.index') }}"
                            class="text-xs font-bold text-slate-400 border border-[#1e3040] bg-white/5 hover:bg-white/10 hover:text-slate-200 px-4 py-2.5 rounded-xl transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                            class="flex items-center gap-2 text-xs font-bold text-white bg-[#0ea5a8] hover:bg-[#0d9396] px-5 py-2.5 rounded-xl transition-colors shadow-lg shadow-[#0ea5a8]/20">
                            <i class="fa-solid fa-floppy-disk"></i> Save User
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection

@push('js')
    <script>
        function previewAvatar(e) {
            var file = e.target.files[0];
            if (!file) return;
            var reader = new FileReader();
            reader.onload = function(ev) {
                var el = document.querySelector(".avatar-wrapper");
                el.innerHTML =
                    '<img src="' +
                    ev.target.result +
                    '" style="width:100%;height:100%;border-radius:18px;object-fit:cover;" alt="Avatar"/>';
                el.onclick = function() {
                    document.getElementById("av-inp").click();
                };
            };
            reader.readAsDataURL(file);
        }
    </script>
@endpush


@push('css')
    <style>
        /* Form controls */
        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            background: #0d1821;
            border: 1px solid #1e3040;
            border-radius: 0.625rem;
            padding: 0.6rem 0.875rem;
            font-size: 0.8125rem;
            color: #e2e8f0;
            font-family: "Nunito", sans-serif;
            outline: none;
            transition:
                border-color 0.2s,
                box-shadow 0.2s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #0ea5a8;
            box-shadow: 0 0 0 3px rgba(14, 165, 168, 0.12);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #3d5a6d;
        }

        .form-select option {
            background: #0d1821;
        }

        .form-textarea {
            resize: vertical;
            min-height: 84px;
        }


        /* Avatar upload */
        #av-wrap {
            position: relative;
            width: 72px;
            height: 72px;
            border-radius: 18px;
            background: #0d1821;
            border: 2px dashed #1e3040;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4b6882;
            font-size: 22px;
            cursor: pointer;
            overflow: hidden;
            transition: border-color 0.2s;
            flex-shrink: 0;
        }

        #av-wrap:hover {
            border-color: #0ea5a8;
            color: #0ea5a8;
        }

        .av-overlay {
            position: absolute;
            inset: 0;
            background: rgba(14, 165, 168, 0.65);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 16px;
            opacity: 0;
            transition: opacity 0.2s;
        }

        #av-wrap:hover .av-overlay {
            opacity: 1;
        }
    </style>
@endpush
