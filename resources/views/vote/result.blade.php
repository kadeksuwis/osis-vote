<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Voting - {{ $setting->judul_web ?? 'Voting Ketua OSIS' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-2">
            Hasil {{ $setting->judul_web ?? 'Voting Ketua OSIS' }}
        </h1>

        <div class="text-center text-gray-500 mb-8">
            Total suara masuk: <strong>{{ $totalVotes }}</strong> dari <strong>{{ $totalVoters }}</strong> pemilih terdaftar
            ({{ $totalSudahVote }} sudah memilih)
        </div>

        @if ($isAdmin ?? false)
            <div class="mb-6 text-center">
                <a href="{{ route('admin.candidates.index') }}" class="text-indigo-600 hover:underline">
                    &larr; Kembali ke Dashboard Admin
                </a>
            </div>
        @endif

        <div class="space-y-4">
            @foreach ($candidates as $candidate)
                @php
                    $percentage = $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100, 1) : 0;
                @endphp
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center gap-3">
                            @if ($candidate->foto)
                                <img src="{{ Storage::url($candidate->foto) }}" class="w-12 h-12 object-cover rounded-full">
                            @endif
                            <div>
                                <span class="text-sm text-indigo-600 font-semibold">No. {{ $candidate->no_urut }}</span>
                                <h3 class="font-bold text-gray-800">
                                    {{ $candidate->nama_ketua }}
                                    @if ($candidate->nama_wakil)
                                        & {{ $candidate->nama_wakil }}
                                    @endif
                                </h3>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-gray-800">{{ $candidate->votes_count }}</div>
                            <div class="text-sm text-gray-500">suara ({{ $percentage }}%)</div>
                        </div>
                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-indigo-600 h-3 rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>