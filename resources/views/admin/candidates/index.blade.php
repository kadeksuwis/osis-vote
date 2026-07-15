<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Kandidat
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('admin.candidates.create') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    + Tambah Kandidat
                </a>
            </div>

            <div class="bg-white shadow rounded overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">No Urut</th>
                            <th class="px-4 py-2">Foto</th>
                            <th class="px-4 py-2">Nama Ketua</th>
                            <th class="px-4 py-2">Nama Wakil</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($candidates as $candidate)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $candidate->no_urut }}</td>
                                <td class="px-4 py-2">
                                    @if ($candidate->foto)
                                        <img src="{{ Storage::url($candidate->foto) }}" class="w-16 h-16 object-cover rounded">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $candidate->nama_ketua }}</td>
                                <td class="px-4 py-2">{{ $candidate->nama_wakil ?? '-' }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('admin.candidates.edit', $candidate) }}"
                                       class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.candidates.destroy', $candidate) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Yakin hapus kandidat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                    Belum ada kandidat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>