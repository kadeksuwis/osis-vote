<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kandidat
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">
                <form action="{{ route('admin.candidates.update', $candidate) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-1">No Urut</label>
                        <input type="number" name="no_urut" value="{{ old('no_urut', $candidate->no_urut) }}"
                               class="w-full border-gray-300 rounded">
                        @error('no_urut') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nama Ketua</label>
                        <input type="text" name="nama_ketua" value="{{ old('nama_ketua', $candidate->nama_ketua) }}"
                               class="w-full border-gray-300 rounded">
                        @error('nama_ketua') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nama Wakil (opsional)</label>
                        <input type="text" name="nama_wakil" value="{{ old('nama_wakil', $candidate->nama_wakil) }}"
                               class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Foto</label>
                        @if ($candidate->foto)
                            <img src="{{ Storage::url($candidate->foto) }}" class="w-24 h-24 object-cover rounded mb-2">
                        @endif
                        <input type="file" name="foto" class="w-full">
                        @error('foto') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Visi</label>
                        <textarea name="visi" rows="3" class="w-full border-gray-300 rounded">{{ old('visi', $candidate->visi) }}</textarea>
                        @error('visi') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Misi</label>
                        <textarea name="misi" rows="4" class="w-full border-gray-300 rounded">{{ old('misi', $candidate->misi) }}</textarea>
                        @error('misi') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.candidates.index') }}" class="px-4 py-2 border rounded">Batal</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>