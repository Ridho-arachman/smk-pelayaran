@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
    <!-- Hero Section -->
    <div class="hero min-h-[60vh]" style="background-image: url('{{ asset('images/about/hero.webp') }}');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Tentang Kami</h1>
                <p class="mb-5">Membentuk Generasi Pelaut Profesional yang Berkompeten dan Berintegritas</p>
            </div>
        </div>
    </div>

    <!-- Visi Misi Section -->
    <section class="relative w-full py-16 bg-base-100">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="card bg-primary text-primary-content">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-4">Visi</h2>
                        <p>Menjadi lembaga pendidikan maritim terkemuka yang menghasilkan pelaut profesional berkelas dunia
                            dengan standar kompetensi internasional.</p>
                    </div>
                </div>
                <div class="card bg-secondary text-secondary-content">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-4">Misi</h2>
                        <ul class="list-disc list-inside space-y-2">
                            <li>Menyelenggarakan pendidikan maritim berkualitas</li>
                            <li>Mengembangkan kurikulum berbasis industri</li>
                            <li>Menyediakan fasilitas praktik modern</li>
                            <li>Membangun kerjasama dengan industri pelayaran</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sejarah Section -->
    <section class="relative w-full py-16 bg-base-200">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Sejarah Kami</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="prose max-w-none">
                    <p class="text-lg mb-4">
                        SMK Pelayaran didirikan pada tahun 1990 dengan visi untuk memenuhi kebutuhan tenaga pelaut
                        profesional di Indonesia. Selama lebih dari 30 tahun, kami telah menghasilkan ribuan lulusan yang
                        kini berkarir di berbagai perusahaan pelayaran nasional dan internasional.
                    </p>
                    <p class="text-lg">
                        Dengan dukungan fasilitas modern dan tenaga pengajar berpengalaman, kami terus berkomitmen untuk
                        menghasilkan lulusan berkualitas yang siap bersaing di industri maritim global.
                    </p>
                </div>
                <div class="card bg-base-100 shadow-xl">
                    <figure class="h-64">
                        <img src="{{ asset('images/about/history.webp') }}" alt="Sejarah"
                            class="w-full h-full object-cover" />
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <!-- Tim Pengajar Section -->
    <section class="relative w-full py-16 bg-base-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Tim Pengajar</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <div class="avatar">
                            <div class="w-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="{{ asset('images/about/teacher1.webp') }}" />
                            </div>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h2 class="card-title">Capt. Budi Santoso</h2>
                        <p class="text-sm">Kepala Program Nautika</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <div class="avatar">
                            <div class="w-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="{{ asset('images/about/teacher2.webp') }}" />
                            </div>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h2 class="card-title">Ir. Ahmad Wijaya</h2>
                        <p class="text-sm">Kepala Program Teknika</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <div class="avatar">
                            <div class="w-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="{{ asset('images/about/teacher3.webp') }}" />
                            </div>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h2 class="card-title">Dr. Ahmad Wijaya</h2>
                        <p class="text-sm">Kepala Program Manajemen</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <div class="avatar">
                            <div class="w-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="{{ asset('images/about/teacher4.webp') }}" />
                            </div>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h2 class="card-title">Capt. Rudi Hartono</h2>
                        <p class="text-sm">Instruktur Senior</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
