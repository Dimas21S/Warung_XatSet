<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Tambah Produk - Warung Xat Set</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdf8f0; }
        .sidebar { width: 220px; min-height: 100vh; background: #fdf8f0; border-right: 1px solid #e8e0d0; }
        .sidebar-link { display: block; padding: 10px 24px; color: #555; font-size: 14px; text-decoration: none; border-radius: 6px; margin: 2px 8px; }
        .sidebar-link:hover { background: #f0ebe0; color: #2d6a4f; }
        .sidebar-link.active { color: #2d6a4f; font-weight: 600; text-decoration: underline; }
        .topbar { background: #2d6a4f; color: white; padding: 14px 28px; font-weight: 600; font-size: 16px; }
        .input-field { width: 100%; border: 1px solid #d1d5db; border-radius: 8px; padding: 10px 14px; font-size: 14px; outline: none; background: white; }
        .input-field:focus { border-color: #2d6a4f; }
        label { font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 4px; display: block; }
    </style>
</head>
<body>

<div class="flex">

    {{-- SIDEBAR --}}
    <x-sidebar/>

    {{-- MAIN --}}
    <div class="flex-1" style="margin-left: 220px;">

        {{-- Topbar --}}
        <div class="topbar flex justify-end">
            Produk
        </div>

        {{-- Content --}}
        <div class="p-6">

            {{-- Header --}}
            <div class="flex items-center gap-3 mb-6">
                <a href="{{ route('admin.produk') }}" class="text-gray-500 hover:text-green-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="text-xl font-bold text-gray-800">Tambah Produk</h1>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="bg-white rounded-xl shadow-sm p-6 space-y-5">

                    {{-- Nama Menu --}}
                    <div>
                        <label>Nama Menu <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_menu" class="input-field"
                               placeholder="Contoh: Ikan Nila Gulai Kuning"
                               value="{{ old('nama_menu') }}">
                        @error('nama_menu')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Harga & Stok --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label>Harga <span class="text-red-500">*</span></label>
                            <input type="number" name="harga" class="input-field"
                                   placeholder="Contoh: 25000"
                                   value="{{ old('harga') }}">
                            @error('harga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label>Stok <span class="text-red-500">*</span></label>
                            <input type="number" name="stok" class="input-field"
                                   placeholder="Contoh: 50"
                                   value="{{ old('stok', 0) }}">
                            @error('stok')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="input-field" rows="3"
                                  placeholder="Deskripsi produk...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori & Outlet --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label>Kategori <span class="text-red-500">*</span></label>
                            <select name="kategori_id" class="input-field">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label>Outlet <span class="text-red-500">*</span></label>
                            <select name="outlet_id" class="input-field">
                                <option value="">-- Pilih Outlet --</option>
                                @foreach($outlets as $outlet)
                                    <option value="{{ $outlet->id }}" {{ old('outlet_id') == $outlet->id ? 'selected' : '' }}>
                                        {{ $outlet->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('outlet_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Gambar --}}
                    <div>
                        <label>Gambar Produk</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-green-500 transition"
                             onclick="document.getElementById('input-gambar').click()">
                            <img id="preview-gambar" src="" class="hidden w-40 h-40 object-cover rounded-xl mx-auto mb-3">
                            <div id="placeholder-gambar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-gray-400 text-sm">Klik untuk upload gambar</p>
                                <p class="text-gray-300 text-xs mt-1">PNG, JPG, JPEG (max 2MB)</p>
                            </div>
                            <input id="input-gambar" type="file" name="gambar" accept="image/*" class="hidden"
                                   onchange="previewGambar(this)">
                        </div>
                        @error('gambar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status Ketersediaan --}}
                    <div>
                        <label>Status Ketersediaan</label>
                        <div class="flex gap-4 mt-1">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="is_available" value="1"
                                       {{ old('is_available', '1') == '1' ? 'checked' : '' }}
                                       class="accent-green-600">
                                <span class="text-sm text-gray-700">Tersedia</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="is_available" value="0"
                                       {{ old('is_available') == '0' ? 'checked' : '' }}
                                       class="accent-green-600">
                                <span class="text-sm text-gray-700">Tidak Tersedia</span>
                            </label>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                                class="flex-1 bg-green-700 hover:bg-green-800 text-white py-3 rounded-xl font-medium transition">
                            Simpan Produk
                        </button>
                        <a href="{{ route('admin.produk') }}"
                           class="flex-1 text-center border border-gray-300 text-gray-600 py-3 rounded-xl font-medium hover:bg-gray-50 transition">
                            Batal
                        </a>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

<script>
function previewGambar(input) {
    const preview = document.getElementById('preview-gambar');
    const placeholder = document.getElementById('placeholder-gambar');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>