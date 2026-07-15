<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kandidat
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">
                <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">No Urut</label>
                        <input type="number" name="no_urut" value="{{ old('no_urut') }}"
                               class="w-full border-gray-300 rounded">
                        @error('no_urut') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nama Ketua</label>
                        <input type="text" name="nama_ketua" value="{{ old('nama_ketua') }}"
                               class="w-full border-gray-300 rounded">
                        @error('nama_ketua') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nama Wakil (opsional)</label>
                        <input type="text" name="nama_wakil" value="{{ old('nama_wakil') }}"
                               class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Foto</label>
                        <input type="file" name="foto" class="w-full">
                        @error('foto') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Visi</label>
                        <textarea name="visi" rows="3" class="w-full border-gray-300 rounded">{{ old('visi') }}</textarea>
                        @error('visi') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Misi</label>
                        <textarea name="misi" rows="4" class="w-full border-gray-300 rounded">{{ old('misi') }}</textarea>
                        @error('misi') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.candidates.index') }}" class="px-4 py-2 border rounded">Batal</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>