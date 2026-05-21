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
                    <a href="{{ route('beranda') }}" class="text-gray-600 hover:text-green-700 font-medium transition pb-1 {{ request()->routeIs('beranda') ? 'border-b-2 border-black' : '' }}">Beranda</a>
                    <a href="{{ route('produk') }}" class="text-gray-600 hover:text-green-700 font-medium transition pb-1 {{ request()->routeIs('produk') ? 'border-b-2 border-black' : '' }}">Menu</a>
                    <a href="{{ route('keranjang') }}" class="text-gray-600 hover:text-green-700 font-medium transition pb-1 {{ request()->routeIs('keranjang') ? 'border-b-2 border-black' : '' }}">Keranjang</a>
                    <a href="{{ route('beranda') }}" class="text-gray-600 hover:text-green-700 font-medium transition pb-1 {{ request()->routeIs('beranda') ? 'border-b-2 border-black' : '' }}">Pesanan</a>
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
                <a href="{{ route('produk') }}" class="text-gray-600 hover:text-green-700 font-medium py-2 transition">Menu</a>
                <a href="{{ route('keranjang') }}" class="text-gray-600 hover:text-green-700 font-medium py-2 transition">Keranjang</a>
                <a href="{{ route('beranda') }}" class="text-gray-600 hover:text-green-700 font-medium py-2 transition">Pesanan</a>
            </div>
        </div>
    </nav>