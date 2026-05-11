 <!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Beranda</title>
</head>

<body class="">
    <div class="bg-gray-100 min-h-screen py-10">

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- KIRI -->
        <div class="flex flex-col gap-4">
            <button class="bg-green-700 text-white py-3 rounded-lg font-medium">
                Pesan Antar
            </button>
            <button class="bg-gray-200 text-gray-700 py-3 rounded-lg font-medium">
                Jemput di Warung
            </button>
        </div>

        <!-- TENGAH -->
        <div class="md:col-span-2 bg-[rgba(220,230,225,1)] p-6 rounded-xl space-y-6">

            <!-- Alamat -->
            <div>
                <h2 class="font-semibold mb-3">📍 Alamat Pengiriman</h2>

                <input type="text" placeholder="Detail Alamat"
                    class="w-full mb-3 p-3 rounded-lg border border-gray-300">

                <input type="text" placeholder="Nama Penerima"
                    class="w-full mb-3 p-3 rounded-lg border border-gray-300">

                <input type="text" placeholder="Nomor Telepon"
                    class="w-full p-3 rounded-lg border border-gray-300">
            </div>

            <!-- Waktu -->
            <div>
                <h2 class="font-semibold mb-3">🚚 Pilih Waktu Pengiriman</h2>

                <div class="space-y-3">
                    <div class="p-3 border rounded-lg bg-white">Antar jam 07:00</div>
                    <div class="p-3 border rounded-lg bg-white">Antar jam 09:30</div>
                    <div class="p-3 border rounded-lg bg-white">Antar jam 13:00</div>
                    <div class="p-3 border rounded-lg bg-white">Antar jam 15:00</div>
                </div>
            </div>

        </div>

        <!-- KANAN -->
        <div class="bg-[rgba(255,250,234,1)] p-2 rounded-xl space-y-6">

            <!-- Metode -->
            <div>
                <h2 class="font-semibold mb-3">💳 Metode Pembayaran</h2>

                <div class="space-y-2 text-sm">
                    <p>Cash On Delivery</p>
                </div>
                    {{-- E-wallet Dropdown --}}
                <div>
                    <button onclick="toggleEwallet()" 
                            class="w-full flex justify-between items-center py-1 font-medium">
                        <span>E-wallet</span>
                        <svg id="ewallet-arrow" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Isi Dropdown --}}
                    <div id="ewallet-content" class="hidden mt-2 space-y-2">
                        <button onclick="pilihMetode(this)"
                                class="metode w-full text-left bg-yellow-100 p-2 rounded-lg border border-gray-300 hover:border-green-600 transition">
                            Dana: Warung Xatset <br> 0812345678
                        </button>
                        <button onclick="pilihMetode(this)"
                                class="metode w-full text-left bg-blue-100 p-2 rounded-lg border border-gray-300 hover:border-green-600 transition">
                            OVO: Warung Xatset <br> 0812345678
                        </button>
                        <button onclick="pilihMetode(this)"
                                class="metode w-full text-left bg-green-100 p-2 rounded-lg border border-gray-300 hover:border-green-600 transition">
                            GoPay: Warung Xatset <br> 0812345678
                        </button>
                    </div>
                </div>

            </div>

            <!-- Ringkasan -->
            <div class="bg-white p-2 rounded-lg border">
                <h2 class="font-semibold mb-3">Ringkasan Pesanan</h2>

                @php
                    $subtotal = collect($cart)->sum(fn($item) => $item['harga'] * $item['qty']);
                    $ongkir = 5000;
                    $total = $subtotal + $ongkir;
                @endphp

                <div class="text-sm space-y-1">
                    
                    {{-- List item --}}
                    @foreach($cart as $item)
                        <div class="flex justify-between text-gray-600">
                            <span>{{ $item['nama'] }} x{{ $item['qty'] }}</span>
                            <span>IDR {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach

                    <div class="border-t my-2"></div>

                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>IDR {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Diskon</span>
                        <span>IDR 0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Ongkir</span>
                        <span>IDR {{ number_format($ongkir, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="border-t mt-3 pt-3 flex justify-between font-bold">
                    <span>Total</span>
                    <span class="text-red-500">IDR {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>

        </div>

    </div>

</div>
    

    

    

<script>
    function toggleEwallet() {
        const content = document.getElementById('ewallet-content');
        const arrow = document.getElementById('ewallet-arrow');
        content.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }

    function pilihMetode(btn) {
        // Hapus style terpilih dari semua button
        document.querySelectorAll('.metode').forEach(b => {
            b.classList.remove('border-green-600', 'bg-green-50', 'font-semibold');
            b.classList.add('border-gray-300');
        });

        // Tandai button yang dipilih
        btn.classList.add('border-green-600', 'bg-green-50', 'font-semibold');
        btn.classList.remove('border-gray-300');
    }
</script>
</body>
</html>