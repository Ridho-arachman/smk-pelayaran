<?php

namespace App\Observers;

use App\Models\PPDB;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class PPDBObserver
{
    public function updated(PPDB $ppdb)
    {
        if ($ppdb->isDirty('status') && $ppdb->status === 'accepted') {
            $user = User::create([
                'name' => $ppdb->name,
                'email' => $ppdb->email,
                'password' => Hash::make('password123'),
                'role' => 'student',
                'is_active' => true,
            ]);

            Student::create([
                'user_id' => $user->id,
                'nisn' => $ppdb->nisn,
                'nis' => 'S' . date('Y') . str_pad(Student::count() + 1, 4, '0', STR_PAD_LEFT),
            ]);
        }
    }
}