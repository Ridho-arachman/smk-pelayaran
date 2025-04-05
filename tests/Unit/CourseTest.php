<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Lesson;
use App\Models\Material;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_course()
    {
        $user = User::create([
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

        $course = Course::create([
            'title' => 'Test Course',
            'description' => 'Test Description',
            'teacher_id' => $teacher->nip,
            'is_published' => true,
            'thumbnail' => 'courses/test.jpg'
        ]);

        $this->assertDatabaseHas('courses', [
            'title' => 'Test Course',
            'teacher_id' => $teacher->nip
        ]);
    }



    public function test_course_has_lessons()
    {
        $user = User::create([
            'name' => 'Test Teacher',
            'email' => 'teacher3@test.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
            'gender' => 'male',
            'is_active' => true
        ]);

        $teacher = Teacher::create([
            'nip' => '123456789012345680',
            'user_id' => $user->id
        ]);

        $course = Course::create([
            'title' => 'Test Course',
            'description' => 'Test Description',
            'teacher_id' => $teacher->nip,
            'is_published' => true,
            'thumbnail' => 'courses/test.jpg'
        ]);

        for ($i = 0; $i < 3; $i++) {
            Lesson::create([
                'title' => "Lesson {$i}",
                'description' => "Description {$i}",
                'course_id' => $course->id,
                'order' => $i + 1
            ]);
        }

        $this->assertEquals(3, $course->lessons()->count());
    }

    public function test_course_has_materials_through_lessons()
    {
        $user = User::create([
            'name' => 'Test Teacher',
            'email' => 'teacher4@test.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
            'gender' => 'male',
            'is_active' => true
        ]);

        $teacher = Teacher::create([
            'nip' => '123456789012345681',
            'user_id' => $user->id
        ]);

        $course = Course::create([
            'title' => 'Test Course',
            'description' => 'Test Description',
            'teacher_id' => $teacher->nip,
            'is_published' => true,
            'thumbnail' => 'courses/test.jpg'
        ]);

        $lesson = Lesson::create([
            'title' => 'Test Lesson',
            'description' => 'Test Description',
            'course_id' => $course->id,
            'order' => 1
        ]);

        for ($i = 0; $i < 2; $i++) {
            Material::create([
                'title' => "Material {$i}",
                'type' => 'document',
                'content' => "Content {$i}",
                'lesson_id' => $lesson->id,
                'order' => $i + 1
            ]);
        }

        $this->assertEquals(2, $course->lessons()->first()->materials()->count());
    }
}
