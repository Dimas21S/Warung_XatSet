<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>

<body class="h-full flex flex-col md:flex-row">

    <div class="absolute top-4 left-4 md:top-6 md:left-6">
        <h1 class="text-2xl font-bold text-green-800">MASUK</h1>
    </div>

    <!-- KIRI - Logo -->
    <div class="w-full md:w-1/2 flex flex-col items-center justify-center pb-0 pt-8 px-10 md:p-10 bg-white">
        <img
            src="{{ asset('image/Logo-Xatset.png') }}"
            alt="Logo"
            class="w-1/2 md:w-2/3 object-contain"
        >
    </div>

    <!-- KANAN - Form Login -->
    <div class="flex-1 flex items-start md:items-center justify-center bg-white px-6 pt-6 pb-8 md:p-10">
        <div class="w-full max-w-md">

            <h2 class="text-3xl font-bold text-gray-800 mb-2 pt-5">Selamat Datang 👋</h2>
            <p class="text-gray-500 mb-8">Silakan login untuk melanjutkan</p>

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input
                            type="email"
                            name="email"
                            placeholder="contoh@email.com"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <div class="text-right">
                        <a href="#" class="text-sm text-[rgba(9,125,76,1)] hover:underline">Lupa password?</a>
                    </div>

                    <button 
                        class="w-full text-white font-semibold py-3 rounded-lg transition bg-[rgba(9,125,76,1)] hover:bg-[rgba(7,100,60,1)]"
                        type="submit">
                        Login
                    </button>
                </div>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-[rgba(9,125,76,1)] font-medium hover:underline">Daftar sekarang</a>
            </p>

        </div>
    </div>

</body>

</html>