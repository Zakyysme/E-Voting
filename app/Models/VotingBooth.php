<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VotingBooth extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal (Mass Assignment).
     * Penting agar fungsi create() & update() di controller berjalan.
     */
    protected $fillable = [
        'name',
        'location',
        'access_code',
        'is_active',
    ];

    /**
     * Ubah tipe data kolom tertentu secara otomatis.
     * 'is_active' di database biasanya tinyint (0/1),
     * kita ubah jadi boolean (true/false) di PHP.
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
