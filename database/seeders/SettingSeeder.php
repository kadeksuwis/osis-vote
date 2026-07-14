<?php

namespace Database\Seeders;
use App\Models\Setting;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::create([
            'judul_web' => 'Pemilihan Ketua OSIS 2026',
            'deskripsi' => 'Pilih calon ketua OSIS terbaikmu!',
        ]);
    }
}
