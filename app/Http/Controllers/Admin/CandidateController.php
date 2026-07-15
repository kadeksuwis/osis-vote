<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::orderBy('no_urut')->get();
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        return view('admin.candidates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_urut' => 'required|integer|unique:candidates,no_urut',
            'nama_ketua' => 'required|string|max:255',
            'nama_wakil' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('candidates', 'public');
        }

        Candidate::create($validated);

        return redirect()->route('admin.candidates.index')
            ->with('success', 'Kandidat berhasil ditambahkan.');
    }

    public function edit(Candidate $candidate)
    {
        return view('admin.candidates.edit', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $validated = $request->validate([
            'no_urut' => 'required|integer|unique:candidates,no_urut,' . $candidate->id,
            'nama_ketua' => 'required|string|max:255',
            'nama_wakil' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        if ($request->hasFile('foto')) {
            if ($candidate->foto) {
                Storage::disk('public')->delete($candidate->foto);
            }
            $validated['foto'] = $request->file('foto')->store('candidates', 'public');
        }

        $candidate->update($validated);

        return redirect()->route('admin.candidates.index')
            ->with('success', 'Kandidat berhasil diperbarui.');
    }

    public function destroy(Candidate $candidate)
    {
        if ($candidate->foto) {
            Storage::disk('public')->delete($candidate->foto);
        }
        $candidate->delete();

        return redirect()->route('admin.candidates.index')
            ->with('success', 'Kandidat berhasil dihapus.');
    }
}