<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    protected $fillable = ['kode_unik', 'nama', 'role', 'kelas', 'sudah_vote'];

    public function vote()
    {
        return $this->hasOne(Vote::class);
    }
}
