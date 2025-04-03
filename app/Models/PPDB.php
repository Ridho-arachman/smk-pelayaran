<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;

class PPDB extends Model
{
    use HasUlids, SoftDeletes, Notifiable;

    protected $table = 'ppdb';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
        'birth_place',
        'gender',
        'previous_school',
        'parent_name',
        'parent_phone',
        'address',
        'status',
        'registration_number',
        'documents',
        'nisn'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'documents' => 'array',
        'status' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->registration_number = 'PPDB-' . date('Y') . '-' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
            $model->status = 'pending';
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function createStudentAccount(): void
    {
        // Find existing user or create new one
        $user = User::updateOrCreate(
            ['email' => $this->email],
            [
                'name' => $this->name,
                'password' => Hash::make('password'),
                'role' => 'student',
                'gender' => $this->gender,
                'is_active' => true,
            ]
        );

        // Create student record if doesn't exist
        Student::firstOrCreate(
            ['nisn' => $this->nisn],
            [
                'user_id' => $user->id,
                'nis' => 'S' . date('Y') . str_pad(Student::count() + 1, 4, '0', STR_PAD_LEFT),
            ]
        );

        // Update PPDB status
        $this->update(['status' => 'accepted']);
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'nisn', 'nisn');
    }
}
