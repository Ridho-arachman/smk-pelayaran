<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Material;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    public function index()
    {
        $courses = Course::query()
            ->where('is_published', true)
            ->withCount(['lessons', 'materials'])
            ->with([
                'teacher.user' => function ($query) {
                    $query->select('id', 'name');
                },
                'lessons' => function ($query) {
                    $query->where('is_published', true)
                        ->orderBy('order')
                        ->select('id', 'course_id', 'title', 'order');
                },
                'lessons.materials' => function ($query) {
                    $query->latest()
                        ->select('id', 'lesson_id', 'title', 'type', 'created_at');
                }
            ])
            ->latest()
            ->get();

        // Get recent materials across all courses
        $recentMaterials = Material::query()
            ->whereHas('lesson.course', function ($query) {
                $query->where('is_published', true);
            })
            ->with(['lesson.course' => function ($query) {
                $query->select('id', 'title');
            }])
            ->latest()
            ->limit(5)
            ->get();

        return view('pages.learning', [
            'enrolledCourses' => $courses,
            'recentMaterials' => $recentMaterials,
            'completedMaterials' => 0,
        ]);
    }

    public function course(Course $course)
    {
        $totalLessons = $course->lessons()->count();

        return view('pages.learning-course', [
            'course' => $course,
            'completedLessons' => 0,
            'totalLessons' => $totalLessons,
        ]);
    }

    public function material(Material $material)
    {
        return view('pages.learning-material', compact('material'));
    }
}
