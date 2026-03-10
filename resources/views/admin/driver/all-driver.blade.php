@extends('layouts.admin-layout')

@section('title', 'All Driver')

@section('header_title')
    <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg icon-accent flex items-center justify-center text-sm">
            <i class="fa-solid fa-car"></i>
        </div>
        <div>
            <h1 class="font-display font-bold text-sm text-primary leading-tight">All Driver</h1>
            <p class="text-[10px] text-muted leading-tight">Manage drivers</p>
        </div>
    </div>
@endsection


@section('content')

    <main class="flex-1 p-4 md:p-6 overflow-auto">

        {{-- Page header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <div>
                <h2 class="text-lg font-bold text-primary">Driver List</h2>
                <p class="text-xs text-muted mt-1">
                    {{ $drivers->total() ?? 0 }} drivers registered
                </p>
            </div>

            <a href="{{ route('admin.add-driver') }}"
                class="inline-flex items-center gap-2 text-xs font-semibold px-4 py-2 rounded-lg
            bg-accent text-white hover:opacity-90 transition">

                <i class="fa-solid fa-user-plus"></i>
                Add Driver
            </a>

        </div>


        {{-- Table Card --}}
        <div class="bg-surface-card border border-surface-border rounded-xl overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    {{-- Table Head --}}
                    <thead class="bg-surface border-b border-surface-border text-xs text-muted">
                        <tr>
                            <th class="text-left px-5 py-3">Driver</th>
                            <th class="text-left px-5 py-3">Phone</th>
                            <th class="text-left px-5 py-3">Vehicle</th>
                            <th class="text-left px-5 py-3">Status</th>
                            <th class="text-center px-5 py-3">Action</th>
                        </tr>
                    </thead>


                    {{-- Table Body --}}
                    <tbody class="divide-y divide-surface-border">

                        @forelse ($drivers as $driver)
                            <tr class="hover:bg-surface transition">

                                {{-- Driver --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        @if ($driver->driver->photo)
                                            <img src="{{ $driver->driver->photo }}"
                                                class="w-9 h-9 rounded-full object-cover">
                                        @else
                                            <div
                                                class="w-9 h-9 rounded-full bg-accent/20 text-accent flex items-center justify-center font-bold text-xs">
                                                {{ strtoupper(substr($driver->driver->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div>
                                            <div class="font-semibold text-primary text-sm">
                                                {{ $driver->driver->name }}
                                            </div>

                                            <div class="text-[11px] text-muted">
                                                {{ $driver->driver->email }}
                                            </div>
                                        </div>

                                    </div>

                                </td>


                                {{-- Phone --}}
                                <td class="px-5 py-4 text-muted">
                                    {{ $driver->driver->phone ?? '—' }}
                                </td>


                                {{-- Vehicle --}}
                                <td class="px-5 py-4">

                                    @if ($driver->vehicle->count())
                                        <div class="flex flex-wrap gap-1">

                                            <span
                                                class="inline-flex items-center gap-1
                                        text-[10px] font-semibold
                                        px-2 py-1 rounded-md
                                        bg-accent/10 text-accent
                                        border border-accent/20">

                                                <i class="fa-solid fa-bus text-[9px]"></i>

                                                {{ $driver->vehicle->name ?? $driver->vehicle->number }}

                                            </span>

                                        </div>
                                    @else
                                        <span class="text-xs text-muted">
                                            Not Assigned
                                        </span>
                                    @endif

                                </td>


                                {{-- Status --}}
                                <td class="px-5 py-4">

                                    @if ($driver->driver->status == 'active')
                                        <span
                                            class="inline-flex items-center gap-1
                                text-[10px] font-semibold
                                px-2 py-1 rounded-md
                                bg-green-500/10 text-green-400 border border-green-500/20">

                                            <i class="fa-solid fa-circle text-[6px]"></i>
                                            Active

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1
                                text-[10px] font-semibold
                                px-2 py-1 rounded-md
                                bg-red-500/10 text-red-400 border border-red-500/20">

                                            <i class="fa-solid fa-circle text-[6px]"></i>
                                            Inactive

                                        </span>
                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-center gap-2">


                                        {{-- Delete --}}
                                        <form action="{{ route('admin.delete-driver', $driver->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this driver?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="w-8 h-8 rounded-md flex items-center justify-center
                                        text-muted hover:text-red-400 hover:bg-red-400/10 transition">

                                                <i class="fa-solid fa-trash text-[12px]"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-12">

                                    <div class="flex flex-col items-center gap-2">

                                        <div class="text-3xl text-muted">
                                            <i class="fa-solid fa-car"></i>
                                        </div>

                                        <div class="text-sm font-semibold text-primary">
                                            No drivers found
                                        </div>

                                        <div class="text-xs text-muted">
                                            Add a driver to get started
                                        </div>

                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            <div class="px-5 py-4 border-t border-surface-border">

                {{ $drivers->links() }}

            </div>

        </div>

    </main>

@endsection
