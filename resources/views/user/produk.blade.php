<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>Beranda</title>
</head>

<body class="">
    <nav class="bg-[rgba(255,250,234,1)] shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{ asset('image/Logo-Xatset.png') }}" alt="Logo" class="h-10 w-auto object-contain">
                    <span class="ml-2 text-xl font-bold text-green-800">WarungXatSet</span>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('beranda') }}" class="text-gray-600 hover:text-green-700 font-medium transition">Beranda</a>
                    <a href="#" class="text-gray-600 hover:text-green-700 font-medium transition">Menu</a>
                    <a href="#" class="text-gray-600 hover:text-green-700 font-medium transition">Keranjang</a>
                    <a href="#" class="text-gray-600 hover:text-green-700 font-medium transition">Pesanan</a>
                    <a href="#" class="text-gray-600 hover:text-green-700 font-medium transition">Profil</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg font-medium transition">
                            Logout
                        </button>
                    </form>
                </div>

                <!-- Tombol Hamburger (HP) -->
                <div class="md:hidden">
                    <button id="hamburger" type="button" class="text-gray-600 hover:text-green-700 focus:outline-none">
                        <svg id="icon-open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg id="icon-close" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Menu Mobile -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 px-4 pb-4">
            <div class="flex flex-col space-y-3 pt-3">
                <a href="{{ route('beranda') }}" class="text-gray-600 hover:text-green-700 font-medium py-2 transition">Beranda</a>
                <a href="#" class="text-gray-600 hover:text-green-700 font-medium py-2 transition">Menu</a>
                <a href="#" class="text-gray-600 hover:text-green-700 font-medium py-2 transition">Transaksi</a>
                <a href="#" class="text-gray-600 hover:text-green-700 font-medium py-2 transition">Laporan</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg font-medium transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div id="notif" class="fixed top-5 right-5 z-50 hidden px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 text-white">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path id="notif-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    <span id="notif-message"></span>
</div>

    <div class="py-4">
        <div class="flex items-center gap-2 px-4">
            <svg xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke-width="1.5" 
                stroke="currentColor" 
                class="w-5 h-5 text-red-700">
                <path stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>

            <p class="text-lg font-bold text-red-700">
                Pilih sesuai lokasi anda
            </p>
        </div>
        <div class="flex gap-4 mt-4 px-4">
            <button class="bg-[rgba(234,234,234,1)] hover:bg-green-800 text-black hover:text-white shadow-[0_8px_15px_rgba(0,0,0,0.15)] px-4 py-2 rounded-lg font-medium transition">
                Rao
            </button>
            <button class="bg-[rgba(234,234,234,1)] hover:bg-green-800 text-black hover:text-white shadow-[0_8px_15px_rgba(0,0,0,0.15)] px-4 py-2 rounded-lg font-medium transition">
                Lubuk Sikapang
            </button>
        </div>
    </div>

    {{-- Card Produk Unggulan --}}
    <div class="px-4 py-4">

        <!-- CONTAINER SCROLL -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @forelse ($menu as $item)
                <!-- CARD 1 -->
                    <input type="hidden" name="menu_id" value="{{ $item->id }}">
                    <div class="bg-[#E9E3D3] p-3 md:p-4 rounded-2xl shadow-md w-48 md:w-64 flex-shrink-0">
                        <img src="{{ asset('image/makanan.jpg') }}" class="w-full h-32 md:h-40 object-cover rounded-xl">
                        
                        <h2 class="mt-2 md:mt-3 text-sm md:text-lg font-semibold text-green-900">
                            {{ $item->nama_menu }}
                        </h2>

                        <p class="text-red-500 font-semibold text-sm md:text-base mt-1">
                            IDR {{ number_format($item->harga, 0, ',', '.') }}
                        </p>

                        <button class="mt-3 w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded-xl text-sm md:text-base" 
                        onclick="tambahKeranjang({{ $item->id }})">
                            + Keranjang
                        </button>
                    </div>
            @empty
                <p class="text-gray-500 col-span-full text-center">Belum ada menu tersedia.</p>
            @endforelse
        </div>
    </div>

    <div class="px-4 py-3">
        {{ $menu->links() }}
    </div>

    {{-- <footer class="bg-[rgba(10,143,43,1)] text-white mt-10 rounded-t-xl overflow-hidden">

        <!-- TOP -->
        <div class="flex items-center justify-between p-6">

            <!-- KIRI -->
            <div class="flex items-center gap-4">
                <img src="{{ asset('image/Logo-Xatset.png') }}" 
                    class="w-25 h-25 rounded-full object-cover">

                <div>
                    <h2 class="font-bold text-lg">Warung Xatset</h2>
                    <p class="text-sm text-green-100 max-w-md">
                        Solusi praktis untuk kebutuhan masak sehari-hari. Lengkap, praktis, dan higienis untuk keluarga Indonesia.
                    </p>
                </div>
            </div>

            <!-- KANAN (ICON) -->
            <img src="{{ asset('image/icon-instagram.png') }}" alt="Sosial Media" class="w-10 h-10 object-contain">

        </div>

        <!-- GARIS -->
        <div class="bg-[rgba(249,249,249,0.25)] px-6 py-1 font-semibold text-sm">
            Kontak
        </div>

        <!-- KONTAK -->
        <div class="px-6 py-4 text-sm space-y-1">
            <p>0813-7413-2172</p>
            <p>uviatulhumairah@gmail.com</p>
            <p>Rau, Pasaman, Sumatera Barat</p>
        </div>

        <!-- GARIS -->
        <div class="bg-[rgba(249,249,249,0.25)] px-6 py-1 font-semibold text-sm">
            Jam Operasional
        </div>

        <!-- JAM -->
        <div class="px-6 py-4 text-sm space-y-1">
            <p>Senin - Jum’at: 08:00 - 22:00</p>
            <p>Sabtu - Jum’at: 08:00 - 18:00</p>
            <p>Minggu: Tutup</p>
        </div>

        <!-- FOOTER BAWAH -->
        <div class="border-t border-green-500 text-center py-3 text-sm text-green-200">
            2024 Warung Xatset. All right reserved.
        </div>

    </footer> --}}

</body>
<script>
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('icon-open');
    const iconClose = document.getElementById('icon-close');

    hamburger.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        iconOpen.classList.toggle('hidden');
        iconClose.classList.toggle('hidden');
    });
</script>
<script>
function tambahKeranjang(menuId) {
    fetch('{{ route('produk.post') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ menu_id: menuId })
    })
    .then(res => res.json())
    .then(data => {
        showNotif(data.message, data.status);
    })
    .catch(() => {
        showNotif('Terjadi kesalahan!', 'error');
    });
}

function showNotif(message, status) {
    const notif = document.getElementById('notif');
    const notifMessage = document.getElementById('notif-message');
    const notifIcon = document.getElementById('notif-icon');

    // Ganti warna sesuai status
    notif.classList.remove('bg-green-500', 'bg-red-500');
    if (status === 'success') {
        notif.classList.add('bg-green-500');
        notifIcon.setAttribute('d', 'M5 13l4 4L19 7'); // icon centang
    } else {
        notif.classList.add('bg-red-500');
        notifIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12'); // icon silang
    }

    notifMessage.textContent = message;
    notif.classList.remove('hidden');

    // Auto hilang setelah 3 detik
    setTimeout(() => {
        notif.style.transition = 'opacity 0.5s';
        notif.style.opacity = '0';
        setTimeout(() => {
            notif.classList.add('hidden');
            notif.style.opacity = '1';
        }, 500);
    }, 3000);
}
</script>

</html>