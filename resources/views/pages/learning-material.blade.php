@extends('layouts.app')

@section('title', $material->title)

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto">
            <!-- Judul Materi -->
            <h1 class="text-3xl font-bold mb-4">{{ $material->title }}</h1>

            <!-- Tipe materi -->
            <p class="mb-6 text-sm text-gray-500">
                Tipe Materi:
                <span class="font-semibold capitalize">{{ $material->type }}</span>
            </p>

            <!-- Konten berdasarkan tipe -->
            @switch($material->type)
                @case('text')
                    @if ($material->content)
                        <div class="prose max-w-none">
                            {!! nl2br(e($material->content)) !!}
                        </div>
                    @else
                        <p class="text-gray-500">Konten teks belum tersedia.</p>
                    @endif
                @break

                @case('video')
                    @if ($material->file_path)
                        <div class="aspect-video">
                            <iframe class="w-full rounded-lg shadow h-full"
                                src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::afterLast($material->file_path, 'v=') }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @else
                        <p class="text-gray-500">Dokumen belum tersedia.</p>
                    @endif
                @break

                @case('document')
                    @if ($material->file_path)
                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank"
                            class="btn btn-outline btn-primary mb-4">
                            📄 Buka Dokumen
                        </a>
                    @else
                        <p class="text-gray-500">Dokumen belum tersedia.</p>
                    @endif
                @break

                @default
                    <p class="text-gray-500">Tipe materi tidak dikenali.</p>
            @endswitch

            <!-- Navigasi Kembali -->
            <div class="mt-6">
                <a href="javascript:history.back()" class="btn btn-sm btn-secondary">← Kembali ke materi</a>
            </div>
        </div>
    </div>
@endsection
