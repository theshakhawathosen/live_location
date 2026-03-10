    <aside id="side-panel" aria-label="Map Settings Panel">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:8px;margin-bottom:2px;">
            <div>
                <div class="panel-title">Map Controls</div>
                <div class="panel-subtitle">Customise what's visible on the map</div>
            </div>
            <button id="panel-close-btn" aria-label="Close panel" title="Close panel"
                style="
            flex-shrink:0;
            width:30px;height:30px;
            border-radius:8px;
            border:1px solid var(--panel-border);
            background:var(--surface-alt);
            color:var(--text-muted);
            display:flex;align-items:center;justify-content:center;
            cursor:pointer;
            font-size:13px;
            transition:background 0.2s,color 0.2s,transform 0.15s;
            margin-top:2px;
        "
                onmouseover="this.style.background='rgba(239,68,68,0.1)';this.style.color='#ef4444';"
                onmouseout="this.style.background='var(--surface-alt)';this.style.color='var(--text-muted)';">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- STATUS -->
        <div class="panel-section-label">Status</div>

        <div class="toggle-row" id="online-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(22,160,103,0.12);">
                    <i class="fa-solid fa-wifi" style="color:var(--accent);"></i>
                </div>
                <div>
                    <div class="toggle-label">User Online</div>
                    <div class="toggle-desc">Broadcast your presence</div>
                </div>
            </div>
            <label class="switch">
                <input type="checkbox" id="showOnline" {{ Auth::user()->show_online ? 'checked' : '' }} />
                <span class="switch-slider"></span>
            </label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(99,102,241,0.12);">
                    <i class="fa-solid fa-bell-slash" style="color:#6366f1;"></i>
                </div>
                <div>
                    <div class="toggle-label">Mute Notifications</div>
                    <div class="toggle-desc">Silence all alerts</div>
                </div>
            </div>
            <label class="switch">
                <input type="checkbox" id="showNotification" {{ Auth::user()->show_notification ? 'checked' : '' }} />
                <span class="switch-slider"></span>
            </label>
        </div>

        <!-- MAP LAYERS -->
        <div class="panel-section-label">Map Layers</div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(22,160,103,0.12);">
                    <i class="fa-solid fa-road" style="color:var(--accent);"></i>
                </div>
                <div>
                    <div class="toggle-label">Show Routes</div>
                    <div class="toggle-desc">Display all DIU routes</div>
                </div>
            </div>
            <label class="switch">
                <input type="checkbox" id="showRoutes" {{ Auth::user()->show_routes ? 'checked' : '' }} />
                <span class="switch-slider"></span>
            </label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(245,158,11,0.12);">
                    <i class="fa-solid fa-bus" style="color:#f59e0b;"></i>
                </div>
                <div>
                    <div class="toggle-label">Show Bus</div>
                    <div class="toggle-desc">Live bus locations</div>
                </div>
            </div>
            <label class="switch">
                <input type="checkbox" id="showBus" {{ Auth::user()->show_bus ? 'checked' : '' }} />
                <span class="switch-slider"></span>
            </label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(59,130,246,0.12);">
                    <i class="fa-solid fa-van-shuttle" style="color:#3b82f6;"></i>
                </div>
                <div>
                    <div class="toggle-label">Show Hiace</div>
                    <div class="toggle-desc">Mini-van live locations</div>
                </div>
            </div>
            <label class="switch">
                <input type="checkbox" id="showHiace" {{ Auth::user()->show_hiace ? 'checked' : '' }} />
                <span class="switch-slider"></span>
            </label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(239,68,68,0.1);">
                    <i class="fa-solid fa-location-dot" style="color:#ef4444;"></i>
                </div>
                <div>
                    <div class="toggle-label">Show Stops</div>
                    <div class="toggle-desc">Bus & hiace stop markers</div>
                </div>
            </div>
            <label class="switch">
                <input type="checkbox" id="showStops" {{ Auth::user()->show_stop ? 'checked' : '' }} />
                <span class="switch-slider"></span>
            </label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(239,68,68,0.1);">
                    <i class="fa-solid fa-flag" style="color:#10b981;"></i>
                </div>
                <div>
                    <div class="toggle-label">Show Campus</div>
                    <div class="toggle-desc">Show campus markers</div>
                </div>
            </div>
            <label class="switch">
                <input type="checkbox" id="showCampus" {{ Auth::user()->show_campus ? 'checked' : '' }} />
                <span class="switch-slider"></span>
            </label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(168,85,247,0.1);">
                    <i class="fa-solid fa-user-group" style="color:#a855f7;"></i>
                </div>
                <div>
                    <div class="toggle-label">Show Students</div>
                    <div class="toggle-desc">Other active students</div>
                </div>
            </div>
            <label class="switch">
                <input type="checkbox" id="showStudents" {{ Auth::user()->show_students ? 'checked' : '' }} />
                <span class="switch-slider"></span>
            </label>
        </div>

        <!-- DISPLAY -->
        <div class="panel-section-label">Display</div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(16,185,129,0.1);">
                    <i class="fa-solid fa-warning" style="color:#f59e0b;"></i>
                </div>
                <div>
                    <div class="toggle-label">High Accuracy</div>
                    <div class="toggle-desc">It may take time </div>
                </div>
            </div>
            <label class="switch">
                <input type="checkbox" id="highAccuracy" {{ Auth::user()->high_accuracy ? 'checked' : '' }} />
                <span class="switch-slider"></span>
            </label>
        </div>

        <div class="toggle-row">
            <div class="toggle-row-left">
                <div class="toggle-icon" style="background:rgba(249,115,22,0.1);">
                    <i class="fa-solid fa-street-view" style="color:#f97316;"></i>
                </div>
                <div>
                    <div class="toggle-label">My Location</div>
                    <div class="toggle-desc">Pin your position on map</div>
                </div>
            </div>
            <label class="switch">
                <input type="checkbox" id="myLocation" {{ Auth::user()->show_mylocation ? 'checked' : '' }} />
                <span class="switch-slider"></span>
            </label>
        </div>

        <!-- Footer -->
        <div
            style="margin-top:auto; padding-top:20px; font-size:0.74rem; color:var(--text-muted); text-align:center; border-top:1px solid var(--panel-border); margin-top:20px; padding-top:14px;">
            <i class="fa-solid fa-map-location-dot" style="color:var(--accent);"></i>
            DIU Routes &mdash; Live Map v1.0<br>
            <span style="font-size:0.68rem; opacity:0.7;">Dhaka International University</span>
        </div>
    </aside>
