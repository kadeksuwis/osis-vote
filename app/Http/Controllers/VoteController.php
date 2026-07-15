<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Setting;
use App\Models\Voter;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    // Halaman input kode unik
    public function showLoginForm()
    {
        $setting = Setting::first();
        return view('vote.login', compact('setting'));
    }

    // Proses cek kode unik
    public function login(Request $request)
    {
        $request->validate([
            'kode_unik' => 'required|string',
        ]);

        $voter = Voter::where('kode_unik', strtoupper($request->kode_unik))->first();

        if (!$voter) {
            return back()->withErrors(['kode_unik' => 'Kode tidak ditemukan.']);
        }

        if ($voter->sudah_vote) {
            return back()->withErrors(['kode_unik' => 'Kode ini sudah digunakan untuk memilih.']);
        }

        $setting = Setting::first();
        $now = now();

        if ($setting->waktu_mulai && $now->lt($setting->waktu_mulai)) {
            return back()->withErrors(['kode_unik' => 'Voting belum dimulai.']);
        }

        if ($setting->waktu_selesai && $now->gt($setting->waktu_selesai)) {
            return back()->withErrors(['kode_unik' => 'Voting sudah ditutup.']);
        }

        // Simpan voter_id di session sementara (bukan login user beneran)
        session(['voter_id' => $voter->id]);

        return redirect()->route('vote.choose');
    }

    // Halaman pilih kandidat
    public function choose()
    {
        $voterId = session('voter_id');
        if (!$voterId) {
            return redirect()->route('vote.login')->withErrors(['kode_unik' => 'Silakan masukkan kode terlebih dahulu.']);
        }

        $voter = Voter::find($voterId);
        if (!$voter || $voter->sudah_vote) {
            session()->forget('voter_id');
            return redirect()->route('vote.login')->withErrors(['kode_unik' => 'Sesi tidak valid atau sudah memilih.']);
        }

        $candidates = Candidate::orderBy('no_urut')->get();
        return view('vote.choose', compact('candidates', 'voter'));
    }

    // Proses submit vote
    public function submit(Request $request)
    {
        $voterId = session('voter_id');
        $voter = Voter::find($voterId);

        if (!$voter || $voter->sudah_vote) {
            return redirect()->route('vote.login')->withErrors(['kode_unik' => 'Sesi tidak valid atau sudah memilih.']);
        }

        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        Vote::create([
            'voter_id' => $voter->id,
            'candidate_id' => $request->candidate_id,
            'waktu_vote' => now(),
        ]);

        $voter->update(['sudah_vote' => true]);

        session()->forget('voter_id');

        return redirect()->route('vote.thanks');
    }

    // Halaman ucapan terima kasih
    public function thanks()
    {
        return view('vote.thanks');
    }
}