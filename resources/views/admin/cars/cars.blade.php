@extends('layouts.admin-layout')

@section('title', 'Cars')

@section('header_title')
    <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg icon-accent flex items-center justify-center text-sm">
            <i class="fa-solid fa-car"></i>
        </div>
        <div>
            <h1 class="font-display font-bold text-sm text-primary leading-tight">All Cars</h1>
            <p class="text-[10px] text-muted leading-tight">Manage registered Cars</p>
        </div>
    </div>
@endsection

@push('css')
    <style>
        :root {
            --bg: #f0f4f8;
            --card-bg: #ffffff;
            --border: #e2e8f0;
            --hover-bg: #f7fafc;
            --txt-1: #0f172a;
            --txt-2: #475569;
            --txt-m: #94a3b8;
            --accent: #0d9488;
            --accent2: #0891b2;
            --glow: rgba(13, 148, 136, .12);
            --red: #ef4444;
        }

        html.dark {
            --bg: #0d1117;
            --card-bg: #161b22;
            --border: #21262d;
            --hover-bg: #1c2128;
            --txt-1: #e6edf3;
            --txt-2: #8b949e;
            --txt-m: #6e7681;
            --accent: #2dd4bf;
            --accent2: #06b6d4;
            --glow: rgba(45, 212, 191, .15);
            --red: #ef4444;
        }

        /* ── Base ── */
        body {
            background: var(--bg);
            color: var(--txt-1);
        }

        * {
            box-sizing: border-box;
        }

        /* ── Stat cards ── */
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 18px 20px;
            position: relative;
            overflow: hidden;
            transition: transform .18s, box-shadow .18s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, .18);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            border-radius: 18px 18px 0 0;
        }

        .stat-card.c-teal::before {
            background: linear-gradient(90deg, var(--accent), var(--accent2));
        }

        .stat-card.c-orange::before {
            background: linear-gradient(90deg, #f97316, #fb923c);
        }

        .stat-card.c-violet::before {
            background: linear-gradient(90deg, #8b5cf6, #a78bfa);
        }

        /* ── Stat icon / label helpers ── */
        .stat-icon-teal {
            background: var(--glow);
            color: var(--accent);
        }

        .stat-label-teal {
            background: var(--glow);
            color: var(--accent);
        }

        .stat-icon-cyan {
            background: rgba(6, 182, 212, .12);
            color: #22d3d8;
        }

        .stat-label-cyan {
            background: rgba(6, 182, 212, .10);
            color: #22d3d8;
        }

        .stat-icon-orange {
            background: rgba(249, 115, 22, .12);
            color: #f97316;
        }

        .stat-label-orange {
            background: rgba(249, 115, 22, .10);
            color: #f97316;
        }

        .stat-icon-violet {
            background: rgba(139, 92, 246, .12);
            color: #8b5cf6;
        }

        .stat-label-violet {
            background: rgba(139, 92, 246, .10);
            color: #a78bfa;
        }

        /* ── Filter bar ── */
        .filter-bar {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 14px 18px;
        }

        .filter-input {
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--txt-1);
            border-radius: 12px;
            padding: 9px 14px;
            font-size: 13px;
            font-weight: 600;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
            font-family: "Nunito", sans-serif;
        }

        .filter-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--glow);
        }

        .filter-input::placeholder {
            color: var(--txt-m);
        }

        .filter-select {
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--txt-2);
            border-radius: 12px;
            padding: 9px 36px 9px 14px;
            font-size: 13px;
            font-weight: 600;
            outline: none;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237aafc4' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            transition: border-color .2s;
            font-family: "Nunito", sans-serif;
        }

        .filter-select:focus {
            border-color: var(--accent);
        }

        /* ── Table card ── */
        .table-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
        }

        .table-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-card thead th {
            background: var(--bg);
            color: var(--txt-m);
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: 12px 18px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        .table-card tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }

        .table-card tbody tr:last-child {
            border-bottom: none;
        }

        .table-card tbody tr:hover {
            background: var(--hover-bg);
        }

        .table-card td {
            padding: 13px 18px;
            vertical-align: middle;
        }

        .table-toolbar {
            border-bottom: 1px solid var(--border);
        }

        .table-footer {
            border-top: 1px solid var(--border);
        }

        /* ── Avatars ── */
        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
            font-weight: 700;
            letter-spacing: -.5px;
            overflow: hidden;
        }

        .av-teal {
            background: var(--hover-bg);
            color: var(--accent);
        }

        .av-orange {
            background: rgba(249, 115, 22, .12);
            color: #f97316;
        }

        .av-violet {
            background: rgba(139, 92, 246, .12);
            color: #8b5cf6;
        }

        .av-muted {
            background: var(--border);
            color: var(--txt-m);
        }

        /* ── Role / status badges ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .badge-student {
            background: rgba(6, 182, 212, .12);
            color: #22d3d8;
            border: 1px solid rgba(6, 182, 212, .2);
        }

        .badge-driver {
            background: rgba(249, 115, 22, .12);
            color: #f97316;
            border: 1px solid rgba(249, 115, 22, .2);
        }

        .badge-admin {
            background: rgba(139, 92, 246, .12);
            color: #a78bfa;
            border: 1px solid rgba(139, 92, 246, .2);
        }

        .badge-active {
            background: rgba(16, 185, 129, .12);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, .2);
        }

        .badge-inactive {
            background: var(--border);
            color: var(--txt-m);
            border: 1px solid transparent;
        }

        /* ── Action icon buttons ── */
        .act-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: transparent;
            cursor: pointer;
            font-size: 11px;
            color: var(--txt-2);
            text-decoration: none;
            transition: background .13s, color .13s;
        }

        .act-btn:hover {
            background: var(--hover-bg);
            color: var(--txt-1);
        }

        .act-btn.act-view {
            color: var(--accent);
        }

        .act-btn.act-view:hover {
            background: var(--glow);
        }

        .act-btn.act-warn {
            color: #f97316;
        }

        .act-btn.act-warn:hover {
            background: rgba(249, 115, 22, .1);
        }

        .act-btn.act-green {
            color: #34d399;
        }

        .act-btn.act-green:hover {
            background: rgba(52, 211, 153, .1);
        }

        .act-btn.act-danger {
            color: var(--red);
        }

        .act-btn.act-danger:hover {
            background: rgba(239, 68, 68, .08);
        }

        /* ── Buttons ── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 13px;
            font-size: 13px;
            font-weight: 800;
            background: var(--accent);
            color: #fff;
            border: none;
            cursor: pointer;
            transition: opacity .18s, box-shadow .18s, transform .15s;
            box-shadow: 0 4px 20px var(--glow);
            text-decoration: none;
            font-family: "Nunito", sans-serif;
        }

        .btn-primary:hover {
            opacity: .88;
            box-shadow: 0 8px 28px var(--glow);
            transform: translateY(-1px);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 16px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            background: transparent;
            color: var(--txt-2);
            border: 1px solid var(--border);
            cursor: pointer;
            transition: background .15s, color .15s;
            font-family: "Nunito", sans-serif;
            text-decoration: none;
        }

        .btn-outline:hover {
            background: var(--hover-bg);
            color: var(--txt-1);
        }

        /* ── Pagination buttons ── */
        .page-btn {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid var(--border);
            color: var(--txt-2);
            background: transparent;
            cursor: pointer;
            transition: background .15s, color .15s, border-color .15s;
        }

        .page-btn:hover {
            background: var(--hover-bg);
            color: var(--txt-1);
        }

        .page-btn.active {
            background: var(--hover-bg);
            border-color: var(--accent);
            color: var(--accent);
        }


        /* ── Breadcrumb ── */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: var(--txt-m);
            margin-bottom: 6px;
        }

        .breadcrumb a {
            color: var(--txt-m);
            text-decoration: none;
            transition: color .15s;
        }

        .breadcrumb a:hover {
            color: var(--accent);
        }

        /* ── Filter pill ── */
        .filter-pill {
            background: var(--glow);
            color: var(--accent);
        }

        /* ── Empty state ── */
        #empty-state {
            display: none;
            padding: 60px 20px;
            text-align: center;
        }

        .empty-icon {
            background: var(--hover-bg);
            color: var(--accent);
            width: 52px;
            height: 52px;
            border-radius: 16px;
            font-size: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }

        /* ── Row animation ── */
        @keyframes rowFadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #car-tbody tr {
            animation: rowFadeIn .25s ease both;
        }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .col-phone {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .col-email {
                display: none;
            }

            .col-status {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <main class="flex-1 p-4 md:p-6 overflow-auto">

        {{-- ── Page header ── --}}
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
            <div>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-house"></i></a>
                    <span class="text-[8px]"><i class="fa-solid fa-chevron-right"></i></span>
                    <span style="color:var(--txt-2);font-weight:700;">Cars</span>
                </div>
                <h1 class="font-display font-extrabold text-2xl" style="color:var(--txt-1);">All Cars</h1>
                <p class="text-sm mt-0.5" style="color:var(--txt-m);">{{ $cars->total() ?? 0 }} total cars registered</p>
            </div>
            <a href="{{ route('admin.car.create') }}" class="btn-primary self-start">
                <i class="fa-solid fa-plus text-[13px]"></i> Add Car
            </a>
        </div>



        {{-- ── Table card ── --}}
        <div class="table-card">

            {{-- Toolbar --}}
            <div class="table-toolbar flex items-center justify-between px-5 py-3.5">
                <div class="flex items-center gap-2.5">
                    <span id="result-count" class="text-xs font-bold" style="color:var(--txt-2);">Showing all cars</span>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto min-h-[80vh]">

                <table id="car-table">

                    <thead>
                        <tr>
                            <th style="padding-left:20px;">Car Name</th>
                            <th>Number Plate</th>
                            <th>Type</th>
                            <th>Capacity</th>
                            <th class="col-status">Status</th>
                            <th>Driver</th>
                            <th style="width:90px;"></th>
                        </tr>
                    </thead>

                    <tbody id="car-tbody">

                        @forelse($cars as $car)
                            <tr>

                                {{-- Car Name --}}
                                <td style="padding-left:20px;">
                                    <div class="text-sm font-bold" style="color:var(--txt-1);">
                                        {{ $car->name }}
                                    </div>
                                </td>

                                {{-- Number Plate --}}
                                <td class="text-sm" style="color:var(--txt-2);">
                                    {{ $car->number_plate ?? '–' }}
                                </td>

                                {{-- Type --}}
                                <td>

                                    @if ($car->type == 'bus')
                                        <span class="badge badge-driver">
                                            <i class="fa-solid fa-bus text-[9px]"></i>
                                            Bus
                                        </span>
                                    @else
                                        <span class="badge badge-admin">
                                            <i class="fa-solid fa-van-shuttle text-[9px]"></i>
                                            Hiace
                                        </span>
                                    @endif

                                </td>

                                {{-- Capacity --}}
                                <td class="text-sm" style="color:var(--txt-2);">
                                    {{ $car->capacity ?? '–' }}
                                </td>

                                {{-- Status --}}
                                <td class="col-status">

                                    @if ($car->status)
                                        <span class="badge badge-active">
                                            <i class="fa-solid fa-circle text-[6px]"></i>
                                            Active
                                        </span>
                                    @else
                                        <span class="badge badge-inactive">
                                            <i class="fa-solid fa-circle text-[6px]"></i>
                                            Inactive
                                        </span>
                                    @endif

                                </td>

                                {{-- Driver --}}
                                <td style="padding-left:20px;">
                                    <div class="flex items-center gap-3">
                                        @if (!empty($car->user->photo))
                                            <img src="{{ $car->user->photo }}" alt="{{ $car->user->name }}" class="avatar"
                                                style="object-fit:cover;">
                                        @else
                                            <div class="avatar font-display text-sm"> </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-bold" style="color:var(--txt-1);">
                                                {{ $car->user->name ?? 'Unknown' }}</div>
                                            <div class="text-[11px]" style="color:var(--txt-m);">
                                                {{ $car->user->phone }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td>

                                    <div class="flex items-center justify-center gap-1 pr-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.car.edit', $car->id) }}" class="act-btn" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>


                                        {{-- Toggle Status --}}
                                        @if ($car->status)
                                            <a href="{{ route('admin.car.toggle', ['id' => $car->id, 'status' => $car->status]) }}"
                                                class="act-btn act-warn" title="Deactivate"
                                                onclick="return confirm('Deactivate this car?')">

                                                <i class="fa-solid fa-ban"></i>

                                            </a>
                                        @else
                                            <a href="{{ route('admin.car.toggle', ['id' => $car->id, 'status' => $car->status]) }}"
                                                class="act-btn act-green" title="Activate"
                                                onclick="return confirm('Activate this car?')">

                                                <i class="fa-solid fa-check-circle"></i>

                                            </a>
                                        @endif


                                        {{-- Delete --}}
                                        <a onclick="return confirm('Are you sure?')"
                                            href="{{ route('admin.car.delete', $car->id) }}" class="act-btn act-danger"
                                            title="Delete">

                                            <i class="fa-solid fa-trash-can"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty
                        @endforelse

                    </tbody>

                </table>


                {{-- Empty State --}}
                <div id="empty-state">

                    <div class="empty-icon">
                        <i class="fa-solid fa-car"></i>
                    </div>

                    <div class="text-sm font-bold mb-1" style="color:var(--txt-1);">
                        No cars found
                    </div>

                    <div class="text-xs" style="color:var(--txt-m);">
                        Try adjusting your search or filters
                    </div>

                </div>

            </div>

            {{-- Pagination --}}
            <div class="table-footer flex flex-col sm:flex-row items-center justify-between gap-3 px-5 py-3.5">
                <span class="text-xs font-semibold" style="color:var(--txt-m);">
                    Page {{ $cars->currentPage() ?? 1 }} of {{ $cars->lastPage() ?? 1 }} · {{ $totalcars ?? 0 }}
                    results
                </span>
                <div class="flex items-center gap-1.5">
                    {{-- Prev --}}
                    @if (($cars->currentPage() ?? 1) > 1)
                        <a href="{{ $cars->previousPageUrl() }}" class="page-btn">
                            <i class="fa-solid fa-chevron-left text-[10px]"></i>
                        </a>
                    @else
                        <button class="page-btn opacity-40" disabled>
                            <i class="fa-solid fa-chevron-left text-[10px]"></i>
                        </button>
                    @endif

                    @foreach ($cars->getUrlRange(1, $cars->lastPage() ?? 1) as $page => $url)
                        @if ($page === ($cars->currentPage() ?? 1))
                            <button class="page-btn active">{{ $page }}</button>
                        @elseif($page <= 3 || $page === ($cars->lastPage() ?? 1))
                            <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                        @elseif($page === 4)
                            <span class="text-xs px-1" style="color:var(--txt-m);">…</span>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if ($cars->hasMorePages() ?? false)
                        <a href="{{ $cars->nextPageUrl() }}" class="page-btn">
                            <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </a>
                    @else
                        <button class="page-btn opacity-40" disabled>
                            <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>

    </main>

@endsection

@push('js')
    <script>
        (function() {
            /* ── Filter ── */
            const searchInput = document.getElementById('search-input');
            const roleFilter = document.getElementById('role-filter');
            const statusFilter = document.getElementById('status-filter');
            const resultCount = document.getElementById('result-count');
            const filterPill = document.getElementById('filter-pill');
            const emptyState = document.getElementById('empty-state');
            const tbody = document.getElementById('car-tbody');

            function filtercars() {
                const q = searchInput.value.toLowerCase().trim();
                const role = roleFilter.value;
                const status = statusFilter.value;
                const rows = tbody.querySelectorAll('tr');
                let visible = 0;

                rows.forEach(row => {
                    const match =
                        (!q || row.dataset.name.includes(q) || row.dataset.email.includes(q) || row.dataset
                            .phone.includes(q)) &&
                        (!role || row.dataset.role === role) &&
                        (!status || row.dataset.status === status);

                    row.style.display = match ? '' : 'none';
                    if (match) {
                        row.style.animationDelay = (visible * 0.04) + 's';
                        visible++;
                    }
                });

                resultCount.textContent = visible + (visible === 1 ? ' car' : ' cars') + ' found';
                filterPill.classList.toggle('hidden', !q && !role && !status);
                emptyState.style.display = visible === 0 ? 'block' : 'none';
            }

            searchInput.addEventListener('input', filtercars);
            roleFilter.addEventListener('change', filtercars);
            statusFilter.addEventListener('change', filtercars);

            document.getElementById('btn-reset').addEventListener('click', () => {
                searchInput.value = roleFilter.value = statusFilter.value = '';
                filtercars();
            });



            /* ── Init count ── */
            const total = tbody.querySelectorAll('tr').length;
            resultCount.textContent = 'Showing ' + total + ' car' + (total !== 1 ? 's' : '');
        })();
    </script>
@endpush
