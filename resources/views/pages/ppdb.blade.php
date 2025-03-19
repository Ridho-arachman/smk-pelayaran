@extends('layouts.app')

@section('title', 'Pendaftaran Siswa Baru')

@section('content')
    <!-- Hero Section -->
    <div class="hero min-h-[40vh] mt-16" style="background-image: url('{{ asset('images/ppdb/hero.webp') }}');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">PPDB Online</h1>
                <p class="mb-5">Pendaftaran Peserta Didik Baru SMK Pelayaran</p>
            </div>
        </div>
    </div>

    <!-- Registration Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <!-- Information Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="card bg-primary text-primary-content">
                    <div class="card-body">
                        <h2 class="card-title">Alur Pendaftaran</h2>
                        <ol class="list-decimal list-inside">
                            <li>Daftar Akun</li>
                            <li>Isi Formulir</li>
                            <li>Upload Berkas</li>
                            <li>Verifikasi Data</li>
                            <li>Pengumuman</li>
                        </ol>
                    </div>
                </div>
                <div class="card bg-secondary text-secondary-content">
                    <div class="card-body">
                        <h2 class="card-title">Jadwal Penting</h2>
                        <ul class="space-y-2">
                            <li>Pendaftaran: 1 - 30 Juni 2024</li>
                            <li>Seleksi: 1 - 7 Juli 2024</li>
                            <li>Pengumuman: 10 Juli 2024</li>
                            <li>Daftar Ulang: 11 - 15 Juli 2024</li>
                        </ul>
                    </div>
                </div>
                <div class="card bg-accent text-accent-content">
                    <div class="card-body">
                        <h2 class="card-title">Kontak Informasi</h2>
                        <ul class="space-y-2">
                            <li>Telp: (021) 1234567</li>
                            <li>WA: 0812-3456-7890</li>
                            <li>Email: ppdb@smkpelayaran.sch.id</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title text-2xl mb-6">Formulir Pendaftaran</h2>
                    <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <!-- Personal Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Nama Lengkap</span>
                                    <span class="label-text-alt text-error">*</span>
                                </label>
                                <input type="text" name="full_name" class="input input-bordered" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">NISN</span>
                                    <span class="label-text-alt text-error">*</span>
                                </label>
                                <input type="text" name="nisn" class="input input-bordered" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tempat Lahir</span>
                                    <span class="label-text-alt text-error">*</span>
                                </label>
                                <input type="text" name="birth_place" class="input input-bordered" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tanggal Lahir</span>
                                    <span class="label-text-alt text-error">*</span>
                                </label>
                                <input type="date" name="birth_date" class="input input-bordered" required>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                    <span class="label-text-alt text-error">*</span>
                                </label>
                                <input type="email" name="email" class="input input-bordered" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">No. Telepon</span>
                                    <span class="label-text-alt text-error">*</span>
                                </label>
                                <input type="tel" name="phone" class="input input-bordered" required>
                            </div>
                        </div>

                        <!-- School Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Asal Sekolah</span>
                                    <span class="label-text-alt text-error">*</span>
                                </label>
                                <input type="text" name="previous_school" class="input input-bordered" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Jurusan yang Dipilih</span>
                                    <span class="label-text-alt text-error">*</span>
                                </label>
                                <select name="major" class="select select-bordered" required>
                                    <option value="">Pilih Jurusan</option>
                                    <option value="nautika">Nautika Kapal Niaga</option>
                                    <option value="teknika">Teknika Kapal Niaga</option>
                                </select>
                            </div>
                        </div>

                        <!-- Documents Upload -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Foto (3x4)</span>
                                    <span class="label-text-alt text-error">*</span>
                                </label>
                                <input type="file" name="photo" class="file-input file-input-bordered" accept="image/*" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Ijazah/SKL</span>
                                    <span class="label-text-alt text-error">*</span>
                                </label>
                                <input type="file" name="certificate" class="file-input file-input-bordered" accept=".pdf" required>
                            </div>
                        </div>

                        <div class="form-control mt-6">
                            <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection