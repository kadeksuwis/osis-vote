<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();

        // Jaga-jaga kalau belum ada data setting
        if (!$setting) {
            $setting = Setting::create([
                'judul_web' => 'Pemilihan Ketua OSIS',
            ]);
        }

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        $validated = $request->validate([
            'judul_web' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu_mulai' => 'nullable|date',
            'waktu_selesai' => 'nullable|date|after_or_equal:waktu_mulai',
            'hasil_ditampilkan' => 'nullable|boolean',
        ]);

        $validated['hasil_ditampilkan'] = $request->has('hasil_ditampilkan');

        $setting->update($validated);

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }
}