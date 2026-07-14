<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin OSIS',
            'email' => 'admin@osis.sch.id',
            'password' => bcrypt('password123'), // ganti nanti setelah login
        ]);
        $this->call([
            SettingSeeder::class,
        ]);
    }
}
