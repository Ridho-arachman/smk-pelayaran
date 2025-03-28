<?php

namespace App\Models;

use Filament\Panel;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasUlids;

    // public function canAccessPanel(Panel $panel): bool
    // {
    //     return $this->role === 'admin';
    // }

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
        'nip',
        'nisn'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function hasRole($role)
    {
        return $this->role === $role;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->role === 'student') {
                $model->id = $model->nisn;
            } elseif ($model->role === 'teacher') {
                $model->id = $model->nip;
            } else {
                $model->id = (string) Str::ulid();
            }
        });
    }

    public function bookLoans()
    {
        return $this->hasMany(BookLoan::class);
    }
}
