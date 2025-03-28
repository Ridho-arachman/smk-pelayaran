<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'isbn',
        'description',
        'category',
        'stock',
        'cover_image',
        'file_path'
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'stock' => 'integer'
    ];

    protected static $categories = [
        'fiction' => 'Fiction',
        'non-fiction' => 'Non-Fiction',
        'reference' => 'Reference',
        'textbook' => 'Textbook',
        'magazine' => 'Magazine'
    ];

    public static function getCategories()
    {
        return static::$categories;
    }

    // Add these relationships to your existing Library model
    public function loans()
    {
        return $this->hasMany(BookLoan::class);
    }

    public function accessLogs()
    {
        return $this->hasMany(BookAccessLog::class);
    }

    public function userAccess()
    {
        return $this->hasMany(UserLibrary::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_libraries')
            ->withPivot('access_expires_at', 'is_active')
            ->withTimestamps();
    }
}
