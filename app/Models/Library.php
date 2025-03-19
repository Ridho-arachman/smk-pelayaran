<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'isbn',
        'category',
        'stock',
        'description',
        'cover_image',
        'file_path',
        'is_available',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'stock' => 'integer',
        'is_available' => 'boolean',
    ];
}
