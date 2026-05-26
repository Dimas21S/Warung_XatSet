<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <form method="GET" action="{{ route('admin.pesanan') }}" class="flex items-center gap-4">

                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>
                    <span class="font-medium text-gray-700">Filter :</span>
                </div>

                {{-- Filter Status --}}
                <select name="status" onchange="this.form.submit()"
                        class="filter-btn appearance-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="pending"     {{ request('status') === 'pending'     ? 'selected' : '' }}>Diproses</option>
                    <option value="ditahan"     {{ request('status') === 'ditahan'     ? 'selected' : '' }}>Ditahan</option>
                    <option value="pengiriman"  {{ request('status') === 'pengiriman'  ? 'selected' : '' }}>Pengiriman</option>
                    <option value="selesai"     {{ request('status') === 'selesai'     ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan"  {{ request('status') === 'dibatalkan'  ? 'selected' : '' }}>Dibatalkan</option>
                </select>

                {{-- Filter Waktu --}}
                <select name="waktu" onchange="this.form.submit()"
                        class="filter-btn appearance-none cursor-pointer">
                    <option value="">Semua Waktu</option>
                    <option value="hari"   {{ request('waktu') === 'hari'   ? 'selected' : '' }}>Hari Ini</option>
                    <option value="minggu" {{ request('waktu') === 'minggu' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="bulan"  {{ request('waktu') === 'bulan'  ? 'selected' : '' }}>Bulan Ini</option>
                </select>

                {{-- Search --}}
                <div class="flex-1 flex items-center bg-white border border-gray-300 rounded-lg px-3 py-1.5 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input type="text" name="cari" placeholder="Cari nama pelanggan..."
                        value="{{ request('cari') }}"
                        class="flex-1 text-sm outline-none bg-transparent text-gray-700 placeholder-gray-400">
                </div>

                {{-- Tombol Reset --}}
                @if(request('status') || request('waktu') || request('cari'))
                    <a href="{{ route('admin.pesanan') }}"
                    class="text-xs text-red-500 hover:text-red-700 transition whitespace-nowrap">
                        Reset Filter
                    </a>
                @endif

            </form>

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
                    <span>Nama_Pelanggan</span>
                    <span>Pengiriman</span>
                    <span>Tanggal</span>
                    <span>Harga</span>
                    <span class="text-center">Status Pesanan</span>
                    <span class="text-center">Detail Pesanan</span>
                </div>

                {{-- Rows --}}
                @forelse($pesanan ?? [] as $item)
                    <div class="grid grid-cols-6 text-sm text-gray-700 py-3 border-b border-gray-200 last:border-0 items-center">
                        {{-- <span>#{{ $item->id }}</span> --}}
                        <span>{{ $item->nama_penerima ?? '-' }}</span>
                        <span>{{ $item->waktu_pengiriman ?? '-' }}</span>
                        <span>{{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}</span>
                        {{-- <span class="text-center">
                            @if($item->status === 'pending')
                                <span class="badge badge-yellow">Diproses</span>
                            @elseif($item->status === 'diantar')
                                <span class="badge badge-green">Diantar</span>
                            @else
                                <span class="badge" style="background:#e0e0e0; color:#555;">{{ ucfirst($item->status) }}</span>
                            @endif
                        </span> --}}
                        <span>Rp {{ number_format($item->total, 0, ',', '.') }}</span>
                        <span class="text-center flex justify-center">
                            <span id="badge-{{ $item->id }}" class="badge
                                @if($item->status === 'pending') badge-yellow
                                @elseif($item->status === 'diantar') badge-green
                                @else bg-gray-100 text-gray-600
                                @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </span>
                        <span class="text-center">
                                <button type="button"onclick="bukaDetail({{ $item->id }})" class="detail-btn">Detail</button>
                        </span>
                    </div>
                @empty
                    <div class="col-span-6 text-center py-6 text-gray-400 text-sm">
                        Belum ada pesanan.
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</div>

{{-- Notif --}}
<div id="notif-admin" class="fixed top-5 right-5 z-50 hidden px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 text-white"
     style="transition: opacity 0.5s ease;">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path id="notif-admin-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    <span id="notif-admin-message"></span>
</div>


{{-- Popup Detail Pesanan --}}
<div id="popup-detail" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    
    {{-- Overlay --}}
    <div onclick="tutupDetail()" class="absolute inset-0 bg-opacity-40"></div>

    {{-- Card --}}
    <div id="popup-card" class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 p-6 z-10"
         style="transform: scale(0.8); transition: transform 0.3s ease; opacity: 0;">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-gray-800 text-lg">Detail Pesanan</h2>
            <button onclick="tutupDetail()" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Info Pesanan --}}
        <div class="space-y-1 text-sm text-gray-600 mb-4">
            <p><span class="font-medium">ID Pesanan:</span> <span id="detail-id"></span></p>
            <p><span class="font-medium">Nama:</span> <span id="detail-nama"></span></p>
            <p><span class="font-medium">No. Telepon:</span> <span id="detail-telepon"></span></p>
            <p><span class="font-medium">Alamat:</span> <span id="detail-alamat"></span></p>
            <p><span class="font-medium">Waktu:</span> <span id="detail-waktu"></span></p>
            <p><span class="font-medium">Metode Bayar:</span> <span id="detail-metode"></span></p>
        </div>

        {{-- List Item --}}
        <div class="border border-gray-200 rounded-lg overflow-hidden mb-4">
            <div id="detail-items" class="divide-y divide-gray-100"></div>
            <div class="border-t border-dashed border-gray-300 mx-4"></div>
            <div class="px-4 py-3 text-sm space-y-1">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span id="detail-subtotal"></span>
                </div>
                <div class="flex justify-between">
                    <span>Ongkir</span>
                    <span id="detail-ongkir"></span>
                </div>
                <div class="flex justify-between font-bold">
                    <span>Total</span>
                    <span id="detail-total"></span>
                </div>
            </div>
        </div>

        {{-- Dropdown Status --}}
        <div class="mb-4">
            <label class="text-sm font-medium text-gray-700 mb-1 block">Ubah Status</label>
            <select id="select-status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-green-600">
            </select>
        </div>

        {{-- Tombol Simpan --}}
        <button onclick="simpanStatus()"
                class="w-full bg-green-700 hover:bg-green-800 text-white py-2 rounded-lg font-medium transition">
            Simpan Status
        </button>

    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
let currentOrderId = null;

const statusTunai = [
    { value: 'proses',      label: 'Proses' },
    { value: 'pengiriman',  label: 'Pengiriman' },
    { value: 'selesai',     label: 'Selesai' },
    { value: 'dibatalkan',  label: 'Dibatalkan' },
];

const statusTransfer = [
    { value: 'ditahan',     label: 'Ditahan' },
    { value: 'proses',      label: 'Proses' },
    { value: 'pengiriman',  label: 'Pengiriman' },
    { value: 'selesai',     label: 'Selesai' },
    { value: 'dibatalkan',  label: 'Dibatalkan' },
];

function bukaDetail(id) {
    currentOrderId = id;

    fetch(`/admin/pesanan/${id}/detail`)
        .then(res => res.json())
        .then(order => {

            // Isi info pesanan
            document.getElementById('detail-id').textContent       = '#' + order.id;
            document.getElementById('detail-nama').textContent     = order.nama_penerima ?? '-';
            document.getElementById('detail-telepon').textContent  = order.no_telepon ?? '-';
            document.getElementById('detail-alamat').textContent   = order.alamat ?? '-';
            document.getElementById('detail-waktu').textContent    = order.waktu_pengiriman ?? '-';
            document.getElementById('detail-metode').textContent   = order.metode_pembayaran;
            document.getElementById('detail-subtotal').textContent = 'Rp ' + formatRupiah(order.subtotal);
            document.getElementById('detail-ongkir').textContent   = 'Rp ' + formatRupiah(order.ongkir);
            document.getElementById('detail-total').textContent    = 'Rp ' + formatRupiah(order.total);

            // Isi list item
            const itemsEl = document.getElementById('detail-items');
            itemsEl.innerHTML = '';
            order.items.forEach((item, index) => {
                itemsEl.innerHTML += `
                    <div class="flex justify-between items-center px-4 py-3 text-sm text-gray-700">
                        <span class="flex-1">${index + 1}. ${item.nama}</span>
                        <span class="w-8 text-center">${item.qty}</span>
                        <span class="w-24 text-right">Rp ${formatRupiah(item.subtotal)}</span>
                    </div>
                `;
            });

            // Isi dropdown status sesuai metode pembayaran
            const select = document.getElementById('select-status');
            select.innerHTML = '';
            const metode = order.metode_pembayaran.toLowerCase();
            const options = (metode === 'cod' || metode === 'tunai') ? statusTunai : statusTransfer;

            options.forEach(opt => {
                const selected = opt.value === order.status ? 'selected' : '';
                select.innerHTML += `<option value="${opt.value}" ${selected}>${opt.label}</option>`;
            });

            // Tampilkan popup
            const popup = document.getElementById('popup-detail');
            const card  = document.getElementById('popup-card');
            popup.classList.remove('hidden');
            setTimeout(() => {
                card.style.transform = 'scale(1)';
                card.style.opacity   = '1';
            }, 10);
        });
}

function tutupDetail() {
    const popup = document.getElementById('popup-detail');
    const card  = document.getElementById('popup-card');

    card.style.transform = 'scale(0.8)';
    card.style.opacity   = '0';
    setTimeout(() => {
        popup.classList.add('hidden');
    }, 300);
}

function simpanStatus() {
    const status = document.getElementById('select-status').value;

    fetch(`/admin/pesanan/${currentOrderId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ status: status })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            tutupDetail();

            // Update badge
            const badge = document.getElementById(`badge-${currentOrderId}`);
            if (badge) {
                const warna = {
                    'proses'     : 'badge-yellow',
                    'pengiriman' : 'bg-blue-100 text-blue-700',
                    'selesai'    : 'badge-green',
                    'dibatalkan' : 'bg-red-100 text-red-700',
                    'ditahan'    : 'bg-gray-100 text-gray-600',
                };
                badge.className = `badge ${warna[status] ?? 'bg-gray-100 text-gray-600'}`;
                badge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
            }

            // Tampilkan notif
            showNotifAdmin('Status berhasil diubah!', 'success');
        }
    });
}

function showNotifAdmin(message, status) {
    const notif   = document.getElementById('notif-admin');
    const icon    = document.getElementById('notif-admin-icon');
    const msgEl   = document.getElementById('notif-admin-message');

    notif.classList.remove('bg-green-500', 'bg-red-500');
    if (status === 'success') {
        notif.classList.add('bg-green-500');
        icon.setAttribute('d', 'M5 13l4 4L19 7');
    } else {
        notif.classList.add('bg-red-500');
        icon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
    }

    msgEl.textContent = message;
    notif.classList.remove('hidden');
    notif.style.opacity = '1';

    setTimeout(() => {
        notif.style.opacity = '0';
        setTimeout(() => notif.classList.add('hidden'), 500);
    }, 3000);
}

function formatRupiah(angka) {
    return Number(angka).toLocaleString('id-ID');
}
</script>
</body>
</html>