<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voter;
use App\Imports\VotersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VoterController extends Controller
{
    public function index()
    {
        $voters = Voter::latest()->paginate(20);
        return view('admin.voters.index', compact('voters'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new VotersImport, $request->file('file'));

        return redirect()->route('admin.voters.index')
            ->with('success', 'Data pemilih berhasil diimport.');
    }

    public function destroy(Voter $voter)
    {
        $voter->delete();
        return redirect()->route('admin.voters.index')
            ->with('success', 'Pemilih berhasil dihapus.');
    }
}