@extends('layouts.admin-layout')

@section('title', 'Edit User')

@section('header_title')
    <div>
        <div class="text-sm font-bold text-t1 leading-tight">
            Edit User
        </div>
        <div class="text-xs text-tm">
            Update user account information
        </div>
    </div>
@endsection


@section('content')
    <main class="flex-1 overflow-y-auto p-4 lg:p-6">

        <!-- Page Header -->
        <div class="flex items-start justify-between mb-6">

            <div>
                <div class="flex items-center gap-1.5 text-[11px] text-slate-500 mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#0ea5a8]">
                        <i class="fa-solid fa-house"></i>
                    </a>

                    <i class="fa-solid fa-chevron-right text-[8px]"></i>

                    <a href="{{ route('admin.user.index') }}" class="hover:text-[#0ea5a8]">
                        Users
                    </a>

                    <i class="fa-solid fa-chevron-right text-[8px]"></i>

                    <span class="text-slate-400">
                        Edit User
                    </span>
                </div>

                <h1 class="font-display font-bold text-xl text-white">
                    Edit User
                </h1>

                <p class="text-xs text-slate-500 mt-0.5">
                    Update user information
                </p>
            </div>

            <a href="{{ route('admin.user.index') }}"
                class="flex items-center gap-2 text-xs font-bold text-slate-400 border border-[#1e3040] bg-white/5 hover:bg-white/10 px-3.5 py-2 rounded-xl">

                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                Back
            </a>

        </div>


        <form class="max-w-2xl" method="POST" action="{{ route('admin.user.update', $user->id) }}"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')


            <div class="bg-[#162130] border border-[#1e3040] rounded-2xl overflow-hidden">


                <!-- Avatar -->
                <div class="px-6 py-5 border-b border-[#1e3040]">

                    <div class="font-display font-bold text-sm text-slate-200 mb-4">
                        Profile Photo
                    </div>

                    <div class="flex items-center gap-5">

                        <div id="av-wrap" onclick="document.getElementById('av-inp').click()">

                            <div class="avatar-wrapper">

                                @if ($user->photo)
                                    <img src="{{ $user->photo }}"
                                        style="width:100%;height:100%;border-radius:18px;object-fit:cover;">
                                @else
                                    <i class="fa-solid fa-user" id="av-icon"></i>
                                @endif

                                <div class="av-overlay">
                                    <i class="fa-solid fa-camera"></i>
                                </div>

                            </div>

                            <input type="file" id="av-inp" accept="image/*" class="hidden"
                                onchange="previewAvatar(event)" name="photo">

                        </div>


                        <div>

                            <div class="text-sm font-bold text-slate-200 mb-1">
                                Update Profile Photo
                            </div>

                            <div class="text-xs text-slate-500">
                                JPG / PNG up to 2MB
                            </div>

                        </div>

                    </div>

                    @error('photo')
                        <p class="error-text mt-3">{{ $message }}</p>
                    @enderror

                </div>



                <!-- Form -->
                <div class="px-6 pt-5 pb-6">

                    <div class="font-display font-bold text-sm text-slate-200 mb-5">
                        User Information
                    </div>


                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">


                        <!-- Name -->
                        <div class="flex flex-col gap-1.5 sm:col-span-2">

                            <label class="text-xs font-bold text-slate-400">
                                Full Name
                            </label>

                            <input class="form-input" type="text" name="name" value="{{ old('name', $user->name) }}">

                            @error('name')
                                <p class="error-text">{{ $message }}</p>
                            @enderror

                        </div>


                        <!-- Email -->
                        <div class="flex flex-col gap-1.5 sm:col-span-2">

                            <label class="text-xs font-bold text-slate-400">
                                Email
                            </label>

                            <input class="form-input" type="email" name="email"
                                value="{{ old('email', $user->email) }}">

                            @error('email')
                                <p class="error-text">{{ $message }}</p>
                            @enderror

                        </div>


                        <!-- Phone -->
                        <div class="flex flex-col gap-1.5 sm:col-span-2">

                            <label class="text-xs font-bold text-slate-400">
                                Phone
                            </label>

                            <input class="form-input" type="text" name="phone"
                                value="{{ old('phone', $user->phone) }}">

                            @error('phone')
                                <p class="error-text">{{ $message }}</p>
                            @enderror

                        </div>


                        <!-- Role -->
                        <div class="flex flex-col gap-1.5">

                            <label class="text-xs font-bold text-slate-400">
                                Role
                            </label>

                            <select class="form-select" name="role">

                                <option @if (Auth::user()->id == $user->id) disabled @endif value="student"
                                    {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>
                                    Student
                                </option>

                                <option @if (Auth::user()->id == $user->id) disabled @endif value="driver"
                                    {{ old('role', $user->role) == 'driver' ? 'selected' : '' }}>
                                    Driver
                                </option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>

                            </select>

                            @error('role')
                                <p class="error-text">{{ $message }}</p>
                            @enderror

                        </div>



                        <!-- Status -->
                        <div class="flex flex-col gap-1.5">

                            <label class="text-xs font-bold text-slate-400">
                                Status
                            </label>

                            <select class="form-select" name="status">

                                <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive" @if (Auth::user()->id == $user->id) disabled @endif
                                    {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                            @error('status')
                                <p class="error-text">{{ $message }}</p>
                            @enderror

                        </div>


                    </div>



                    <!-- Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-5 mt-5 border-t border-[#1e3040]">

                        <a href="{{ route('admin.user.index') }}"
                            class="text-xs font-bold text-slate-400 border border-[#1e3040] bg-white/5 hover:bg-white/10 px-4 py-2.5 rounded-xl">
                            Cancel
                        </a>

                        <button type="submit"
                            class="flex items-center gap-2 text-xs font-bold text-white bg-[#0ea5a8] hover:bg-[#0d9396] px-5 py-2.5 rounded-xl">

                            <i class="fa-solid fa-pen"></i>
                            Update User

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
