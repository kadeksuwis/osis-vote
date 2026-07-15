<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Data Pemilih
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Import -->
            <div class="bg-white shadow rounded p-6 mb-6">
                <h3 class="font-semibold mb-3">Import Data Pemilih (Excel)</h3>
                <p class="text-sm text-gray-500 mb-3">
                    Format kolom: <strong>nama</strong>, <strong>role</strong> (siswa/guru/pegawai),
                    <strong>kelas</strong> (opsional).
                </p>
                <form action="{{ route('admin.voters.import') }}" method="POST" enctype="multipart/form-data"
                    class="flex items-center gap-3">
                    @csrf
                    <input type="file" name="file" required class="border rounded p-2">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Import
                    </button>
                </form>
            </div>

            <!-- Tabel Data Pemilih -->
            <div class="bg-white shadow rounded overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Kode Unik</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Role</th>
                            <th class="px-4 py-2">Kelas</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($voters as $voter)
                            <tr class="border-t">
                                <td class="px-4 py-2 font-mono">{{ $voter->kode_unik }}</td>
                                <td class="px-4 py-2">{{ $voter->nama }}</td>
                                <td class="px-4 py-2 capitalize">{{ $voter->role }}</td>
                                <td class="px-4 py-2">{{ $voter->kelas ?? '-' }}</td>
                                <td class="px-4 py-2">
                                    @if ($voter->sudah_vote)
                                        <span class="text-green-600">Sudah vote</span>
                                    @else
                                        <span class="text-gray-400">Belum vote</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('admin.voters.destroy', $voter) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus pemilih ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                    Belum ada data pemilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $voters->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
