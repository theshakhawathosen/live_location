@extends('layouts.admin-layout')

@section('content')
    <main class="flex-1 overflow-y-auto p-4 lg:p-6 space-y-5">
        <!-- ── Stat Cards ── -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div
                class="card border rounded-2xl p-4 flex flex-col gap-3 hover:border-[color:var(--accent)]/30 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="icon-accent w-10 h-10 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-users text-sm"></i>
                    </div>
                    <span class="text-[10px] font-bold text-emerald-400 bg-emerald-400/10 px-2 py-0.5 rounded-full">↑
                        +34</span>
                </div>
                <div>
                    <div class="font-display font-bold text-2xl text-white">
                        1,284
                    </div>
                    <div class="text-xs text-slate-500 mt-0.5">Total Students</div>
                </div>
            </div>

            <div class="card border rounded-2xl p-4 flex flex-col gap-3 hover:border-orange-500/30 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-orange-500/12 flex items-center justify-center text-orange-400">
                        <i class="fa-solid fa-id-card text-sm"></i>
                    </div>
                    <span class="text-[10px] font-bold text-emerald-400 bg-emerald-400/10 px-2 py-0.5 rounded-full">↑
                        +2</span>
                </div>
                <div>
                    <div class="font-display font-bold text-2xl text-white">48</div>
                    <div class="text-xs text-slate-500 mt-0.5">Active Drivers</div>
                </div>
            </div>

            <div class="card border rounded-2xl p-4 flex flex-col gap-3 hover:border-purple-500/30 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-purple-500/12 flex items-center justify-center text-purple-400">
                        <i class="fa-solid fa-bus-simple text-sm"></i>
                    </div>
                    <span class="text-[10px] font-bold text-orange-400 bg-orange-400/10 px-2 py-0.5 rounded-full">3
                        service</span>
                </div>
                <div>
                    <div class="font-display font-bold text-2xl text-white">36</div>
                    <div class="text-xs text-slate-500 mt-0.5">Total Buses</div>
                </div>
            </div>

            <div class="card border rounded-2xl p-4 flex flex-col gap-3 hover:border-emerald-500/30 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/12 flex items-center justify-center text-emerald-400">
                        <i class="fa-solid fa-route text-sm"></i>
                    </div>
                    <span class="text-[10px] font-bold text-emerald-400 bg-emerald-400/10 px-2 py-0.5 rounded-full">All
                        live</span>
                </div>
                <div>
                    <div class="font-display font-bold text-2xl text-white">12</div>
                    <div class="text-xs text-slate-500 mt-0.5">Active Routes</div>
                </div>
            </div>
        </div>

        <!-- ── Charts ── -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="card border rounded-2xl p-5">
                <div class="font-display font-bold text-sm text-slate-200 mb-4">
                    User Growth
                    <span class="font-body font-normal text-xs text-slate-500">(Last 6 Months)</span>
                </div>
                <div class="chart-box h-48">
                    <canvas id="growthChart"></canvas>
                </div>
            </div>
            <div class="card border rounded-2xl p-5">
                <div class="font-display font-bold text-sm text-slate-200 mb-4">
                    Daily Trips
                    <span class="font-body font-normal text-xs text-slate-500">(This Week)</span>
                </div>
                <div class="chart-box h-48">
                    <canvas id="tripsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- ── Map + Drivers ── -->
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-4">
            <!-- Map -->
            <div class="card border rounded-2xl overflow-hidden">
                <div class="flex items-center justify-between px-5 py-3.5 border-b border-theme">
                    <div>
                        <div class="font-display font-bold text-sm text-slate-200">
                            Live Driver Locations
                        </div>
                        <div class="text-[11px] text-slate-500 mt-0.5">
                            Real-time GPS · 12 active now
                        </div>
                    </div>
                    <div class="live-badge flex items-center gap-1.5 rounded-full px-3 py-1 text-[11px] font-bold border">
                        <span class="live-dot w-1.5 h-1.5 rounded-full pulse inline-block"></span>Live
                    </div>
                </div>
                <iframe id="live-map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29215.35984870478!2d90.35420274999999!3d23.750933050000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka%2C%20Bangladesh!5e0!3m2!1sen!2sbd!4v1698000000000!5m2!1sen!2sbd"
                    loading="lazy" title="Live Map"></iframe>
            </div>

            <!-- Active Drivers -->
            <div class="card border rounded-2xl flex flex-col overflow-hidden">
                <div class="px-5 py-3.5 border-b border-theme">
                    <div class="font-display font-bold text-sm text-slate-200">
                        Active Drivers
                    </div>
                </div>
                <div class="flex-1 overflow-y-auto divide-y divide-theme">
                    <!-- Driver rows -->
                    <div class="flex items-center gap-3 px-4 py-3 hover:bg-white/[0.02] transition-colors">
                        <div
                            class="icon-accent-sm w-8 h-8 rounded-xl text-xs flex-shrink-0 flex items-center justify-center">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-slate-200 truncate">
                                Rahim Uddin
                            </div>
                            <div class="text-[10px] text-slate-500">
                                Route 04 · Bus A
                            </div>
                        </div>
                        <span
                            class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-500/15 text-emerald-400 flex-shrink-0">On
                            Route</span>
                    </div>
                    <div class="flex items-center gap-3 px-4 py-3 hover:bg-white/[0.02] transition-colors">
                        <div
                            class="icon-accent-sm w-8 h-8 rounded-xl text-xs flex-shrink-0 flex items-center justify-center">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-slate-200 truncate">
                                Kamal Hossain
                            </div>
                            <div class="text-[10px] text-slate-500">
                                Route 07 · Bus C
                            </div>
                        </div>
                        <span
                            class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-orange-500/15 text-orange-400 flex-shrink-0">Delayed</span>
                    </div>
                    <div class="flex items-center gap-3 px-4 py-3 hover:bg-white/[0.02] transition-colors">
                        <div
                            class="icon-accent-sm w-8 h-8 rounded-xl text-xs flex-shrink-0 flex items-center justify-center">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-slate-200 truncate">
                                Faruk Mia
                            </div>
                            <div class="text-[10px] text-slate-500">
                                Route 02 · Bus D
                            </div>
                        </div>
                        <span
                            class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-500/15 text-emerald-400 flex-shrink-0">On
                            Route</span>
                    </div>
                    <div class="flex items-center gap-3 px-4 py-3 hover:bg-white/[0.02] transition-colors">
                        <div
                            class="icon-accent-sm w-8 h-8 rounded-xl text-xs flex-shrink-0 flex items-center justify-center">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-slate-200 truncate">
                                Jalal Ahmed
                            </div>
                            <div class="text-[10px] text-slate-500">
                                Route 06 · Bus E
                            </div>
                        </div>
                        <span
                            class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-500/15 text-emerald-400 flex-shrink-0">On
                            Route</span>
                    </div>
                    <div class="flex items-center gap-3 px-4 py-3 hover:bg-white/[0.02] transition-colors">
                        <div
                            class="icon-accent-sm w-8 h-8 rounded-xl text-xs flex-shrink-0 flex items-center justify-center">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-slate-200 truncate">
                                Nizam Uddin
                            </div>
                            <div class="text-[10px] text-slate-500">
                                Route 08 · Bus F
                            </div>
                        </div>
                        <span
                            class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-500/20 text-slate-400 flex-shrink-0">Idle</span>
                    </div>
                    <div class="flex items-center gap-3 px-4 py-3 hover:bg-white/[0.02] transition-colors">
                        <div
                            class="icon-accent-sm w-8 h-8 rounded-xl text-xs flex-shrink-0 flex items-center justify-center">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-slate-200 truncate">
                                Monir Hossain
                            </div>
                            <div class="text-[10px] text-slate-500">
                                Route 12 · Bus G
                            </div>
                        </div>
                        <span
                            class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-500/15 text-emerald-400 flex-shrink-0">On
                            Route</span>
                    </div>
                </div>
                <div class="px-4 py-3 border-t border-theme text-center">
                    <a href="#" class="accent-link text-xs font-bold transition-colors">View
                        all drivers →</a>
                </div>
            </div>
        </div>

        <!-- ── Fleet Table ── -->
        <div class="card border rounded-2xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-3.5 border-b border-theme">
                <div class="font-display font-bold text-sm text-slate-200">
                    Fleet Overview
                </div>
                <a href="#"
                    class="view-all-btn flex items-center gap-1.5 text-xs font-bold border px-3 py-1.5 rounded-lg transition-colors">
                    <i class="fa-solid fa-arrow-right text-[10px]"></i> View All
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead>
                        <tr class="border-b border-theme">
                            <th class="text-left px-5 py-3 text-slate-500 font-semibold whitespace-nowrap">
                                Bus ID
                            </th>
                            <th class="text-left px-5 py-3 text-slate-500 font-semibold whitespace-nowrap">
                                Vehicle
                            </th>
                            <th class="text-left px-5 py-3 text-slate-500 font-semibold whitespace-nowrap">
                                Plate
                            </th>
                            <th class="text-left px-5 py-3 text-slate-500 font-semibold whitespace-nowrap">
                                Route
                            </th>
                            <th class="text-left px-5 py-3 text-slate-500 font-semibold whitespace-nowrap">
                                Driver
                            </th>
                            <th class="text-left px-5 py-3 text-slate-500 font-semibold whitespace-nowrap">
                                Capacity
                            </th>
                            <th class="text-left px-5 py-3 text-slate-500 font-semibold whitespace-nowrap">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-theme">
                        <tr class="hover:bg-white/[0.015] transition-colors">
                            <td class="px-5 py-3.5 font-bold bus-id-cell">
                                BUS-001
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="icon-accent-sm w-7 h-7 rounded-lg flex items-center justify-center">
                                        <i class="fa-solid fa-bus-simple text-[10px]"></i>
                                    </div>
                                    <span class="text-slate-300 whitespace-nowrap">Hino Bus 2022</span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-slate-400 font-mono text-[11px]">
                                DHK-A-1234
                            </td>
                            <td class="px-5 py-3.5 text-slate-300">Route 04</td>
                            <td class="px-5 py-3.5 text-slate-300 whitespace-nowrap">
                                Rahim Uddin
                            </td>
                            <td class="px-5 py-3.5 text-slate-300">45</td>
                            <td class="px-5 py-3.5">
                                <span
                                    class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-emerald-500/15 text-emerald-400">Active</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-white/[0.015] transition-colors">
                            <td class="px-5 py-3.5 font-bold bus-id-cell">
                                BUS-002
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="icon-accent-sm w-7 h-7 rounded-lg flex items-center justify-center">
                                        <i class="fa-solid fa-bus-simple text-[10px]"></i>
                                    </div>
                                    <span class="text-slate-300 whitespace-nowrap">Tata Bus 2021</span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-slate-400 font-mono text-[11px]">
                                DHK-B-5678
                            </td>
                            <td class="px-5 py-3.5 text-slate-300">Route 07</td>
                            <td class="px-5 py-3.5 text-slate-300 whitespace-nowrap">
                                Kamal Hossain
                            </td>
                            <td class="px-5 py-3.5 text-slate-300">40</td>
                            <td class="px-5 py-3.5">
                                <span
                                    class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-orange-500/15 text-orange-400">Delayed</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-white/[0.015] transition-colors">
                            <td class="px-5 py-3.5 font-bold bus-id-cell">
                                BUS-003
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="icon-accent-sm w-7 h-7 rounded-lg flex items-center justify-center">
                                        <i class="fa-solid fa-bus-simple text-[10px]"></i>
                                    </div>
                                    <span class="text-slate-300 whitespace-nowrap">Volvo Bus 2023</span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-slate-400 font-mono text-[11px]">
                                DHK-C-9012
                            </td>
                            <td class="px-5 py-3.5 text-slate-300">Route 02</td>
                            <td class="px-5 py-3.5 text-slate-300 whitespace-nowrap">
                                Faruk Mia
                            </td>
                            <td class="px-5 py-3.5 text-slate-300">50</td>
                            <td class="px-5 py-3.5">
                                <span
                                    class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-emerald-500/15 text-emerald-400">Active</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-white/[0.015] transition-colors">
                            <td class="px-5 py-3.5 font-bold bus-id-cell">
                                BUS-004
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="icon-accent-sm w-7 h-7 rounded-lg flex items-center justify-center">
                                        <i class="fa-solid fa-bus-simple text-[10px]"></i>
                                    </div>
                                    <span class="text-slate-300 whitespace-nowrap">Ashok Leyland 2020</span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-slate-400 font-mono text-[11px]">
                                DHK-D-3456
                            </td>
                            <td class="px-5 py-3.5 text-slate-400">—</td>
                            <td class="px-5 py-3.5 text-slate-400">—</td>
                            <td class="px-5 py-3.5 text-slate-300">42</td>
                            <td class="px-5 py-3.5">
                                <span
                                    class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-red-500/15 text-red-400">Maintenance</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-white/[0.015] transition-colors">
                            <td class="px-5 py-3.5 font-bold bus-id-cell">
                                BUS-005
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="icon-accent-sm w-7 h-7 rounded-lg flex items-center justify-center">
                                        <i class="fa-solid fa-bus-simple text-[10px]"></i>
                                    </div>
                                    <span class="text-slate-300 whitespace-nowrap">Hino Bus 2022</span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-slate-400 font-mono text-[11px]">
                                DHK-E-7890
                            </td>
                            <td class="px-5 py-3.5 text-slate-300">Route 06</td>
                            <td class="px-5 py-3.5 text-slate-300 whitespace-nowrap">
                                Jalal Ahmed
                            </td>
                            <td class="px-5 py-3.5 text-slate-300">45</td>
                            <td class="px-5 py-3.5">
                                <span
                                    class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-emerald-500/15 text-emerald-400">Active</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection

@section('header_title')
    <div>
        <div class="font-display font-bold text-white text-sm leading-tight">
            Dashboard
        </div>
        <div class="text-xs text-slate-500">Welcome back, {{ Auth::user()->name }}</div>
    </div>
@endsection
