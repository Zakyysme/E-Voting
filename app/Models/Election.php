<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_at',
        'end_at',
        'status',
        'created_by'
    ];

    protected $dates = ['start_at', 'end_at'];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
