<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Pengiriman - Warung Xat Set</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdf8f0; }
        .sidebar { width: 220px; min-height: 100vh; background: #fdf8f0; border-right: 1px solid #e8e0d0; }
        .sidebar-link { display: block; padding: 10px 24px; color: #555; font-size: 14px; text-decoration: none; border-radius: 6px; margin: 2px 8px; }
        .sidebar-link:hover { background: #f0ebe0; color: #2d6a4f; }
        .sidebar-link.active { color: #2d6a4f; font-weight: 600; text-decoration: underline; }
        .topbar { background: #2d6a4f; color: white; padding: 14px 28px; font-weight: 600; font-size: 16px; }
    </style>
</head>
<body>

<div class="flex">

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
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link">Dashboard</a>
                <a href="#" class="sidebar-link">Pesanan</a>
                <a href="#" class="sidebar-link active">Pengiriman</a>
                <a href="#" class="sidebar-link">Produk</a>
                <a href="#" class="sidebar-link">Keuangan</a>
                <a href="#" class="sidebar-link">Identitas</a>
                <a href="#" class="sidebar-link">Diskon</a>
            </nav>
        </div>

        {{-- Admin --}}
        <div class="flex items-center gap-3 px-4 py-4 border-t border-gray-200">
            <div class="w-9 h-9 rounded-full bg-green-800 flex items-center justify-center text-white text-sm font-bold">A</div>
            <span class="text-sm font-medium text-gray-700">Admin</span>
        </div>
    </div>

    {{-- MAIN --}}
    <div class="flex-1" style="margin-left: 220px;">

        {{-- Topbar --}}
        <div class="topbar flex justify-end">
            Pengiriman
        </div>

        {{-- Content --}}
        <div class="p-6">

            <h1 class="text-xl font-bold text-gray-800 mb-6">Jadwal Pengiriman</h1>

            {{-- Tabel --}}
            <div class="bg-gray-100 rounded-xl p-4">

                {{-- Header Tabel --}}
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h7"/>
                        </svg>
                        <span class="font-semibold text-gray-700">Daftar</span>
                    </div>
                    <button class="bg-yellow-200 hover:bg-yellow-300 text-gray-700 font-medium px-5 py-1.5 rounded-lg text-sm transition">
                        Edit
                    </button>
                </div>

                {{-- Kolom Header --}}
                <div class="grid grid-cols-5 text-sm text-gray-500 font-medium pb-2 border-b border-gray-300">
                    <span>ID_Pesanan</span>
                    <span>Nama_Pelanggan</span>
                    <span>Waktu Mulai</span>
                    <span>Waktu Selesai</span>
                    <span>Harga</span>
                </div>

                {{-- Rows --}}
                @forelse($pesanan ?? [] as $item)
                    <div class="grid grid-cols-5 text-sm text-gray-700 py-3 border-b border-gray-200 last:border-0">
                        <span>#{{ $item->id }}</span>
                        <span>{{ $item->nama_penerima ?? '-' }}</span>
                        <span>{{ $item->waktu_pengiriman ?? '-' }}</span>
                        <span>{{ $item->waktu_selesai ?? '-' }}</span>
                        <span>Rp {{ number_format($item->total, 0, ',', '.') }}</span>
                    </div>
                @empty
                    {{-- Data dummy sesuai gambar --}}
                    <div class="grid grid-cols-5 text-sm text-gray-700 py-3 border-b border-gray-200">
                        <span>#12345</span>
                        <span>Basuki</span>
                        <span>07:00</span>
                        <span>09:00</span>
                        <span>Rp 0000</span>
                    </div>
                    <div class="grid grid-cols-5 text-sm text-gray-700 py-3">
                        <span>#12387</span>
                        <span>Basoka</span>
                        <span>09:00</span>
                        <span>13:00</span>
                        <span>Rp 00000</span>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</div>

</body>
</html>