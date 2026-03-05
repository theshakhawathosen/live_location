 <aside id="sidebar" class="w-60 flex-shrink-0 border-r border-theme flex flex-col z-50">
     <!-- Brand -->
     <div class="flex items-center gap-3 px-5 py-5 border-b border-theme">
         <div class="w-9 h-9 rounded-xl accent-bg-glow brand-icon border flex items-center justify-center text-sm">
             <i class="fa-solid fa-bus-simple"></i>
         </div>
         <span class="font-display font-bold text-lg text-white">DIU<span class="brand-name-accent">Admin</span></span>
     </div>

     <!-- Nav -->
     <nav class="flex-1 overflow-y-auto py-4 px-2 flex flex-col gap-0.5">
         <a href="{{ route('admin.dashboard') }}"
             class="{{ request()->routeIs('admin.dashboard') ? 'sb-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/5 transition-colors">
             <i class="fa-solid fa-gauge-high w-4 text-center sidebar-icon-active"></i><span>Dashboard</span>
         </a>

         <!-- Users submenu -->
         <button onclick="toggleSub('sub-users', this)"
             class="w-full {{ request()->routeIs('user.index') || request()->routeIs('user.create') ? 'sb-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold text-slate-400 hover:bg-white/5 hover:text-slate-200 transition-colors">
             <i class="fa-solid fa-users w-4 text-center"></i><span class="flex-1 text-left">Users</span>
             <i class="fa-solid fa-chevron-down text-[10px] chevron transition-transform"></i>
         </button>
         <div class="sb-sub pl-7 {{ request()->routeIs('user.index') || request()->routeIs('user.create') ? 'open' : '' }}"
             id="sub-users">
             <a href="{{ route('user.index') }}"
                 class="sub-link flex items-center gap-2 px-3 {{ request()->routeIs('user.index') ? 'bg-white/5 text-[var(--accent)]' : 'text-slate-400' }} py-2 text-xs  rounded-lg hover:bg-white/5 transition-colors"><i
                     class="fa-solid fa-list w-3"></i> All Users</a>
             <a href="{{ route('user.create') }}"
                 class="sub-link flex items-center gap-2 px-3 py-2 text-xs  rounded-lg hover:bg-white/5 transition-colors {{ request()->routeIs('user.create') ? 'bg-white/5 text-[var(--accent)]' : 'text-slate-400' }}"><i
                     class="fa-solid fa-user-plus w-3"></i> Add User</a>
         </div>

         <!-- Cars submenu -->
         <button onclick="toggleSub('sub-cars', this)"
             class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold text-slate-400 hover:bg-white/5 hover:text-slate-200 transition-colors">
             <i class="fa-solid fa-bus w-4 text-center"></i><span class="flex-1 text-left">Cars / Buses</span>
             <i class="fa-solid fa-chevron-down text-[10px] chevron transition-transform"></i>
         </button>
         <div class="sb-sub pl-7" id="sub-cars">
             <a href="#"
                 class="sub-link flex items-center gap-2 px-3 py-2 text-xs text-slate-400 rounded-lg hover:bg-white/5 transition-colors"><i
                     class="fa-solid fa-list w-3"></i> All Cars</a>
             <a href="#"
                 class="sub-link flex items-center gap-2 px-3 py-2 text-xs text-slate-400 rounded-lg hover:bg-white/5 transition-colors"><i
                     class="fa-solid fa-plus w-3"></i> Add Car</a>
         </div>

         <div class="my-2 border-t border-theme"></div>

         <a href="#"
             class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold text-slate-400 hover:bg-white/5 hover:text-slate-200 transition-colors">
             <i class="fa-solid fa-gear w-4 text-center"></i><span>Settings</span>
         </a>
         <a href="#"
             class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold text-slate-400 hover:bg-white/5 hover:text-slate-200 transition-colors">
             <i class="fa-solid fa-user-circle w-4 text-center"></i><span>Profile</span>
         </a>
     </nav>

     <!-- Logout -->
     <div class="p-3 border-t border-theme">
         <button onclick="if (confirm('Logout?')) location.href = '#';"
             class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold text-red-400 hover:bg-red-500/10 transition-colors">
             <i class="fa-solid fa-right-from-bracket w-4 text-center"></i><span>Logout</span>
         </button>
     </div>
 </aside>
