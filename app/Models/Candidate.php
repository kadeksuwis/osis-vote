<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['no_urut', 'nama_ketua', 'nama_wakil', 'foto', 'visi', 'misi'];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
