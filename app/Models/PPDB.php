<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPDB extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'nisn',
        'birth_place',
        'birth_date',
        'email',
        'phone',
        'previous_school',
        'major',
        'photo',
        'certificate',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}