@php
    use App\Models\Library;
@endphp

@extends('layouts.app')

@section('title', $library->title)

@section('content')
    <!-- Breadcrumbs -->
    <div class="bg-base-200 py-4 mt-16">
        <div class="container mx-auto px-4">
            <div class="text-sm breadcrumbs">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary">Beranda</a></li>
                    <li><a href="{{ route('library') }}" class="text-primary">Perpustakaan</a></li>
                    <li class="text-base-content">{{ $library->title }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Book Cover -->
            <div class="w-full md:w-1/3">
                <img src="{{ Storage::url($library->cover_image) }}" alt="{{ $library->title }}"
                    class="rounded-lg shadow-xl w-full object-cover bg-base-100">
            </div>

            <!-- Book Details -->
            <div class="w-full md:w-2/3">
                <h1 class="text-4xl font-bold mb-4 text-base-content">{{ $library->title }}</h1>
                <div class="space-y-4">
                    <p class="text-xl text-base-content/70">Oleh {{ $library->author }}</p>
                    <div class="badge badge-primary">{{ Library::getCategories()[$library->category] ?? $book->category }}
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-base-content/70">
                        <p>ISBN: {{ $library->isbn }}</p>
                        <p>Tahun Terbit: {{ $library->publication_year }}</p>
                        <p>Penerbit: {{ $library->publisher }}</p>
                        <div class="col-span-2 mt-2">
                            <div class="flex flex-col gap-2">
                                @if ($library->type === 'physical')
                                    <div class="flex items-center gap-2">
                                        <span class="badge badge-secondary">Buku Fisik</span>
                                        <span class="font-semibold">Stok: {{ $library->stock }} buku</span>
                                    </div>
                                    <div class="text-sm text-base-content/60">
                                        @if ($library->stock > 0)
                                            <p>✓ Tersedia untuk peminjaman di perpustakaan</p>
                                            <p class="mt-1">* Silakan kunjungi perpustakaan untuk melakukan peminjaman</p>
                                        @else
                                            <p>✗ Sedang tidak tersedia untuk peminjaman</p>
                                        @endif
                                    </div>
                                @else
                                    <div class="flex items-center gap-2">
                                        <span class="badge badge-success">E-Book</span>
                                        @if ($library->file_path)
                                            <span class="font-semibold">✓ Tersedia untuk dibaca online</span>
                                        @else
                                            <span class="font-semibold text-error">✗ E-Book sedang tidak tersedia</span>
                                        @endif
                                    </div>
                                    <div class="divider my-2"></div>
                                    <div class="flex items-center gap-2">
                                        <span class="badge badge-secondary">Versi Cetak</span>
                                        @if ($library->stock > 0)
                                            <span>Tersedia {{ $library->stock }} buku di perpustakaan</span>
                                            <p class="text-sm text-base-content/60 mt-1">* Kunjungi perpustakaan untuk
                                                peminjaman buku fisik</p>
                                        @else
                                            <span class="text-error">Stok buku fisik sedang kosong</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="prose dark:prose-invert max-w-none">
                        <h3 class="text-xl font-semibold mb-2 text-base-content">Deskripsi</h3>
                        <p class="text-base-content/80">{{ $library->description }}</p>
                    </div>

                    @if ($library->file_path)
                        <div class="mt-8">
                            <a href="{{ Storage::url($library->file_path) }}" target="_blank"
                                class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Baca E-Book
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
