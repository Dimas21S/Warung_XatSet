<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Beranda</title>
</head>

<body class="">
    {{-- Navbar --}}
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

    {{-- Produk Unggulan --}}
    <div class="flex items-center justify-between pb-2 px-4">
        <div>
            <h1 class="text-2xl font-bold text-black pt-2 pl-4">Masak Praktis Anti Ribet</h1>
            <p class="text-black pt-2 pl-4">Buat kamu yang tinggal di daerah Rao dan Lubuk Sikapang kami hadir sebagai solusi cerdas masak modern, 
            bahan masakan segar, <br> sudah dibersihkan dan siap olah.</p>
        </div>
        <img src="{{ asset('image/icon-alat-makan.png') }}" alt="Icon Alat Makan" class="w-50 h-25 object-contain">
    </div>

    {{-- Card Produk Unggulan --}}
    <div class="px-4 py-4 bg-[rgba(9,125,76,1)]">
        
        <h1 class="text-lg md:text-xl font-bold text-white pb-3">
            Produk Unggulan
        </h1>

        <!-- CONTAINER SCROLL -->
        <div class="flex gap-4 overflow-x-auto pb-2">

            <!-- CARD 1 -->
            <div class="bg-[#E9E3D3] p-3 md:p-4 rounded-2xl shadow-md w-48 md:w-64 flex-shrink-0">
                <img src="{{ asset('image/makanan.jpg') }}" class="w-full h-32 md:h-40 object-cover rounded-xl">
                
                <h2 class="mt-2 md:mt-3 text-sm md:text-lg font-semibold text-green-900">
                    Ikan Nila Gulai Kuning
                </h2>

                <p class="text-red-500 font-semibold text-sm md:text-base mt-1">
                    IDR -------
                </p>

                <button class="mt-3 w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded-xl text-sm md:text-base">
                    + Keranjang
                </button>
            </div>

            <!-- CARD 2 -->
            <div class="bg-[#E9E3D3] p-3 md:p-4 rounded-2xl shadow-md w-48 md:w-64 flex-shrink-0">
                <img src="{{ asset('image/makanan.jpg') }}" class="w-full h-32 md:h-40 object-cover rounded-xl">
                
                <h2 class="mt-2 md:mt-3 text-sm md:text-lg font-semibold text-green-900">
                    Ayam Goreng
                </h2>

                <p class="text-red-500 font-semibold text-sm md:text-base mt-1">
                    IDR -------
                </p>

                <button class="mt-3 w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded-xl text-sm md:text-base">
                    + Keranjang
                </button>
            </div>

            <!-- CARD lihat lebih banyak --> 
            <button class="flex flex-col items-center justify-center gap-2 text-white hover:text-black transition border border-white hover:border-black p-4 rounded-2xl shadow-md w=64"> 
                <!-- ICON --> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"> 
                    <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /> 
                </svg> <!-- TEXT --> 
                <span class="font-medium">Lihat Lebih Banyak</span> 
            </button>

        </div>
    </div>

    {{-- Kategori Produk --}}
    <div>
        <div class="flex items-center justify-center mt-4 py-2 px-4 bg-[rgba(220,212,182,1)]">
            <h1 class="text-lg font-bold text-gray-800 text-center">Kategori Produk</h1>
        </div>

            <!-- GRID -->
        <div class="py-6 grid grid-cols-4 md:flex md:justify-center gap-4 md:gap-6 px-4">
            
            <div class="bg-[rgba(254,214,132,1)] w-20 h-20 rounded-lg"></div>
            <div class="bg-[rgba(254,214,132,1)] w-20 h-20 rounded-lg"></div>
            <div class="bg-[rgba(254,214,132,1)] w-20 h-20 rounded-lg"></div>
            <div class="bg-[rgba(254,214,132,1)] w-20 h-20 rounded-lg"></div>
            <div class="bg-[rgba(254,214,132,1)] w-20 h-20 rounded-lg"></div>
            <div class="bg-[rgba(254,214,132,1)] w-20 h-20 rounded-lg"></div>
            <div class="bg-[rgba(254,214,132,1)] w-20 h-20 rounded-lg"></div>
            <div class="bg-[rgba(254,214,132,1)] w-20 h-20 rounded-lg"></div>

        </div>
    </div>

    {{-- Alasan Memilih Warung Xatset --}}
    <div>
        <h2 class="text-xl pl-4 pb-2">Mengapa memilih Warung Xatset?</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-4">

            <!-- CARD 1 -->
            <div class="bg-[rgba(244,234,195,1)] border border-gray-400 p-4 rounded-xl flex justify-between items-center">
                
                <div>
                    <h1 class="font-semibold text-gray-800">Efisiensi Waktu</h1>
                    <p class="text-sm text-gray-600">
                        Bahan sudah dibersihkan dan siap masak, hemat waktu persiapan.
                    </p>
                </div>

                <img src="{{ asset('image/icon-jam.png') }}" alt="Efisiensi Waktu" class="w-10 h-10">
            </div>

            <!-- CARD 2 -->
            <div class="bg-[rgba(244,234,195,1)] border border-gray-400 p-4 rounded-xl flex justify-between items-center">
                
                <div>
                    <h1 class="font-semibold text-gray-800">Kualitas Terjamin</h1>
                    <p class="text-sm text-gray-600">
                        Bahan segar pilihan, diproses secara higienis.
                    </p>
                </div>

                <img src="{{ asset('image/icon-centang.png') }}" alt="warung xatset" class="w-10 h-10">
            </div>

            <!-- CARD 3 -->
            <div class="bg-[rgba(244,234,195,1)] border border-gray-400 p-4 rounded-xl flex justify-between items-center">
                
                <div>
                    <h1 class="font-semibold text-gray-800">Pengiriman Terjadwal</h1>
                    <p class="text-sm text-gray-600">
                        Sistem kloter untuk pengiriman yang lebih efisien.
                    </p>
                </div>

                <img src="{{ asset('image/icon-sepeda.png') }}" alt="Efisiensi Waktu" class="w-10 h-10">
            </div>

        </div>
    </div>

    {{-- CTA --}}
    <div class="flex items-center justify-center gap-6 py-4 px-6 bg-[rgba(10,143,43,1)] rounded-xl mt-6">
        <!-- TEXT -->
        <div class="text-center">
            <h1 class="text-lg font-bold text-white">
                SIAP MEMASAK LEBIH PRAKTIS?
            </h1>
            <p class="text-white text-sm">
                Pesan sekarang dan nikmati kemudahan memasak
            </p>
        </div>

        <!-- BUTTON -->
        <button class="bg-white hover:bg-gray-100 text-green-700 px-6 py-2 rounded-lg font-medium transition">
            Pesan Sekarang
        </button>
    </div>

    {{-- Footer --}}
    <footer class="bg-[rgba(10,143,43,1)] text-white mt-10 rounded-t-xl overflow-hidden">

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

    </footer>

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

</html>