<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'election_id',
        'name',
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
