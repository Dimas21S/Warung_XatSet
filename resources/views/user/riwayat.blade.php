<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Menunggu Konfirmasi</title>
</head>

<body class="bg-[#fdf8f0] min-h-screen flex flex-col">

    {{-- Navbar --}}
    <x-navbar/>

    {{-- Content --}}
    <div class="flex-1 flex flex-col items-center py-10 px-4">

        <h1 class="text-xl font-bold text-yellow-600 mb-6">Menunggu Konfirmasi</h1>

        {{-- Card Detail Pesanan --}}
        <div class="bg-white rounded-xl shadow-md w-full max-w-md p-5">

            {{-- Header --}}
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span class="font-semibold text-gray-700">Detail Pesanan</span>
            </div>

            {{-- List Item --}}
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div class="divide-y divide-gray-100">
                    @forelse($order->items ?? [] as $index => $item)
                        <div class="flex justify-between items-center px-4 py-3 text-sm text-gray-700">
                            <span>{{ $index + 1 }} {{ $item->nama }}</span>
                            <span>{{ $item->qty }}</span>
                            <span>Rp{{ number_format($item->harga * $item->qty, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <div class="flex justify-between items-center px-4 py-3 text-sm text-gray-500">
                            <span>1 Ikan Nila Gulai Kuning</span>
                            <span>1</span>
                            <span>Rp25.000</span>
                        </div>
                        <div class="flex justify-between items-center px-4 py-3 text-sm text-gray-500">
                            <span>2 Ikan Nila Gulai Merah</span>
                            <span>2</span>
                            <span>Rp50.000</span>
                        </div>
                    @endforelse
                </div>

                {{-- Garis Pemisah --}}
                <div class="border-t border-dashed border-gray-300 mx-4"></div>

                {{-- Subtotal, Diskon, Total --}}
                <div class="px-4 py-3 space-y-1 text-sm text-gray-700">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <div class="flex gap-8">
                            <span>{{ $order->items->sum('qty') ?? 3 }}</span>
                            <span>{{ number_format($order->subtotal ?? 75000, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span>Diskon</span>
                        <span>{{ $order->diskon ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between font-semibold">
                        <span>Total Belanja</span>
                        <span>{{ number_format($order->total ?? 75000, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Tanggal --}}
            <p class="text-center text-xs text-gray-400 mt-4">
                Tgl. {{ isset($order) ? \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') : date('d-m-Y') }}
            </p>

        </div>

    </div>

    {{-- Footer --}}
    <footer class="bg-green-700 text-white text-center text-sm py-3">
        2024 Warung Xatset. All right reserved.
    </footer>

</body>
</html>