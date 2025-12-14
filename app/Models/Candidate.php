<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'election_id',
        'nomor_urut',
        'name',      // Ini kita anggap Nama Ketua
    'vice_name', // Ini Nama Wakil
    'vice_photo',// Foto Wakil
        'description',
        'photo_url'
    ];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
