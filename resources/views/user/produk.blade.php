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
    <x-navbar/>

    <div id="notif" class="fixed top-5 right-5 z-50 hidden px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 text-white">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path id="notif-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    <span id="notif-message"></span>
</div>

    {{-- Card Produk Unggulan --}}
    <div class="px-4 py-4">

        <!-- CONTAINER SCROLL -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @forelse ($menu as $item)
                        @php
                        // Cek apakah item sudah ada di cart
                        $inCart = false;
                        $qtyInCart = 0;
                        foreach(session('cart', []) as $idx => $cartItem) {
                            if($cartItem['menu_id'] == $item->id) {
                                $inCart = true;
                                $qtyInCart = $cartItem['qty'];
                                break;
                            }
                        }
                    @endphp
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

                        @if($inCart)
                            {{-- Tombol − qty + --}}
                            <div id="qty-control-{{ $item->id }}" class="mt-3 w-full flex items-center justify-between border border-yellow-600 rounded-xl overflow-hidden">
                                <button onclick="kurangQtyProduk({{ $item->id }}, this)"
                                        class="w-10 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-bold text-lg">
                                    −
                                </button>
                                <span id="qty-produk-{{ $item->id }}" class="font-semibold text-gray-800">
                                    {{ $qtyInCart }}
                                </span>
                                <button onclick="tambahQtyProduk({{ $item->id }}, this)"
                                        class="w-10 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-bold text-lg">
                                    +
                                </button>
                            </div>
                        @else
                            {{-- Tombol + Keranjang --}}
                            <button id="btn-keranjang-{{ $item->id }}"
                                    onclick="tambahKeranjang({{ $item->id }})"
                                    class="mt-3 w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded-xl text-sm md:text-base">
                                + Keranjang
                            </button>
                        @endif
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
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

function tambahKeranjang(menuId) {
    fetch('{{ route('produk.post') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ menu_id: menuId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            // Ganti tombol + Keranjang menjadi − qty +
            const btn = document.getElementById(`btn-keranjang-${menuId}`);
            btn.outerHTML = `
                <div id="qty-control-${menuId}" class="mt-3 w-full flex items-center justify-between border border-yellow-600 rounded-xl overflow-hidden">
                    <button onclick="kurangQtyProduk(${menuId}, this)"
                            class="w-10 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-bold text-lg">
                        −
                    </button>
                    <span id="qty-produk-${menuId}" class="font-semibold text-gray-800">1</span>
                    <button onclick="tambahQtyProduk(${menuId}, this)"
                            class="w-10 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-bold text-lg">
                        +
                    </button>
                </div>
            `;
        }
        showNotif(data.message, data.status);
    })
    .catch(() => showNotif('Terjadi kesalahan!', 'error'));
}

function tambahQtyProduk(menuId, btn) {
    fetch('{{ route('produk.tambahQTY') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ menu_id: menuId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById(`qty-produk-${menuId}`).textContent = data.qty;
        }
    });
}

function kurangQtyProduk(menuId, btn) {
    fetch('{{ route('produk.kurangQTY') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ menu_id: menuId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'hapus') {
            // Kembalikan jadi tombol + Keranjang
            const control = document.getElementById(`qty-control-${menuId}`);
            control.outerHTML = `
                <button id="btn-keranjang-${menuId}"
                        onclick="tambahKeranjang(${menuId})"
                        class="mt-3 w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded-xl text-sm md:text-base">
                    + Keranjang
                </button>
            `;
        } else {
            document.getElementById(`qty-produk-${menuId}`).textContent = data.qty;
        }
    });
}

function showNotif(message, status) {
    const notif = document.getElementById('notif');
    const notifMessage = document.getElementById('notif-message');
    const notifIcon = document.getElementById('notif-icon');

    notif.classList.remove('bg-green-500', 'bg-red-500');
    if (status === 'success') {
        notif.classList.add('bg-green-500');
        notifIcon.setAttribute('d', 'M5 13l4 4L19 7');
    } else {
        notif.classList.add('bg-red-500');
        notifIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
    }

    notifMessage.textContent = message;
    notif.classList.remove('hidden');

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