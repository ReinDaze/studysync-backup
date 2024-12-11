<?php

// app/Models/HasilGayaBelajar.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilGayaBelajar extends Model
{
    use HasFactory;

    protected $table = 'hasil_gaya_belajar';

    protected $fillable = [
        'user_id',
        'dominant_style',
        'description',
        'visual_score',
        'auditori_score',
        'kinestetik_score',
    ];
}
