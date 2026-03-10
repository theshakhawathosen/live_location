@extends('layouts.admin-layout')

@section('title', 'Assign Vehicle')

@section('header_title')
    <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg icon-accent flex items-center justify-center text-sm">
            <i class="fa-solid fa-bus"></i>
        </div>
        <div>
            <h1 class="font-display font-bold text-sm text-primary leading-tight">Assign Vehicle</h1>
            <p class="text-[10px] text-muted leading-tight">Assign vehicle to driver</p>
        </div>
    </div>
@endsection


@section('content')

    <main class="flex-1 p-4 md:p-6 overflow-auto">

        <div class="max-w-xl mx-auto">


            {{-- Assign Form --}}
            <div class="bg-surface-card border border-surface-border rounded-xl p-6">

                <form action="{{ route('admin.store-driver') }}" method="POST">

                    @csrf

                    {{-- Vehicle Select --}}
                    <div class="mb-4">

                        <label class="block text-xs font-semibold text-muted mb-2">
                            Select Vehicle
                        </label>

                        <select name="vehicle_id"
                            class="w-full text-sm px-3 py-2 rounded-lg
            bg-surface border
            @error('vehicle_id') border-red-500 @else border-surface-border @enderror
            focus:outline-none focus:ring-2 focus:ring-accent">

                            <option value="">Select Vehicle</option>

                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}"
                                    {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>

                                    {{ $vehicle->name }} ({{ $vehicle->number_plate ?? '' }}) - {{ $vehicle->type }}

                                </option>
                            @endforeach

                        </select>

                        @error('vehicle_id')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror

                    </div>



                    {{-- Driver Select --}}
                    <div class="mb-4">

                        <label class="block text-xs font-semibold text-muted mb-2">
                            Select Driver
                        </label>

                        <select name="driver_id"
                            class="w-full text-sm px-3 py-2 rounded-lg
            bg-surface border
            @error('driver_id') border-red-500 @else border-surface-border @enderror
            focus:outline-none focus:ring-2 focus:ring-accent">

                            <option value="">Select Driver</option>

                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>

                                    {{ $driver->name }}

                                </option>
                            @endforeach

                        </select>

                        @error('driver_id')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror

                    </div>



                    {{-- Submit --}}
                    <div class="flex justify-end gap-2">

                        <a href="{{ route('admin.all-driver') }}"
                            class="text-xs px-4 py-2 rounded-lg
            border border-surface-border text-muted
            hover:bg-surface">

                            Cancel

                        </a>


                        <button type="submit"
                            class="text-xs px-4 py-2 rounded-lg
            bg-accent text-white hover:opacity-90">

                            Assign Vehicle

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </main>

@endsection
