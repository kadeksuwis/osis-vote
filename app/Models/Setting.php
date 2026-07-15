<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['judul_web', 'deskripsi', 'waktu_mulai', 'waktu_selesai', 'hasil_ditampilkan'];
    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
        'hasil_ditampilkan' => 'boolean',
    ];
}
