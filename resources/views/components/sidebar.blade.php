{{-- SIDEBAR --}}
<div class="sidebar flex flex-col justify-between" style="position: fixed; top:0; left:0; height:100vh;">
    <div>
        {{-- Logo --}}
        <div class="flex items-center gap-2 px-4 py-4 border-b border-gray-200">
            <img src="{{ asset('image/Logo-Xatset.png') }}" alt="Logo" class="h-10 w-10 rounded-full object-cover">
            <span class="font-bold text-green-800 text-sm leading-tight">WARUNG XAT SET</span>
        </div>

        {{-- Nav --}}
        <nav class="mt-4">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
               Dashboard
            </a>
            <a href="{{ route('admin.pesanan') }}"
               class="sidebar-link {{ request()->routeIs('admin.pesanan*') ? 'active' : '' }}">
               Pesanan
            </a>
            <a href="{{ route('admin.pengiriman') }}"
               class="sidebar-link {{ request()->routeIs('admin.pengiriman*') ? 'active' : '' }}">
               Pengiriman
            </a>
            <a href="{{ route('admin.produk') }}"
               class="sidebar-link {{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
               Produk
            </a>
            <a href="{{ route('admin.keuangan') }}"
               class="sidebar-link {{ request()->routeIs('admin.keuangan*') ? 'active' : '' }}">
               Keuangan
            </a>
            <a href="{{ route('admin.identitas') }}"
               class="sidebar-link {{ request()->routeIs('admin.identitas*') ? 'active' : '' }}">
               Identitas
            </a>
            <a href="#"
               class="sidebar-link {{ request()->routeIs('admin.diskon*') ? 'active' : '' }}">
               Diskon
            </a>
        </nav>
    </div>

    {{-- Admin --}}
    <div class="flex items-center gap-3 px-4 py-4 border-t border-gray-200">
        <div class="w-9 h-9 rounded-full bg-green-800 flex items-center justify-center text-white text-sm font-bold">A</div>
        <span class="text-sm font-medium text-gray-700">Admin</span>
    </div>
</div>