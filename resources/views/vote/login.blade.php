<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->judul_web ?? 'Voting Ketua OSIS' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-2">
            {{ $setting->judul_web ?? 'Voting Ketua OSIS' }}
        </h1>
        <p class="text-center text-gray-500 mb-6">
            {{ $setting->deskripsi ?? 'Masukkan kode unik untuk mulai memilih' }}
        </p>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('vote.login.submit') }}" method="POST">
            @csrf
            <label class="block font-medium mb-1 text-gray-700">Kode Unik</label>
            <input type="text" name="kode_unik" placeholder="Contoh: UAM498"
                class="w-full border-gray-300 rounded p-4 mb-4 uppercase tracking-widest text-center font-mono text-lg"
                autofocus>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-3 rounded font-semibold hover:bg-indigo-700">
                Masuk & Mulai Memilih
            </button>
        </form>
    </div>
</body>

</html>
