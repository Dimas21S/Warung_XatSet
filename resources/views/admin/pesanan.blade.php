<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Pesanan - Warung Xat Set</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdf8f0; }
        .sidebar { width: 220px; min-height: 100vh; background: #fdf8f0; border-right: 1px solid #e8e0d0; }
        .sidebar-link { display: block; padding: 10px 24px; color: #555; font-size: 14px; text-decoration: none; border-radius: 6px; margin: 2px 8px; }
        .sidebar-link:hover { background: #f0ebe0; color: #2d6a4f; }
        .sidebar-link.active { color: #2d6a4f; font-weight: 600; text-decoration: underline; }
        .topbar { background: #2d6a4f; color: white; padding: 14px 28px; font-weight: 600; font-size: 16px; }
        .stat-card { background: white; border-radius: 10px; padding: 16px 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.07); }
        .badge { display: inline-block; padding: 3px 14px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        .badge-yellow { background: #fff3cd; color: #856404; }
        .badge-green { background: #d1f2e1; color: #1a6e3c; }
        .detail-btn { background: #e0e0e0; color: #333; border: none; padding: 5px 16px; border-radius: 6px; font-size: 13px; cursor: pointer; }
        .detail-btn:hover { background: #d0d0d0; }
        .filter-btn { background: #ddd6fe; color: #5b21b6; border: none; padding: 6px 16px; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 4px; }
        .filter-btn:hover { background: #c4b5fd; }
    </style>
</head>
<body>

<div class="flex">

    {{-- SIDEBAR --}}
    <x-sidebar/>

    {{-- MAIN --}}
    <div class="flex-1" style="margin-left: 220px;">

        {{-- Topbar --}}
        <div class="topbar flex justify-end">
            Pesanan
        </div>

        {{-- Content --}}
        <div class="p-6 space-y-6">

            {{-- STAT CARDS --}}
            <div class="grid grid-cols-4 gap-4">
                <div class="stat-card">
                    <p class="text-xs text-gray-500 mb-1">Pesanan Ditahan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pesananDitahan ?? '000' }}pcs</p>
                </div>
                <div class="stat-card">
                    <p class="text-xs text-gray-500 mb-1">Pesanan Diproses</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pesananDiproses ?? '000' }}pcs</p>
                </div>
                <div class="stat-card">
                    <p class="text-xs text-gray-500 mb-1">Pesanan dalam Pengantaran</p>
                    <p class="text-2xl font-bold text-gray-800">Rp{{ $pesananDiantar ?? '000' }}jt</p>
                </div>
                <div class="stat-card">
                    <p class="text-xs text-gray-500 mb-1">Pesanan Selesai</p>
                    <p class="text-2xl font-bold text-gray-800">Rp{{ $pesananSelesai ?? '000' }}jt</p>
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
                    Status
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <button class="filter-btn">
                    Waktu
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

            {{-- TABEL PESANAN --}}
            <div class="bg-gray-100 rounded-xl p-4">

                {{-- Header --}}
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h7"/>
                    </svg>
                    <span class="font-semibold text-gray-700">Tabel Pemesanan</span>
                </div>

                {{-- Kolom Header --}}
                <div class="grid grid-cols-6 text-sm text-gray-500 font-medium pb-2 border-b border-gray-300">
                    <span>ID_Pesanan</span>
                    <span>Nama_Pelanggan</span>
                    <span>Tanggal</span>
                    <span class="text-center">Status Pesanan</span>
                    <span>Harga</span>
                    <span class="text-center">Detail Pesanan</span>
                </div>

                {{-- Rows --}}
                @forelse($pesanan ?? [] as $item)
                    <div class="grid grid-cols-6 text-sm text-gray-700 py-3 border-b border-gray-200 last:border-0 items-center">
                        <span>#{{ $item->id }}</span>
                        <span>{{ $item->nama_penerima ?? '-' }}</span>
                        <span>{{ $item->created_at ?? '-' }}</span>
                        <span class="text-center">
                            @if($item->status === 'pending')
                                <span class="badge badge-yellow">Diproses</span>
                            @elseif($item->status === 'diantar')
                                <span class="badge badge-green">Diantar</span>
                            @else
                                <span class="badge" style="background:#e0e0e0; color:#555;">{{ ucfirst($item->status) }}</span>
                            @endif
                        </span>
                        <span>Rp {{ number_format($item->total, 0, ',', '.') }}</span>
                        <span class="text-center">
                            <a href="#">
                                <button class="detail-btn">Detail</button>
                            </a>
                        </span>
                    </div>
                @empty
                    <div class="grid grid-cols-6 text-sm text-gray-500 py-3 border-b border-gray-200 items-center">
                        <span>#12345</span>
                        <span>Basuki</span>
                        <span>-</span>
                        <span class="text-center"><span class="badge badge-yellow">Diproses</span></span>
                        <span>-</span>
                        <span class="text-center"><button class="detail-btn">Detail</button></span>
                    </div>
                    <div class="grid grid-cols-6 text-sm text-gray-500 py-3 items-center">
                        <span>#12387</span>
                        <span>Basoka</span>
                        <span>-</span>
                        <span class="text-center"><span class="badge badge-green">Diantar</span></span>
                        <span>-</span>
                        <span class="text-center"><button class="detail-btn">Detail</button></span>
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</div>

</body>
</html>