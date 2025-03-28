<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PPDB extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $table = 'ppdb';

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
        'status',
        'notes'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'status' => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
