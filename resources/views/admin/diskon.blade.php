<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Diskon - Warung Xat Set</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdf8f0; }
        .sidebar { width: 220px; min-height: 100vh; background: #fdf8f0; border-right: 1px solid #e8e0d0; }
        .sidebar-link { display: block; padding: 10px 24px; color: #555; font-size: 14px; text-decoration: none; border-radius: 6px; margin: 2px 8px; }
        .sidebar-link:hover { background: #f0ebe0; color: #2d6a4f; }
        .sidebar-link.active { color: #2d6a4f; font-weight: 600; text-decoration: underline; }
        .topbar { background: #2d6a4f; color: white; padding: 14px 28px; font-weight: 600; font-size: 16px; }
        .stat-card { background: #7c3aed; border-radius: 10px; padding: 16px 20px; color: white; min-width: 160px; }
        .filter-btn { background: #ddd6fe; color: #5b21b6; border: none; padding: 6px 16px; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; }
        .filter-btn:hover { background: #c4b5fd; }
        .status-aktif { color: #16a34a; font-weight: 600; font-size: 13px; }
        .status-nonaktif { color: #dc2626; font-weight: 600; font-size: 13px; }
    </style>
</head>
<body>

<div class="flex">

    {{-- SIDEBAR --}}
    <div class="sidebar flex flex-col justify-between" style="position: fixed; top:0; left:0; height:100vh;">
        <div>
            <div class="flex items-center gap-2 px-4 py-4 border-b border-gray-200">
                <img src="{{ asset('image/Logo-Xatset.png') }}" alt="Logo" class="h-10 w-10 rounded-full object-cover">
                <span class="font-bold text-green-800 text-sm leading-tight">WARUNG XAT SET</span>
            </div>
            <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link">Dashboard</a>
                <a href="{{ route('admin.pesanan') }}" class="sidebar-link">Pesanan</a>
                <a href="{{ route('admin.pengiriman') }}" class="sidebar-link">Pengiriman</a>
                <a href="{{ route('admin.produk') }}" class="sidebar-link">Produk</a>
                <a href="{{ route('admin.keuangan') }}" class="sidebar-link">Keuangan</a>
                <a href="{{ route('admin.identitas') }}" class="sidebar-link">Identitas</a>
                <a href="{{ route('admin.diskon') }}" class="sidebar-link active">Diskon</a>
            </nav>
        </div>
        <div class="flex items-center gap-3 px-4 py-4 border-t border-gray-200">
            <div class="w-9 h-9 rounded-full bg-green-800 flex items-center justify-center text-white text-sm font-bold">A</div>
            <span class="text-sm font-medium text-gray-700">Admin</span>
        </div>
    </div>

    {{-- MAIN --}}
    <div class="flex-1" style="margin-left: 220px;">

        {{-- Topbar --}}
        <div class="topbar flex justify-end">
            Diskon
        </div>

        {{-- Content --}}
        <div class="p-6 space-y-6">

            {{-- STAT CARDS --}}
            <div class="flex gap-4">
                <div class="stat-card">
                    <p class="text-xs text-purple-200 mb-1">Diskon Aktif</p>
                    <p class="text-2xl font-bold">{{ $diskonAktif ?? '000' }}pcs</p>
                </div>
                <div class="stat-card">
                    <p class="text-xs text-purple-200 mb-1">Total Diskon</p>
                    <p class="text-2xl font-bold">{{ $totalDiskon ?? '000' }}pcs</p>
                </div>
                <div class="stat-card">
                    <p class="text-xs text-purple-200 mb-1">P Pengguna</p>
                    <p class="text-2xl font-bold">Rp{{ $totalPengguna ?? '000' }}jt</p>
                </div>
            </div>

            {{-- FILTER --}}
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>
                    <span class="font-medium text-gray-700">Filter :</span>
                </div>

                <button class="filter-btn">
                    ??????????
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <button class="filter-btn">
                    Status
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Search --}}
                <div class="flex-1 flex items-center bg-white border border-gray-300 rounded-lg px-3 py-1.5 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input type="text" placeholder="Cari" class="flex-1 text-sm outline-none bg-transparent text-gray-700 placeholder-gray-400">
                </div>
            </div>

            {{-- TABEL DISKON --}}
            <div class="bg-gray-100 rounded-xl p-4">

                {{-- Header --}}
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h7"/>
                    </svg>
                    <span class="font-semibold text-gray-700">Tabel Diskon</span>
                </div>

                {{-- Kolom Header --}}
                <div class="grid grid-cols-7 text-sm text-gray-500 font-medium pb-2 border-b border-gray-300">
                    <span class="col-span-1">Nama_Diskon</span>
                    <span class="col-span-1">Kode_Diskon</span>
                    <span class="col-span-1">Tipe</span>
                    <span class="col-span-1">Nilai</span>
                    <span class="col-span-2">Produk</span>
                    <span class="col-span-1">Status</span>
                </div>

                {{-- Rows --}}
                @forelse($diskon ?? [] as $item)
                    <div class="grid grid-cols-7 text-sm text-gray-700 py-3 border-b border-gray-200 last:border-0 items-start">
                        <span class="col-span-1">{{ $item->nama_diskon }}</span>
                        <span class="col-span-1">{{ $item->kode_diskon }}</span>
                        <span class="col-span-1">{{ $item->tipe }}</span>
                        <span class="col-span-1">{{ $item->nilai }}</span>
                        <span class="col-span-2">{{ $item->produk ?? '-' }}</span>
                        <span class="col-span-1 {{ $item->status === 'aktif' ? 'status-aktif' : 'status-nonaktif' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </div>
                @empty
                    <div class="grid grid-cols-7 text-sm text-gray-600 py-3 border-b border-gray-200 items-start">
                        <span class="col-span-1">Diskon Baik</span>
                        <span class="col-span-1">Aku123</span>
                        <span class="col-span-1">Potongan 10k</span>
                        <span class="col-span-1">5000</span>
                        <span class="col-span-2">Ikan Nila Gulai Kuning</span>
                        <span class="col-span-1 status-aktif">Aktif</span>
                    </div>
                    <div class="grid grid-cols-7 text-sm text-gray-600 py-3 items-start">
                        <span class="col-span-1">Diskon Cantik</span>
                        <span class="col-span-1">Kamu321</span>
                        <span class="col-span-1">Potongan 5k</span>
                        <span class="col-span-1">7000</span>
                        <span class="col-span-2">Ikan Nila Gulai Merah</span>
                        <span class="col-span-1 status-aktif">Aktif</span>
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</div>

</body>
</html>