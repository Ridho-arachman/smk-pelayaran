@extends('layouts.app')

@section('title', 'Home Page')



@section('content')
    <!-- Hero Section -->
    <div class="hero min-h-screen" style="background-image: url('{{ asset('images/home/hero.webp') }}');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">SMK Pelayaran</h1>
                <p class="mb-5">Membentuk Generasi Pelaut Profesional untuk Masa Depan Maritim Indonesia</p>
                <a class="btn btn-primary" href="{{ route('ppdb') }}">Daftar Sekarang</a>
            </div>
        </div>
    </div>

    <!-- Program Unggulan Section -->
    <div class="py-16 bg-base-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Program Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src={{ asset('images/home/nautikakapalniaga.webp') }} alt="Nautika" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Nautika Kapal Niaga</h2>
                        <p>Program keahlian yang fokus pada navigasi dan pengendalian kapal niaga.</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src={{ asset('images/home/teknikakapalniaga.webp') }} alt="Teknika" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Teknika Kapal Niaga</h2>
                        <p>Keahlian dalam pemeliharaan dan pengoperasian mesin kapal.</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src={{ asset('images/home/manajemenpelayaran.webp') }} alt="Pelayaran" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">Manajemen Pelayaran</h2>
                        <p>Fokus pada manajemen operasional dan bisnis pelayaran.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Keunggulan Section -->
    <div class="bg-base-200 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Mengapa Memilih Kami?</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-title">Lulusan Terserap</div>
                        <div class="stat-value">95%</div>
                        <div class="stat-desc">Bekerja di perusahaan pelayaran</div>
                    </div>
                </div>
                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-title">Pengajar Profesional</div>
                        <div class="stat-value">50+</div>
                        <div class="stat-desc">Berpengalaman di bidangnya</div>
                    </div>
                </div>
                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-title">Mitra Industri</div>
                        <div class="stat-value">30+</div>
                        <div class="stat-desc">Perusahaan pelayaran</div>
                    </div>
                </div>
                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-title">Fasilitas Modern</div>
                        <div class="stat-value">100%</div>
                        <div class="stat-desc">Standar internasional</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-16 bg-base-100">
        <div class="container mx-auto px-4">
            <div class="card lg:card-side bg-primary text-primary-content shadow-xl">
                <figure><img src={{ asset('images/home/cta.webp') }} alt="Maritime" /></figure>
                <div class="card-body">
                    <h2 class="card-title">Mulai Karirmu di Industri Maritim!</h2>
                    <p>Daftar sekarang dan jadilah bagian dari generasi pelaut profesional Indonesia.</p>
                    <div class="card-actions justify-end">
                        <a href="/contact" class="btn">Hubungi Kami</a>
                        <a href="{{ route('ppdb') }}" class="btn btn-secondary">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
