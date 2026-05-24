<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Produk - Warung Xat Set</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdf8f0; }
        .sidebar { width: 220px; min-height: 100vh; background: #fdf8f0; border-right: 1px solid #e8e0d0; }
        .sidebar-link { display: block; padding: 10px 24px; color: #555; font-size: 14px; text-decoration: none; border-radius: 6px; margin: 2px 8px; }
        .sidebar-link:hover { background: #f0ebe0; color: #2d6a4f; }
        .sidebar-link.active { color: #2d6a4f; font-weight: 600; text-decoration: underline; }
        .topbar { background: #2d6a4f; color: white; padding: 14px 28px; font-weight: 600; font-size: 16px; }
        .stat-card { background: #1a2744; border-radius: 10px; padding: 16px 20px; color: white; }
        .filter-btn { background: #ddd6fe; color: #5b21b6; border: none; padding: 6px 16px; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; }
        .filter-btn:hover { background: #c4b5fd; }
        .tambah-btn { background: #f5c842; color: #333; border: none; padding: 6px 18px; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; }
        .tambah-btn:hover { background: #e6b800; }
        .badge-kategori { background: #d97706; color: white; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 500; text-align: center; }
        .status-ada { color: #16a34a; font-weight: 600; font-size: 13px; }
        .status-habis { color: #dc2626; font-weight: 600; font-size: 13px; }
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
            Produk
        </div>

        {{-- Content --}}
        <div class="p-6 space-y-6">

            {{-- STAT CARDS --}}
            <div class="flex gap-4">
                <div class="stat-card min-w-[160px]">
                    <p class="text-xs text-gray-300 mb-1">Total Produk</p>
                    <p class="text-2xl font-bold">{{ $totalProduk ?? '000' }}pcs</p>
                </div>
                <div class="stat-card min-w-[160px]">
                    <p class="text-xs text-gray-300 mb-1">Total Terjual</p>
                    <p class="text-2xl font-bold">{{ $totalTerjual ?? '000' }}pcs</p>
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
                    Semua
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

            {{-- TABEL PRODUK --}}
            <div class="bg-gray-100 rounded-xl p-4">

                {{-- Header --}}
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h7"/>
                        </svg>
                        <span class="font-semibold text-gray-700">Daftar</span>
                    </div>
                    <a href="#">
                        <button class="tambah-btn">Tambah</button>
                    </a>
                </div>

                {{-- Kolom Header --}}
                <div class="grid grid-cols-8 text-sm text-gray-500 font-medium pb-2 border-b border-gray-300">
                    <span>No</span>
                    <span class="col-span-2">Nama_Produk</span>
                    <span>Id_produk</span>
                    <span>Kategori</span>
                    <span>Stok</span>
                    <span>Status</span>
                    <span>Foto</span>
                </div>

                {{-- Rows --}}
                @forelse($produk ?? [] as $index => $item)
                    <div class="grid grid-cols-8 text-sm text-gray-700 py-3 border-b border-gray-200 last:border-0 items-center">
                        <span>{{ $index + 1 }}</span>
                        <span class="col-span-2">{{ $item->nama_menu }}</span>
                        <span>#{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</span>
                        <span>
                            <span class="badge-kategori">{{ $item->kategori ?? 'Aneka Ikan' }}</span>
                        </span>
                        <span>{{ $item->stok ?? 100 }}</span>
                        <span class="{{ $item->is_available ? 'status-ada' : 'status-habis' }}">
                            {{ $item->is_available ? 'Ada' : 'Habis' }}
                        </span>
                        <span class="flex gap-1">
                            @if($item->foto)
                                <img src="{{ asset('image/' . $item->foto) }}" class="w-12 h-12 object-cover rounded-lg">
                            @else
                                <img src="{{ asset('image/makanan.jpg') }}" class="w-12 h-12 object-cover rounded-lg">
                                <img src="{{ asset('image/makanan.jpg') }}" class="w-12 h-12 object-cover rounded-lg">
                            @endif
                        </span>
                    </div>
                @empty
                    <div class="grid grid-cols-8 text-sm text-gray-500 py-3 items-center">
                        <span>1</span>
                        <span class="col-span-2">Ikan Nila Gulai Kuning</span>
                        <span>#0001</span>
                        <span><span class="badge-kategori">Aneka Ikan</span></span>
                        <span>100</span>
                        <span class="status-ada">Ada</span>
                        <span class="flex gap-1">
                            <img src="{{ asset('image/makanan.jpg') }}" class="w-12 h-12 object-cover rounded-lg">
                            <img src="{{ asset('image/makanan.jpg') }}" class="w-12 h-12 object-cover rounded-lg">
                        </span>
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</div>

</body>
</html>