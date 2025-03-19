@extends('layouts.app')

@section('title', 'Perpustakaan')

@section('content')
    <!-- Hero Section -->
    <div class="hero min-h-[40vh] mt-16" style="background-image: url('{{ asset('images/library/hero.webp') }}');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Perpustakaan Digital</h1>
                <p class="mb-5">Akses berbagai buku dan materi pembelajaran secara digital</p>
            </div>
        </div>
    </div>

    <!-- Library Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <!-- Search and Filter -->
            <div class="mb-8">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <form action="{{ route('library.search') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                            <div class="form-control flex-1">
                                <input type="text" name="search" placeholder="Cari buku..." 
                                    class="input input-bordered" value="{{ request('search') }}">
                            </div>
                            <div class="form-control w-full md:w-48">
                                <select name="category" class="select select-bordered w-full">
                                    <option value="">Semua Kategori</option>
                                    @foreach(['nautika', 'teknika', 'manajemen'] as $category)
                                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                            {{ ucfirst($category) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <span class="loading loading-spinner hidden"></span>
                                <span>Cari</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Books Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($books as $book)
                    <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                        @if($book->cover_image)
                            <figure class="px-4 pt-4">
                                <img src="{{ Storage::url($book->cover_image) }}" 
                                    alt="{{ $book->title }}" 
                                    class="rounded-xl h-64 w-full object-cover"
                                    loading="lazy">
                            </figure>
                        @endif
                        <div class="card-body">
                            <h2 class="card-title text-lg font-bold line-clamp-2">{{ $book->title }}</h2>
                            <p class="text-sm text-gray-500">Oleh {{ $book->author }}</p>
                            <div class="badge badge-primary">{{ ucfirst($book->category) }}</div>
                            <p class="mt-2 text-sm line-clamp-3">{{ $book->description }}</p>
                            <div class="card-actions justify-between items-center mt-4">
                                <div class="text-sm">
                                    <p>Stok: <span class="font-semibold">{{ $book->stock }}</span></p>
                                    <p class="text-gray-500 text-xs">ISBN: {{ $book->isbn }}</p>
                                </div>
                                @if($book->file_path && $book->is_available)
                                    <a href="{{ Storage::url($book->file_path) }}" 
                                        target="_blank" 
                                        class="btn btn-primary btn-sm hover:scale-105 transition-transform duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Baca Buku
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <h3 class="text-xl font-semibold">Tidak ada buku ditemukan</h3>
                        <p class="text-gray-500 mt-2">Coba ubah kriteria pencarian Anda</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $books->links() }}
            </div>
        </div>
    </section>
@endsection