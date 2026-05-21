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
    <x-navbar/>

    <div class="py-4">

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
                    {{-- Tombol Hapus --}}
                    <button 
                        onclick="hapusItem({{ $index }}, this)"
                        type="button"
                        class="text-red-500 hover:text-red-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="w-5 h-5" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke="currentColor">

                            <path stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" 
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>

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