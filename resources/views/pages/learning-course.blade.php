@extends('layouts.app')

@section('title', $course->title ?? 'Course')

@section('content')
    <!-- Course Header -->
    <div class="bg-base-200 py-8 mt-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-2/3">
                    <h1 class="text-4xl font-bold mb-4">{{ $course->title }}</h1>
                    <p class="text-lg mb-4">{{ $course->description ?? 'No description available' }}</p>
                </div>
                <div class="w-full md:w-1/3">
                    <div class="card bg-base-100 shadow-xl">
                        <figure>
                            <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : asset('images/default-course.jpg') }}"
                                alt="{{ $course->title }}" class="rounded-xl" />
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Lessons List -->
            <div class="w-full">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Materi Pembelajaran</h2>
                        <div class="flex flex-col gap-4">
                            @forelse($course->lessons ?? [] as $lesson)
                                <div class="collapse bg-base-200">
                                    <input type="checkbox" />
                                    <div class="collapse-title text-xl font-medium flex items-center justify-between">
                                        <span>{{ $lesson->title }}</span>
                                        @if ($lesson->is_completed)
                                            <div class="badge badge-success gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    class="w-4 h-4 stroke-current">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                Selesai
                                            </div>
                                        @endif
                                    </div>
                                    <div class="collapse-content">
                                        <p class="mb-4">{{ $lesson->description ?? 'No description available' }}</p>
                                        <div class="flex flex-col gap-2">
                                            @foreach ($lesson->materials ?? [] as $material)
                                                <a href="{{ route('learning.material', $material) }}"
                                                    class="btn btn-outline btn-primary">
                                                    {{ $material->title }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert">
                                    <span>Belum ada materi yang tersedia.</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
