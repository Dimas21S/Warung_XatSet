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
        <div>
            <div class="mt-2 w-full max-w-md px-4">
                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 has-[input:focus-within]:outline-2 has-[input:focus-within]:-outline-offset-2 has-[input:focus-within]:outline-indigo-600">
                <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6">$</div>
                <input id="price" type="text" name="price" placeholder="0.00" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                <div class="grid shrink-0 grid-cols-1 focus-within:relative">
                    <select id="currency" name="currency" aria-label="Currency" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pr-7 pl-3 text-base text-gray-500 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <option>USD</option>
                    <option>CAD</option>
                    <option>EUR</option>
                    </select>
                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                    <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center mt-6 px-2 gap-4">
        @forelse ($cart as $index => $item )
            <div class="max-w-lg w-full flex border border-gray-200 rounded-xl overflow-hidden bg-[rgba(217,234,226,1)] mt-6" id="card-{{ $index }}">
                {{-- Gambar kiri --}}
                <div class="w-40 h-40 flex-shrink-0 bg-cover bg-center p-4 m-4"
                    style="background-image: url('{{ asset('image/makanan.jpg') }}')"
                    title="Ikan Nila Gulai Kuning">
                </div>
                {{-- Konten kanan --}}
                <div class="p-4 flex flex-col justify-between gap-3 flex-1">
                    <div>
                        <span class="inline-flex items-center gap-1 text-xs text-gray-500">Lauk Pauk</span>
                        <h2 class="text-base font-semibold text-gray-900 mt-1">{{ $item['nama'] }}</h2>
                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                            Ikan nila segar dimasak dengan bumbu gulai khas Padang dan santan kental.
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex-1">
                            <p class="text-sm text-red-500 font-semibold mt-0.5">IDR {{ number_format($item['harga'], 0, ',', '.') }}</p>
                        </div>
                        {{-- Qty control --}}
                        <div class="inline-flex border border-black rounded-lg overflow-hidden">
                                {{-- Tombol Kurang --}}
                            <button onclick="kurangQty({{ $index }}, this)"
                                    data-index="{{ $index }}"
                                    class="w-8 h-8 bg-transparent hover:bg-white text-black font-bold transition-colors">
                                −
                            </button>
                            <span id="qty-{{ $index }}" class="w-8 h-8 flex items-center justify-center text-sm font-medium border-x border-gray-200 qty-val">
                                {{ $item['qty'] }}
                            </span>
                                {{-- Tombol Tambah --}}
                            <button onclick="tambahQty({{ $index }}, this)"
                                    data-index="{{ $index }}"
                                    class="w-8 h-8 bg-transparent hover:bg-white text-black font-bold transition-colors">
                                +
                            </button>
                        </div>
                    </div>
                            {{-- Tombol Hapus --}}
                    {{-- <form action="{{ route('keranjang.hapus') }}" method="POST">
                        @csrf
                        <input type="hidden" name="index" value="{{ $index }}">
                        <button type="submit" class="text-red-500 hover:text-red-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form> --}}

                </div>
            </div>
        @empty
            <div class="text-center py-12 text-gray-400 text-sm">
                Keranjang kosong.
            </div>
        @endforelse
    </div>

    {{-- Hitung total --}}
    @php
        $total = collect($cart)->sum(fn($item) => $item['harga'] * $item['qty']);
    @endphp

    <button class="fixed bottom-5 right-5 bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-lg font-medium transition" onclick="window.location.href='{{ route('konfirmasi') }}'">
        Total: <span id="total-harga">IDR {{ number_format($total, 0, ',', '.') }}</span>
    </button>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function tambahQty(index, btn) {
        fetch('{{ route('keranjang.tambah') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ index: index })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                // Update angka qty
                document.getElementById(`qty-${index}`).textContent = data.qty;

                // Update total harga
                document.getElementById('total-harga').textContent = 'IDR ' + formatRupiah(data.total);
            }
        });
    }

    function kurangQty(index, btn) {
        fetch('{{ route('keranjang.kurang') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ index: index })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'hapus') {
                // Hapus card dari tampilan
                document.getElementById(`card-${index}`).remove();
            } else {
                // Update angka qty
                document.getElementById(`qty-${index}`).textContent = data.qty;
            }

            // Update total harga
            document.getElementById('total-harga').textContent = 'IDR ' + formatRupiah(data.total);
        });
    }

    function hapusItem(index, btn) {
        fetch('{{ route('keranjang.hapus') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ index: index })
        })
        .then(res => res.json())
        .then(data => {
            // Hapus card dari tampilan
            document.getElementById(`card-${index}`).remove();

            // Update total harga
            document.getElementById('total-harga').textContent = 'IDR ' + formatRupiah(data.total);
        });
    }

    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID');
    }
</script>
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
        function adj(btn, delta) {
            const wrap = btn.closest('.inline-flex');
            const val = wrap.querySelector('.qty-val');
            val.textContent = Math.max(0, parseInt(val.textContent) + delta);
        }
    </script>

</html>