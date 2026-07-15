<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengaturan Website
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Judul Website</label>
                        <input type="text" name="judul_web"
                               value="{{ old('judul_web', $setting->judul_web) }}"
                               class="w-full border-gray-300 rounded">
                        @error('judul_web') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                                  class="w-full border-gray-300 rounded">{{ old('deskripsi', $setting->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium mb-1">Waktu Mulai Voting</label>
                            <input type="datetime-local" name="waktu_mulai"
                                   value="{{ old('waktu_mulai', $setting->waktu_mulai?->format('Y-m-d\TH:i')) }}"
                                   class="w-full border-gray-300 rounded">
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Waktu Selesai Voting</label>
                            <input type="datetime-local" name="waktu_selesai"
                                   value="{{ old('waktu_selesai', $setting->waktu_selesai?->format('Y-m-d\TH:i')) }}"
                                   class="w-full border-gray-300 rounded">
                        </div>
                        @error('waktu_selesai') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="hasil_ditampilkan" value="1"
                                   {{ $setting->hasil_ditampilkan ? 'checked' : '' }}
                                   class="rounded border-gray-300">
                            <span class="ml-2">Tampilkan hasil voting ke publik</span>
                        </label>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>