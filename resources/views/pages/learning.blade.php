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
                <!-- Nautika Course -->
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-6 pt-6">
                        <img src="{{ asset('images/learning/nautikakapalniaga.webp') }}" alt="Nautika"
                            class="rounded-xl h-48 w-full object-cover" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">
                            Nautika Kapal
                            <div class="badge badge-primary">Kejuruan</div>
                        </h2>
                        <p>Pembelajaran tentang navigasi, keselamatan pelayaran, dan penanganan muatan kapal.</p>
                        <div class="card-actions justify-end mt-4">
                            <a href="#" class="btn btn-primary">Masuk Kelas</a>
                        </div>
                    </div>
                </div>

                <!-- Teknika Course -->
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-6 pt-6">
                        <img src="{{ asset('images/learning/teknikakapalniaga.webp') }}" alt="Teknika"
                            class="rounded-xl h-48 w-full object-cover" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">
                            Teknika Kapal
                            <div class="badge badge-primary">Kejuruan</div>
                        </h2>
                        <p>Pembelajaran tentang mesin kapal, sistem propulsi, dan perawatan mesin.</p>
                        <div class="card-actions justify-end mt-4">
                            <a href="#" class="btn btn-primary">Masuk Kelas</a>
                        </div>
                    </div>
                </div>

                <!-- Safety Course -->
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-6 pt-6">
                        <img src="{{ asset('images/learning/manajemenpelayaran.webp') }}" alt="Safety"
                            class="rounded-xl h-48 w-full object-cover" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">
                            Manajemen Pelayaran
                            <div class="badge badge-primary">Kejuruan</div>
                        </h2>
                        <p>Pembelajaran tentang prosedur keselamatan, penyelamatan, dan tanggap darurat.</p>
                        <div class="card-actions justify-end mt-4">
                            <a href="#" class="btn btn-primary">Masuk Kelas</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Learning Resources -->
            <div class="mt-16">
                <h2 class="text-3xl font-bold text-center mb-12">Sumber Belajar</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Video Tutorials -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Video Pengantar Materi</h3>
                            <div class="relative w-full" style="padding-top: 56.25%;">
                                <iframe 
                                    class="absolute top-0 left-0 w-full h-full rounded-lg"
                                    src="https://www.youtube.com/embed/RxwP_coJbQY?si=AY5JJcAPUE6LoxLo"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>

                    <!-- E-Books -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title mb-4">E-Book & Modul</h3>
                            <div class="flex flex-col justify-center items-center gap-10">
                                <div class="flex items-center gap-4 p-4 border rounded-lg w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <div>
                                        <h4 class="font-bold">Modul Nautika Dasar</h4>
                                        <a href="#" class="text-primary">Unduh PDF</a>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 p-4 border rounded-lg w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <div>
                                        <h4 class="font-bold">Modul Teknika Dasar</h4>
                                        <a href="#" class="text-primary">Unduh PDF</a>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 p-4 border rounded-lg w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <div>
                                        <h4 class="font-bold">Modul Manajemen Pelayaran Dasar</h4>
                                        <a href="#" class="text-primary">Unduh PDF</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
