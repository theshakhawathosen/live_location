@extends('layouts.admin-layout')
@section('title', 'Add Car')
@section('header_title')
    <div>
        <div class="text-sm font-bold text-t1 leading-tight">
            Add Car
        </div>
        <div class="text-xs text-tm">
            Register a new vehicle to the fleet
        </div>
    </div>
@endsection

@section('content')
    <main class="flex-1 overflow-y-auto p-4 lg:p-6">
        <!-- Page Header -->
        <div class="flex items-start justify-between mb-6">
            <div>
                <div class="flex items-center gap-1.5 text-[11px] text-slate-500 mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#0ea5a8] transition-colors">
                        <i class="fa-solid fa-house"></i>
                    </a>
                    <i class="fa-solid fa-chevron-right text-[8px]"></i>
                    <a href="{{ route('admin.car.index') }}" class="hover:text-[#0ea5a8] transition-colors">Cars</a>
                    <i class="fa-solid fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-400">Add Car</span>
                </div>
                <h1 class="font-display font-bold text-xl text-white">
                    Add New Car
                </h1>
                <p class="text-xs text-slate-500 mt-0.5">
                    Fill in the details to register a new vehicle
                </p>
            </div>
            <a href="{{ route('admin.car.index') }}"
                class="flex items-center gap-2 text-xs font-bold text-slate-400 border border-[#1e3040] bg-white/5 hover:bg-white/10 hover:text-slate-200 px-3.5 py-2 rounded-xl transition-colors">
                <i class="fa-solid fa-arrow-left text-[10px]"></i> Back
            </a>
        </div>

        <form class="max-w-2xl" method="POST" action="{{ route('admin.car.store') }}">
            @csrf
            @method('POST')
            <div class="bg-[#162130] border border-[#1e3040] rounded-2xl overflow-hidden">

                <!-- ── Vehicle Icon Banner ── -->
                <div class="px-6 py-5 border-b border-[#1e3040]">
                    <div class="font-display font-bold text-sm text-slate-200 mb-4">
                        Vehicle Identity
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="car-icon-wrap">
                            <i class="fa-solid fa-bus" id="car-type-icon"></i>
                        </div>
                        <div>
                            <div class="text-sm font-bold text-slate-200 mb-1">
                                Vehicle Type Preview
                            </div>
                            <div class="text-xs text-slate-500">
                                Icon updates automatically based on selected type
                            </div>
                            <div class="mt-2 flex items-center gap-2">
                                <span id="type-badge"
                                    class="inline-flex items-center gap-1.5 text-[10px] font-bold px-2.5 py-1 rounded-lg bg-[#0ea5a8]/10 text-[#0ea5a8] border border-[#0ea5a8]/20">
                                    <i class="fa-solid fa-circle text-[6px]"></i> Bus
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ── Form Fields ── -->
                <div class="px-6 pt-5 pb-6">
                    <div class="font-display font-bold text-sm text-slate-200 mb-5">
                        Vehicle Information
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <!-- Car Name – full width -->
                        <div class="flex flex-col gap-1.5 sm:col-span-2">
                            <label class="text-xs font-bold text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-tag text-[#0ea5a8] text-[10px]"></i>
                                Car Name
                            </label>
                            <input class="form-input" type="text" name="name" value="{{ old('name') }}"
                                placeholder="e.g. Dhaka Express 01" />
                            @error('name')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Number Plate – full width -->
                        <div class="flex flex-col gap-1.5 sm:col-span-2">
                            <label class="text-xs font-bold text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-id-card text-[#0ea5a8] text-[10px]"></i>
                                Number Plate
                                <span class="text-slate-600 font-normal">(optional)</span>
                            </label>
                            <input class="form-input" type="text" name="number_plate" value="{{ old('number_plate') }}"
                                placeholder="e.g. Dhaka Metro-G 11-1234" />
                            @error('number_plate')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-bus text-[#0ea5a8] text-[10px]"></i>
                                Vehicle Type
                            </label>
                            <select class="form-select" name="type" id="type-select"
                                onchange="updateTypePreview(this.value)">
                                <option value="">Select type…</option>
                                <option {{ old('type') == 'bus' ? 'selected' : '' }} value="bus">Bus</option>
                                <option {{ old('type') == 'hiace' ? 'selected' : '' }} value="hiace">Hiace</option>
                            </select>
                            @error('type')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Capacity -->
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-users text-[#0ea5a8] text-[10px]"></i>
                                Capacity
                                <span class="text-slate-600 font-normal">(optional)</span>
                            </label>
                            <input class="form-input" type="number" name="capacity" value="{{ old('capacity') }}"
                                placeholder="e.g. 40" min="1" />
                            @error('capacity')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Assigned Driver – full width -->
                        <div class="flex flex-col gap-1.5 sm:col-span-2">
                            <label class="text-xs font-bold text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-steering-wheel text-[#0ea5a8] text-[10px]"></i>
                                Assigned Driver
                            </label>
                            <select class="form-select" name="user_id">
                                <option value="">Select driver…</option>
                                @foreach ($drivers as $driver)
                                    <option {{ old('user_id') == $driver->id ? 'selected' : '' }}
                                        value="{{ $driver->id }}">
                                        {{ $driver->name }}
                                        @if ($driver->phone)
                                            — {{ $driver->phone }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status – full width -->
                        <div class="flex flex-col gap-1.5 sm:col-span-2">
                            <label class="text-xs font-bold text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-dot text-[#0ea5a8] text-[10px]"></i>
                                Status
                            </label>
                            <div class="flex items-center gap-3">
                                <!-- Active -->
                                <label class="status-card {{ old('status', '1') == '1' ? 'active' : '' }}"
                                    id="status-active-card">
                                    <input type="radio" name="status" value="1"
                                        {{ old('status', '1') == '1' ? 'checked' : '' }} class="hidden"
                                        onchange="highlightStatus()" />
                                    <span
                                        class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_6px_rgba(52,211,153,0.7)]"></span>
                                    <span class="text-xs font-bold text-slate-300">Active</span>
                                </label>
                                <!-- Inactive -->
                                <label class="status-card {{ old('status') == '0' ? 'active' : '' }}"
                                    id="status-inactive-card">
                                    <input type="radio" name="status" value="0"
                                        {{ old('status') == '0' ? 'checked' : '' }} class="hidden"
                                        onchange="highlightStatus()" />
                                    <span class="w-2 h-2 rounded-full bg-slate-500"></span>
                                    <span class="text-xs font-bold text-slate-400">Inactive</span>
                                </label>
                            </div>
                            @error('status')
                                <p class="error-text mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-5 mt-5 border-t border-[#1e3040]">
                        <a href="{{ route('admin.car.index') }}"
                            class="text-xs font-bold text-slate-400 border border-[#1e3040] bg-white/5 hover:bg-white/10 hover:text-slate-200 px-4 py-2.5 rounded-xl transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                            class="flex items-center gap-2 text-xs font-bold text-white bg-[#0ea5a8] hover:bg-[#0d9396] px-5 py-2.5 rounded-xl transition-colors shadow-lg shadow-[#0ea5a8]/20">
                            <i class="fa-solid fa-floppy-disk"></i> Save Car
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection

@push('js')
    <script>
        const typeConfig = {
            bus: {
                icon: 'fa-bus',
                label: 'Bus',
            },
            hiace: {
                icon: 'fa-van-shuttle',
                label: 'Hiace',
            },
        };

        function updateTypePreview(val) {
            const cfg = typeConfig[val];
            const iconEl = document.getElementById('car-type-icon');
            const badgeEl = document.getElementById('type-badge');

            if (cfg) {
                iconEl.className = `fa-solid ${cfg.icon}`;
                badgeEl.innerHTML =
                    `<i class="fa-solid fa-circle text-[6px]"></i> ${cfg.label}`;
            } else {
                iconEl.className = 'fa-solid fa-bus';
                badgeEl.innerHTML = `<i class="fa-solid fa-circle text-[6px]"></i> —`;
            }
        }

        function highlightStatus() {
            const activeCard = document.getElementById('status-active-card');
            const inactiveCard = document.getElementById('status-inactive-card');
            const activeRadio = activeCard.querySelector('input');

            if (activeRadio.checked) {
                activeCard.classList.add('active');
                inactiveCard.classList.remove('active');
            } else {
                inactiveCard.classList.add('active');
                activeCard.classList.remove('active');
            }
        }

        // Init on page load (for old() repopulation)
        document.addEventListener('DOMContentLoaded', function() {
            const sel = document.getElementById('type-select');
            if (sel.value) updateTypePreview(sel.value);
        });
    </script>
@endpush

@push('css')
    <style>
        /* ── Form controls ── */
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
            transition: border-color 0.2s, box-shadow 0.2s;
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

        /* ── Vehicle icon wrap ── */
        .car-icon-wrap {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            background: #0d1821;
            border: 2px solid #1e3040;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0ea5a8;
            font-size: 26px;
            flex-shrink: 0;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-shadow: 0 0 0 0 rgba(14, 165, 168, 0);
        }

        .car-icon-wrap:hover {
            border-color: #0ea5a8;
            box-shadow: 0 0 16px rgba(14, 165, 168, 0.15);
        }

        /* ── Status radio cards ── */
        .status-card {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.625rem;
            border: 1px solid #1e3040;
            background: #0d1821;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }

        .status-card:hover {
            border-color: #0ea5a8;
        }

        .status-card.active {
            border-color: #0ea5a8;
            background: rgba(14, 165, 168, 0.07);
        }

        /* ── Error text ── */
        .error-text {
            font-size: 0.7rem;
            color: #f87171;
            margin-top: 0.1rem;
        }
    </style>
@endpush
