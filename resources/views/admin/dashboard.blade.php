<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Dashboard - Warung Xat Set</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdf8f0; }
        .sidebar { width: 220px; min-height: 100vh; background: #fdf8f0; border-right: 1px solid #e8e0d0; }
        .sidebar-link { display: block; padding: 10px 24px; color: #555; font-size: 14px; text-decoration: none; border-radius: 6px; margin: 2px 8px; }
        .sidebar-link:hover { background: #f0ebe0; color: #2d6a4f; }
        .sidebar-link.active { color: #2d6a4f; font-weight: 600; text-decoration: underline; }
        .topbar { background: #2d6a4f; color: white; padding: 14px 28px; font-weight: 600; font-size: 16px; }
        .stat-card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.07); }
        .stat-icon-green { background: #e8f5ee; color: #2d6a4f; border-radius: 8px; padding: 10px; }
        .stat-icon-yellow { background: #fff8e1; color: #e6a817; border-radius: 8px; padding: 10px; }
        .stat-icon-blue { background: #e8f0fe; color: #4a6fa5; border-radius: 8px; padding: 10px; }
        .chart-card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.07); }
        .badge { display: inline-block; padding: 3px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        .badge-yellow { background: #fff3cd; color: #856404; }
        .badge-green { background: #d1f2e1; color: #1a6e3c; }
        .detail-btn { background: #e0e0e0; color: #333; border: none; padding: 5px 14px; border-radius: 6px; font-size: 13px; cursor: pointer; }
        .detail-btn:hover { background: #d0d0d0; }
        .checkbox-fake { width: 18px; height: 18px; border: 2px solid #ccc; border-radius: 4px; display: inline-block; }
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
            Dashboard
        </div>

        {{-- Content --}}
        <div class="p-6 space-y-6">

            {{-- STAT CARDS --}}
            <div class="grid grid-cols-3 gap-4">

                {{-- Total Penjualan --}}
                <div class="stat-card flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Total Penjualan</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalPenjualan ?? '000' }}pcs</p>
                        <p class="text-xs text-green-600 mt-1">Hari ini</p>
                    </div>
                    <div class="stat-icon-green">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                </div>

                {{-- Total Pesanan --}}
                <div class="stat-card flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Total Pesanan</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalPesanan ?? '000' }}pcs</p>
                        <p class="text-xs text-green-600 mt-1">Hari ini</p>
                    </div>
                    <div class="stat-icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>

                {{-- Total Keuntungan --}}
                <div class="stat-card flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Total Keuntungan</p>
                        <p class="text-2xl font-bold text-gray-800">Rp{{ $totalKeuntungan ?? '000' }}jt</p>
                        <p class="text-xs text-green-600 mt-1">Hari ini</p>
                    </div>
                    <div class="stat-icon-yellow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>

            </div>

            {{-- CHART + PRODUK TERLARIS --}}
            <div class="grid grid-cols-3 gap-4">

                {{-- Statistika Penjualan --}}
                <div class="chart-card col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <span class="font-semibold text-gray-700">Statistika Penjualan</span>
                        </div>
                        <div class="flex gap-1">
                            <button class="w-7 h-7 bg-gray-200 rounded text-gray-600 font-bold text-sm hover:bg-gray-300">Tahun</button>
                            <button class="w-7 h-7 bg-gray-200 rounded text-gray-600 font-bold text-sm hover:bg-gray-300">Bulan</button>
                            <button class="w-7 h-7 bg-gray-200 rounded text-gray-600 font-bold text-sm hover:bg-gray-300">Hari</button>
                        </div>
                    </div>
                    <canvas id="chartPenjualan" height="120"></canvas>
                </div>

                {{-- Produk Terlaris --}}
                <div class="chart-card">
                    <div class="flex items-center gap-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                        <span class="font-semibold text-gray-700">Produk Terlaris</span>
                    </div>
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-gray-500 text-xs">
                                <th class="text-left pb-2">Nama</th>
                                <th class="text-left pb-2">Penjualan</th>
                                <th class="pb-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produkTerlaris ?? [] as $produk)
                                <tr class="border-t border-gray-100">
                                    <td class="py-2 text-blue-700">{{ $produk->nama }}</td>
                                    <td class="py-2 text-gray-700">{{ $produk->total_terjual }}</td>
                                </tr>
                            @empty
                                <tr class="border-t border-gray-100">
                                    <td class="py-2 text-gray-400">Nama</td>
                                    <td class="py-2 text-gray-400">Penjualan</td>
                                    <td class="py-2"><span class="checkbox-fake"></span></td>
                                </tr>
                                <tr class="border-t border-gray-100">
                                    <td class="py-2 text-gray-400">-</td>
                                    <td class="py-2 text-gray-400">-</td>
                                    <td class="py-2"><span class="checkbox-fake"></span></td>
                                </tr>
                                <tr class="border-t border-gray-100">
                                    <td class="py-2 text-gray-400">-</td>
                                    <td class="py-2 text-gray-400">-</td>
                                    <td class="py-2"><span class="checkbox-fake"></span></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

            {{-- TABEL PESANAN --}}
            <div class="chart-card">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span class="font-semibold text-gray-700">Grafik Pemasukan</span>
                    </div>
                    <a href="{{ route('admin.pesanan') }}" class="text-sm text-green-600 hover:underline">Tampilkan Semua</a>
                </div>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-500 text-xs border-b border-gray-200">
                            <th class="text-left pb-2 font-medium">ID_Pesanan</th>
                            <th class="text-left pb-2 font-medium">Nama_Pelanggan</th>
                            <th class="text-left pb-2 font-medium">Status</th>
                            <th class="text-left pb-2 font-medium">Detail Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesananTerbaru ?? [] as $pesanan)
                            <tr class="border-t border-gray-100">
                                <td class="py-3 text-gray-700">#{{ $pesanan->id }}</td>
                                <td class="py-3 text-gray-700">{{ $pesanan->nama_penerima }}</td>
                                <td class="py-3">
                                    @if($pesanan->status === 'pending')
                                        <span class="badge badge-yellow">Diproses</span>
                                    @elseif($pesanan->status === 'diantar')
                                        <span class="badge badge-green">Diantar</span>
                                    @else
                                        <span class="badge" style="background:#e0e0e0; color:#555;">{{ ucfirst($pesanan->status) }}</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <a href="#">
                                        <button class="detail-btn">Detail</button>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="border-t border-gray-100">
                                <td class="py-3 text-gray-400">#12345</td>
                                <td class="py-3 text-gray-400">Basuki</td>
                                <td class="py-3"><span class="badge badge-yellow">Diproses</span></td>
                                <td class="py-3"><button class="detail-btn">Detail</button></td>
                            </tr>
                            <tr class="border-t border-gray-100">
                                <td class="py-3 text-gray-400">#12387</td>
                                <td class="py-3 text-gray-400">Basoka</td>
                                <td class="py-3"><span class="badge badge-green">Diantar</span></td>
                                <td class="py-3"><button class="detail-btn">Detail</button></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('chartPenjualan').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                data: {!! json_encode($chartValues) !!},
                backgroundColor: 'rgba(74,144,217,0.7)',
                borderColor: '#4a90d9',
                borderWidth: 1,
                borderRadius: 6,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 } } },
                y: { grid: { color: '#f0f0f0' }, ticks: { font: { size: 11 } }, beginAtZero: true }
            }
        }
    });
</script>

</body>
</html>