<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Detail Produk</title>
</head>

<body class="bg-gray-50">

<div class="max-w-6xl mx-auto px-4 md:px-10 py-8">

    <!-- CONTAINER -->
    <div class="flex flex-col md:flex-row gap-10 md:gap-16 items-start">

        <!-- KIRI - GAMBAR -->
        <div class="w-full md:w-1/2 bg-[#E9E3D3] p-6 rounded-2xl">
            <img src="{{ asset('image/makanan.jpg') }}" 
                 class="w-full h-auto rounded-xl object-cover">
        </div>

        <!-- KANAN - DETAIL -->
        <div class="w-full md:w-1/2">

            <!-- NAMA -->
            <h1 class="text-2xl md:text-3xl font-bold text-green-900">
                Ikan Nila Gulai Kuning
            </h1>

            <!-- HARGA -->
            <p class="text-red-500 text-lg md:text-xl font-semibold mt-2">
                IDR -------
            </p>

            <!-- DESKRIPSI -->
            <h3 class="mt-6 font-semibold text-green-900">
                Deskripsi Produk
            </h3>

            <p class="text-gray-600 mt-2 leading-relaxed">
                Ikan Nila Gulai Kuning adalah hidangan lezat yang terbuat dari ikan nila segar 
                yang dimasak dengan bumbu gulai kuning yang kaya rasa. Dengan tekstur lembut 
                dan cita rasa yang mantap, hidangan ini cocok untuk dinikmati bersama keluarga.
            </p>

            <!-- BUTTON -->
            <button class="mt-8 w-full bg-yellow-600 hover:bg-yellow-700 text-white py-3 rounded-lg font-medium transition">
                + Keranjang
            </button>

        </div>

    </div>

</div>

</body>
</html>