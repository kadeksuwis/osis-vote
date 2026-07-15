<?php

namespace App\Imports;

use App\Models\Voter;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;

class VotersImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Voter([
            'kode_unik'  => strtoupper(Str::random(3)) . rand(100, 999),
            'nama'       => $row['nama'],
            'role'       => strtolower($row['role']), // siswa/guru/pegawai
            'kelas'      => $row['kelas'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'nama'  => 'required|string|max:255',
            'role'  => 'required|in:siswa,guru,pegawai,Siswa,Guru,Pegawai',
        ];
    }
}