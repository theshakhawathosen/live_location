        /* ── Theme ── */
        (function() {
            const saved = localStorage.getItem('diu-theme') || 'light';
            document.documentElement.className = saved;
        })();

        const themeBtn = document.getElementById('theme-btn');
        themeBtn.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            document.documentElement.classList.toggle('light', !isDark);
            localStorage.setItem('diu-theme', isDark ? 'dark' : 'light');
        });

        /* ── Dropdowns ── */
        function setupDropdown(btnId, dropId) {
            const btn = document.getElementById(btnId);
            const drop = document.getElementById(dropId);

            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const isOpen = drop.classList.contains('open');
                // close all
                document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('open'));
                if (!isOpen) drop.classList.add('open');
            });
        }

        setupDropdown('notif-btn', 'notif-dropdown');
        setupDropdown('user-btn', 'user-dropdown');

        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('open'));
        });
        document.querySelectorAll('.dropdown').forEach(d => d.addEventListener('click', e => e.stopPropagation()));

        /* ── Notification badge count ── */
        const unreadCount = 3;
        const badge = document.getElementById('notif-badge');
        if (unreadCount === 0) badge.style.display = 'none';

        /* ── Side Panel ── */
        const panelToggle = document.getElementById('panel-toggle');
        const sidePanel = document.getElementById('side-panel');

        panelToggle.addEventListener('click', () => {
            sidePanel.classList.toggle('open');
            panelToggle.classList.toggle('panel-open');
        });

        const panelCloseBtn = document.getElementById('panel-close-btn');
        panelCloseBtn.addEventListener('click', () => {
            sidePanel.classList.remove('open');
            panelToggle.classList.remove('panel-open');
        });


        function showToast(type, label) {
            const container = document.getElementById('toast-container');
            const t = document.createElement('div');
            t.className = `toast ${type}`;
            const iconName = type === 'success' ? 'fa-check' : 'fa-xmark';
            t.innerHTML = `
                <div class="toast-check"><i class="fa-solid ${iconName}"></i></div>
                <div class="toast-label">${label}</div>
            `;
            container.appendChild(t);
            setTimeout(() => {
                t.classList.add('removing');
                setTimeout(() => t.remove(), 250);
            }, 2500);
        }


        // Init online row state
        document.getElementById('online-row').classList.add('online-active');

        // Resize map on window resize
        window.addEventListener('resize', () => map.invalidateSize());

        // Invalidate size after panel transition
        sidePanel.addEventListener('transitionend', () => map.invalidateSize());