<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLibrary extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'user_id',
        'library_id',
        'access_expires_at',
        'is_active'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($userLibrary) {
            $user = User::find($userLibrary->user_id);
            if (!in_array($user->role, ['student', 'teacher'])) {
                throw new \Exception('Only students and teachers can access e-books.');
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function library()
    {
        return $this->belongsTo(Library::class);
    }
}