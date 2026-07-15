<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Setting;
use App\Models\Voter;

class ResultController extends Controller
{
    // Untuk publik
    public function publicResult()
    {
        $setting = Setting::first();

        if (!$setting || !$setting->hasil_ditampilkan) {
            abort(403, 'Hasil voting belum dapat dilihat.');
        }

        return $this->buildResultView($setting);
    }

    // Untuk admin (selalu bisa diakses meskipun belum ditampilkan ke publik)
    public function adminResult()
    {
        $setting = Setting::first();
        return $this->buildResultView($setting, true);
    }

    private function buildResultView($setting, $isAdmin = false)
    {
        $candidates = Candidate::withCount('votes')->orderBy('no_urut')->get();
        $totalVotes = $candidates->sum('votes_count');
        $totalVoters = Voter::count();
        $totalSudahVote = Voter::where('sudah_vote', true)->count();

        return view('vote.result', compact('candidates', 'totalVotes', 'totalVoters', 'totalSudahVote', 'setting', 'isAdmin'));
    }
}