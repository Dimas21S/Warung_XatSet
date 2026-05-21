<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Checkout</title>
</head>

<body class="bg-gray-100 min-h-screen">

<form action="{{ route('konfirmasi.post') }}" method="POST">
@csrf

    {{-- Hidden Input --}}
    <input type="hidden" name="jenis_pengiriman" id="input-jenis" value="antar">
    <input type="hidden" name="metode_pembayaran" id="input-metode">
    <input type="hidden" name="waktu_pengiriman" id="input-waktu">

    <div class="max-w-7xl mx-auto px-4 py-8">

        <!-- GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <!-- KIRI -->
            <div class="flex lg:flex-col gap-3">

                <button type="button"
                    onclick="pilihJenis('antar', this)"
                    class="jenis flex-1 bg-green-700 text-white py-3 rounded-xl font-medium shadow-md transition">
                    Pesan Antar
                </button>

                <button type="button"
                    onclick="pilihJenis('jemput', this)"
                    class="jenis flex-1 bg-white text-gray-700 py-3 rounded-xl font-medium shadow-md transition">
                    Jemput di Warung
                </button>

            </div>

            <!-- TENGAH -->
            <div class="lg:col-span-2 bg-[rgba(220,230,225,1)] p-6 rounded-2xl shadow-md space-y-6">

                <!-- ALAMAT -->
                <div id="section-alamat">

                    <h2 class="text-lg font-bold text-green-900 mb-4">
                        📍 Alamat Pengiriman
                    </h2>

                    <div class="space-y-4">

                        <input type="text"
                            name="alamat"
                            placeholder="Detail Alamat"
                            class="w-full p-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600">

                        <input type="text"
                            name="nama_penerima"
                            placeholder="Nama Penerima"
                            class="w-full p-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600">

                        <input type="text"
                            name="no_telepon"
                            placeholder="Nomor Telepon"
                            class="w-full p-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600">

                    </div>
                </div>

                <!-- WAKTU -->
                <div id="section-waktu">

                    <h2 class="text-lg font-bold text-green-900 mb-4">
                        🚚 Pilih Waktu Pengiriman
                    </h2>

                    <div class="space-y-3">

                        <div onclick="pilihWaktu('07:00', this)"
                            class="waktu p-4 rounded-xl border bg-white hover:border-green-600 cursor-pointer transition">
                            Antar jam 07:00
                        </div>

                        <div onclick="pilihWaktu('09:30', this)"
                            class="waktu p-4 rounded-xl border bg-white hover:border-green-600 cursor-pointer transition">
                            Antar jam 09:30
                        </div>

                        <div onclick="pilihWaktu('13:00', this)"
                            class="waktu p-4 rounded-xl border bg-white hover:border-green-600 cursor-pointer transition">
                            Antar jam 13:00
                        </div>

                        <div onclick="pilihWaktu('15:00', this)"
                            class="waktu p-4 rounded-xl border bg-white hover:border-green-600 cursor-pointer transition">
                            Antar jam 15:00
                        </div>

                    </div>
                </div>

            </div>

            <!-- KANAN -->
            <div class="bg-[rgba(255,250,234,1)] p-6 rounded-2xl shadow-md space-y-6">

                <!-- METODE -->
                <div>

                    <h2 class="text-lg font-bold text-green-900 mb-4">
                        💳 Metode Pembayaran
                    </h2>

                    <div class="space-y-3">

                        <!-- COD -->
                        <button type="button"
                            onclick="pilihMetode('cod', this)"
                            class="metode w-full text-left p-3 rounded-xl border bg-white hover:border-green-600 transition">
                            Cash On Delivery
                        </button>

                        <!-- EWALLET -->
                        <div>

                            <button type="button"
                                onclick="toggleEwallet()"
                                class="w-full flex justify-between items-center p-3 rounded-xl border bg-white hover:border-green-600 transition">

                                <span>E-Wallet</span>

                                <svg id="ewallet-arrow"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 transition-transform"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7"/>

                                </svg>

                            </button>

                            <!-- CONTENT -->
                            <div id="ewallet-content"
                                class="hidden mt-3 space-y-3">

                                <button type="button"
                                    onclick="pilihMetode('dana', this)"
                                    class="metode w-full text-left bg-yellow-100 p-3 rounded-xl border hover:border-green-600 transition">
                                    Dana <br>
                                    <span class="text-sm text-gray-600">
                                        Warung Xatset - 0812345678
                                    </span>
                                </button>

                                <button type="button"
                                    onclick="pilihMetode('ovo', this)"
                                    class="metode w-full text-left bg-violet-100 p-3 rounded-xl border hover:border-green-600 transition">
                                    OVO <br>
                                    <span class="text-sm text-gray-600">
                                        Warung Xatset - 0812345678
                                    </span>
                                </button>

                                <button type="button"
                                    onclick="pilihMetode('gopay', this)"
                                    class="metode w-full text-left bg-green-100 p-3 rounded-xl border hover:border-green-600 transition">
                                    GoPay <br>
                                    <span class="text-sm text-gray-600">
                                        Warung Xatset - 0812345678
                                    </span>
                                </button>

                            </div>
                        </div>

                        <!-- BANK -->
                        <button type="button"
                            onclick="pilihMetode('bank', this)"
                            class="metode w-full text-left p-3 rounded-xl border bg-white hover:border-green-600 transition">
                            Transfer Bank
                        </button>

                    </div>
                </div>

                <!-- RINGKASAN -->
                <div class="bg-white p-5 rounded-2xl border shadow-sm">

                    <h2 class="text-lg font-bold text-green-900 mb-4">
                        Ringkasan Pesanan
                    </h2>

                    @php
                        $subtotal = collect($cart)->sum(fn($item) => $item['harga'] * $item['qty']);
                        $ongkir = 5000;
                        $total = $subtotal + $ongkir;
                    @endphp

                    <div class="space-y-2 text-sm">

                        @foreach($cart as $item)
                        <div class="flex justify-between">
                            <span>{{ $item['nama'] }} x{{ $item['qty'] }}</span>
                            <span>
                                IDR {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}
                            </span>
                        </div>
                        @endforeach

                        <div class="border-t my-3"></div>

                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>IDR {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Ongkir</span>
                            <span>IDR {{ number_format($ongkir, 0, ',', '.') }}</span>
                        </div>

                    </div>

                    <div class="border-t mt-4 pt-4 flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span class="text-red-500">
                            IDR {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="mt-5 w-full bg-green-700 hover:bg-green-800 text-white py-3 rounded-xl font-semibold transition shadow-md">
                        Pesan Sekarang
                    </button>

                </div>

            </div>
        </div>
    </div>

</form>

<script>
function pilihJenis(jenis, btn) {

    document.getElementById('input-jenis').value = jenis;

    document.querySelectorAll('.jenis').forEach(b => {
        b.classList.remove('bg-green-700', 'text-white');
        b.classList.add('bg-white', 'text-gray-700');
    });

    btn.classList.add('bg-green-700', 'text-white');
    btn.classList.remove('bg-white', 'text-gray-700');

    const sectionAlamat = document.getElementById('section-alamat');
    const sectionWaktu = document.getElementById('section-waktu');

    if (jenis === 'jemput') {
        sectionAlamat.classList.add('hidden');
        sectionWaktu.classList.add('hidden');
    } else {
        sectionAlamat.classList.remove('hidden');
        sectionWaktu.classList.remove('hidden');
    }
}

function pilihWaktu(waktu, div) {

    document.getElementById('input-waktu').value = waktu;

    document.querySelectorAll('.waktu').forEach(d => {
        d.classList.remove('border-green-600', 'bg-green-50', 'font-semibold');
    });

    div.classList.add('border-green-600', 'bg-green-50', 'font-semibold');
}

function pilihMetode(metode, btn) {

    document.getElementById('input-metode').value = metode;

    document.querySelectorAll('.metode').forEach(b => {
        b.classList.remove('border-green-600', 'bg-green-50', 'font-semibold');
    });

    btn.classList.add('border-green-600', 'bg-green-50', 'font-semibold');
}

function toggleEwallet() {

    const content = document.getElementById('ewallet-content');
    const arrow = document.getElementById('ewallet-arrow');

    content.classList.toggle('hidden');
    arrow.classList.toggle('rotate-180');
}
</script>

</body>
</html>