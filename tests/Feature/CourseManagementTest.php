<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CourseManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_can_create_course()
    {
        Storage::fake('public');
        
        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'name' => 'Test Teacher',
            'email' => 'teacher@test.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
            'gender' => 'male',
            'is_active' => true
        ]);

        $teacher = Teacher::create([
            'nip' => '123456789012345678',
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)->post('/teacher/courses', [
            'title' => 'New Course',
            'description' => 'Course Description',
            'is_published' => true,
            'thumbnail' => UploadedFile::fake()->image('course.jpg')
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('courses', [
            'title' => 'New Course',
            'teacher_id' => $teacher->nip
        ]);
    }

    public function test_student_can_access_course_material()
    {
        /** @var \App\Models\User $student */
        $student = User::factory()->create([
            'name' => 'Test Student',
            'email' => 'student@test.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'gender' => 'male',
            'is_active' => true
        ]);

        $course = Course::factory()->create(['is_published' => true]);

        $response = $this->actingAs($student)->get("/courses/{$course->id}");
        
        $response->assertStatus(200);
        $response->assertSee($course->title);
    }
}