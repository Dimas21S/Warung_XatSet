<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Identitas - Warung Xat Set</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdf8f0; }
        .sidebar { width: 220px; min-height: 100vh; background: #fdf8f0; border-right: 1px solid #e8e0d0; }
        .sidebar-link { display: block; padding: 10px 24px; color: #555; font-size: 14px; text-decoration: none; border-radius: 6px; margin: 2px 8px; }
        .sidebar-link:hover { background: #f0ebe0; color: #2d6a4f; }
        .sidebar-link.active { color: #2d6a4f; font-weight: 600; text-decoration: underline; }
        .topbar { background: #2d6a4f; color: white; padding: 14px 28px; font-weight: 600; font-size: 16px; }
        .input-field { width: 100%; border: 1px solid #ccc; border-radius: 6px; padding: 8px 12px; font-size: 13px; outline: none; background: white; }
        .input-field:focus { border-color: #2d6a4f; }
        .edit-btn { background: white; border: 1px solid #ccc; color: #333; font-size: 13px; padding: 6px 20px; border-radius: 6px; cursor: pointer; }
        .edit-btn:hover { background: #f0f0f0; }
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
            Identitas
        </div>

        {{-- Content --}}
        <div class="p-6 space-y-6">

            {{-- Logo Card --}}
            <div class="bg-yellow-300 rounded-xl px-6 py-4 inline-flex items-center gap-6">
                <div>
                    <p class="text-xs text-yellow-800 font-medium mb-1">Logo</p>
                    <p class="text-lg font-bold text-gray-800">WARUNG XAT SET</p>
                </div>
                <button class="edit-btn">Edit</button>
            </div>

            {{-- Form Identitas --}}
            <div class="bg-white rounded-xl p-6 shadow-sm">
                {{-- Notif Identitas --}}
                @if(session('success_identitas'))
                    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg text-sm">
                        {{ session('success_identitas') }}
                    </div>
                @endif

                {{-- Form Identitas --}}
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <form action="{{ route('admin.identitas.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-xs text-gray-500 mb-1 block">Nama Aplikasi</label>
                                    <input type="text" name="nama_aplikasi" class="input-field" value="{{ $setting->nama_aplikasi ?? '' }}">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 mb-1 block">Alamat</label>
                                    <textarea name="alamat" class="input-field" rows="2">{{ $setting->alamat ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 mb-1 block">Logo</label>
                                    <input type="file" name="logo" accept="image/*" class="input-field">
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-xs text-gray-500 mb-1 block">No CS</label>
                                    <input type="text" name="no_cs" class="input-field" value="{{ $setting->no_cs ?? '' }}">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 mb-1 block">Outlet</label>
                                    <select name="outlet_id" class="input-field">
                                        <option value="">-- Pilih Outlet --</option>
                                        @foreach($outlets as $outlet)
                                            <option value="{{ $outlet->id }}" {{ ($setting->outlet_id ?? '') == $outlet->id ? 'selected' : '' }}>
                                                {{ $outlet->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit" class="edit-btn">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Form Media --}}
            <div class="bg-white rounded-xl p-6 shadow-sm">
                {{-- Notif Media --}}
                @if(session('success_media'))
                    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg text-sm">
                        {{ session('success_media') }}
                    </div>
                @endif

                {{-- Form Media --}}
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <form action="{{ route('admin.identitas.media') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <p class="font-semibold text-gray-700 mb-4">Media</p>
                        <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <label class="text-sm text-gray-600 w-20">Facebook</label>
                                    <input type="text" name="facebook" class="input-field" value="{{ $setting->facebook ?? '' }}">
                                </div>
                                <div class="flex items-center gap-3">
                                    <label class="text-sm text-gray-600 w-20">Instagram</label>
                                    <input type="text" name="instagram" class="input-field" value="{{ $setting->instagram ?? '' }}">
                                </div>
                                <div class="flex items-center gap-3">
                                    <label class="text-sm text-gray-600 w-20">Twitter</label>
                                    <input type="text" name="twitter" class="input-field" value="{{ $setting->twitter ?? '' }}">
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <label class="text-sm text-gray-600 w-20">Whatsapp</label>
                                    <input type="text" name="whatsapp" class="input-field" value="{{ $setting->whatsapp ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit" class="edit-btn">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>