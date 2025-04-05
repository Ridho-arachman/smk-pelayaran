<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_user()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'gender' => 'male',
            'is_active' => true
        ];

        $user = User::create($userData);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'role' => 'student'
        ]);
    }

    public function test_user_has_correct_role()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin2@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'gender' => 'male',
            'is_active' => true
        ]);

        $teacher = User::create([
            'name' => 'Teacher User',
            'email' => 'teacher3@test.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
            'gender' => 'male',
            'is_active' => true
        ]);

        $student = User::create([
            'name' => 'Student User',
            'email' => 'student2@test.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'gender' => 'male',
            'is_active' => true
        ]);

        $this->assertEquals('admin', $admin->role);
        $this->assertEquals('teacher', $teacher->role);
        $this->assertEquals('student', $student->role);
    }
}
