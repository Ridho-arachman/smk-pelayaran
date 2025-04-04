@extends('layouts.app')

@section('title', 'E-Learning')

@section('content')
    <!-- Hero Section -->
    <div class="hero min-h-[40vh] mt-16" style="background-image: url('{{ asset('images/learning/hero.webp') }}');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">E-Learning</h1>
                <p class="mb-5">Platform pembelajaran digital untuk siswa SMK Pelayaran</p>
            </div>
        </div>
    </div>

    <!-- Course Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Mata Pelajaran</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($enrolledCourses as $course)
                    <div class="card bg-base-100 shadow-xl">
                        <figure class="px-6 pt-6">
                            <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : asset('images/default-course.jpg') }}" 
                                alt="{{ $course->title }}"
                                class="rounded-xl h-48 w-full object-cover" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">
                                {{ $course->title }}
                                @if($course->teacher && $course->teacher->user)
                                    <div class="badge badge-primary">{{ $course->teacher->user->name }}</div>
                                @endif
                            </h2>
                            <p class="line-clamp-2">{{ $course->description ?? 'Tidak ada deskripsi' }}</p>
                            <div class="flex gap-2 mt-2">
                                <div class="badge badge-outline">{{ $course->lessons_count ?? 0 }} Materi</div>
                                <div class="badge badge-outline">{{ $course->materials_count ?? 0 }} Konten</div>
                            </div>
                            <div class="card-actions justify-end mt-4">
                                <a href="{{ route('learning.course', $course) }}" class="btn btn-primary">Masuk Kelas</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info shrink-0 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Belum ada mata pelajaran yang tersedia.</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Recent Materials -->
    <section class="py-16 bg-base-200">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Materi Terbaru</h2>
            
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Materi</th>
                            <th>Mata Pelajaran</th>
                            <th>Tipe</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentMaterials as $material)
                            <tr>
                                <td>{{ $material->title }}</td>
                                <td>{{ $material->lesson->title ?? 'Materi Tidak Tersedia' }}</td>
                                <td>{{ $material->lesson->course->title ?? 'Kelas Tidak Tersedia' }}</td>
                                <td>
                                    <div class="badge badge-{{ $material->type === 'document' ? 'warning' : ($material->type === 'video' ? 'success' : 'info') }}">
                                        {{ $material->type ?? 'link' }}
                                    </div>
                                </td>
                                <td>{{ $material->created_at ? $material->created_at->format('d M Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada materi terbaru</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
