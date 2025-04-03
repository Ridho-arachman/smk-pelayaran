<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes, HasFactory;

    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'nip'
    ];

    protected static function booted(): void
    {
        static::deleting(function ($teacher) {
            $teacher->user->delete();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->where('role', 'teacher');
    }
}
