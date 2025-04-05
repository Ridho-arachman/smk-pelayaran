<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeacherTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_teacher()
    {
        $user = User::factory()->create(['role' => 'teacher']);

        $teacher = Teacher::create([
            'nip' => '123456789012345678',
            'user_id' => $user->id
        ]);

        $this->assertDatabaseHas('teachers', [
            'nip' => '123456789012345678',
            'user_id' => $user->id
        ]);
    }

    public function test_teacher_belongs_to_user()
    {
        $user = User::factory()->create(['role' => 'teacher']);
        $teacher = Teacher::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $teacher->user->id);
    }
}
