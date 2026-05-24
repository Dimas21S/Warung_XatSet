<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Checkout</title>
</head>

<body class="bg-gray-100 min-h-screen">

<form id="form-konfirmasi" action="{{ route('konfirmasi.post') }}" method="POST">
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
                    <button type="button" onclick="tampilKonfirmasi()"
                        class="mt-5 w-full bg-green-700 hover:bg-green-800 text-white py-3 rounded-xl font-semibold transition shadow-md">
                        Pesan Sekarang
                    </button>

                </div>

            </div>
        </div>
    </div>

</form>

    {{-- Popup Konfirmasi --}}
    <div id="popup-konfirmasi" class="fixed inset-0 z-50 flex items-center justify-center hidden"
        style="transition: opacity 0.3s ease;">
        <div id="popup-konfirmasi-card" class="bg-white rounded-2xl p-8 flex flex-col items-center text-center max-w-xs w-full mx-4 shadow-2xl"
            style="transform: scale(0.8); transition: transform 0.3s ease;">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-green-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>

            <p class="text-gray-800 font-bold text-lg mb-2">Konfirmasi Pesanan</p>
            <p class="text-gray-500 text-sm mb-6">Apakah Anda yakin ingin memesan?</p>

            <div class="flex gap-3 w-full">
                <button onclick="batalKonfirmasi()"
                        class="flex-1 border border-gray-300 text-gray-600 py-2 rounded-xl hover:bg-gray-100 transition font-medium">
                    Batal
                </button>
                <button onclick="document.getElementById('form-konfirmasi').submit()"
                        class="flex-1 bg-green-700 hover:bg-green-800 text-white py-2 rounded-xl transition font-medium">
                    Ya, Pesan!
                </button>
            </div>

        </div>
    </div>


    {{-- Popup Berhasil --}}
    @if(session('success'))
    <div id="popup-sukses" class="fixed inset-0 z-50 flex items-center justify-center"
        style="opacity: 0; transition: opacity 0.5s ease;">

        <div id="popup-card" class="bg-[#4a7c6f] rounded-3xl p-10 flex flex-col items-center text-center max-w-xs w-full mx-4 shadow-2xl"
            style="transform: scale(0.8); transition: transform 0.5s ease;">

            <p class="text-white font-bold text-lg mb-6">Terimakasih Banyak!</p>

            {{-- Ilustrasi tas makanan --}}
            <div class="mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 130" class="w-32 h-32">
                    <rect x="20" y="40" width="80" height="75" rx="8" fill="#E8A951"/>
                    <path d="M20 40 Q60 20 100 40" fill="#D4904A" stroke="none"/>
                    <rect x="42" y="15" width="36" height="45" rx="3" fill="#F5F0E8"/>
                    <line x1="48" y1="25" x2="72" y2="25" stroke="#ccc" stroke-width="2"/>
                    <line x1="48" y1="32" x2="72" y2="32" stroke="#ccc" stroke-width="2"/>
                    <line x1="48" y1="39" x2="72" y2="39" stroke="#ccc" stroke-width="2"/>
                    <circle cx="60" cy="80" r="22" fill="#D4904A"/>
                    <line x1="54" y1="70" x2="54" y2="90" stroke="white" stroke-width="3" stroke-linecap="round"/>
                    <line x1="66" y1="70" x2="66" y2="90" stroke="white" stroke-width="3" stroke-linecap="round"/>
                    <path d="M51 70 Q54 76 57 70" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                    <path d="M63 70 h6 v4 a3 3 0 0 1-6 0 z" fill="white"/>
                    <line x1="48" y1="72" x2="72" y2="88" stroke="#C17A38" stroke-width="3" stroke-linecap="round"/>
                    <line x1="72" y1="72" x2="48" y2="88" stroke="#C17A38" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>

            <p class="text-white font-bold text-xl mb-2">Pemesanan Berhasil</p>
            <p class="text-white text-sm opacity-80">Pesanan Anda sedang diproses</p>

            <button onclick="tutupPopup()"
                    class="mt-8 bg-white text-[#4a7c6f] font-semibold px-8 py-2 rounded-full hover:bg-gray-100 transition">
                OK
            </button>

        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            const popup = document.getElementById('popup-sukses');
            const card  = document.getElementById('popup-card');

            setTimeout(() => {
                popup.style.opacity = '1';
                card.style.transform = 'scale(1)';
            }, 100);
        });

        function tutupPopup() {
            const popup = document.getElementById('popup-sukses');
            const card  = document.getElementById('popup-card');

            popup.style.opacity = '0';
            card.style.transform = 'scale(0.8)';

            setTimeout(() => {
                popup.classList.add('hidden');
                window.location.href = '{{ route('beranda') }}';
            }, 500);
        }

        setTimeout(() => {
            tutupPopup();
        }, 5000);
    </script>
    @endif

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

{{-- Konfirmasi Pesanan Pop Up --}}
<script>
    function tampilKonfirmasi() {
        const popup = document.getElementById('popup-konfirmasi');
        const card  = document.getElementById('popup-konfirmasi-card');

        popup.classList.remove('hidden');
        setTimeout(() => {
            card.style.transform = 'scale(1)';
        }, 10);
    }

    function batalKonfirmasi() {
        const popup = document.getElementById('popup-konfirmasi');
        const card  = document.getElementById('popup-konfirmasi-card');

        card.style.transform = 'scale(0.8)';
        setTimeout(() => {
            popup.classList.add('hidden');
        }, 300);
    }
</script>

</body>
</html>