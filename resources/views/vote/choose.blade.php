<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kandidat</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 min-h-screen py-6 px-2">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-2">
            Halo, {{ $voter->nama }}
        </h1>
        <p class="text-center text-gray-500 mb-8">
            Pilih salah satu calon ketua OSIS di bawah ini
        </p>

        <form action="{{ route('vote.submit') }}" method="POST" id="voteForm">
            @csrf
            <input type="hidden" name="candidate_id" id="selectedCandidate">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($candidates as $candidate)
                    <div onclick="pilih({{ $candidate->id }}, this)"
                        class="candidate-card cursor-pointer bg-white shadow rounded-lg p-6 border-2 border-transparent hover:border-indigo-400 transition">
                        <div class="text-center mb-4">
                            <span
                                class="inline-block bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold">
                                No. Urut {{ $candidate->no_urut }}
                            </span>
                        </div>

                        @if ($candidate->foto)
                            <img src="{{ Storage::url($candidate->foto) }}"
                                class="w-32 h-32 object-cover rounded-full mx-auto mb-4">
                        @endif

                        <h3 class="text-lg font-bold text-center">{{ $candidate->nama_ketua }}</h3>
                        @if ($candidate->nama_wakil)
                            <p class="text-center text-gray-500 mb-3">& {{ $candidate->nama_wakil }}</p>
                        @endif

                        <div class="text-sm text-gray-600 mt-3">
                            <p class="font-semibold">Visi:</p>
                            <p>{{ $candidate->visi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <button type="submit" id="submitBtn" disabled
                    class="bg-gray-300 text-white px-8 py-3 rounded font-semibold cursor-not-allowed">
                    Pilih kandidat terlebih dahulu
                </button>
            </div>
        </form>
    </div>

    <script>
        function pilih(id, el) {
            document.getElementById('selectedCandidate').value = id;

            document.querySelectorAll('.candidate-card').forEach(card => {
                card.classList.remove('border-indigo-600', 'bg-indigo-50');
                card.classList.add('border-transparent');
            });
            el.classList.remove('border-transparent');
            el.classList.add('border-indigo-600', 'bg-indigo-50');

            const btn = document.getElementById('submitBtn');
            btn.disabled = false;
            btn.textContent = 'Konfirmasi Pilihan Saya';
            btn.classList.remove('bg-gray-300', 'cursor-not-allowed');
            btn.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
        }

        document.getElementById('voteForm').addEventListener('submit', function(e) {
            if (!confirm('Yakin dengan pilihan Anda? Pilihan tidak dapat diubah setelah ini.')) {
                e.preventDefault();
            }
        });
    </script>
</body>

</html>
