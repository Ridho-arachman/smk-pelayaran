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

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="alert alert-success mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Form Column -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-6">Formulir Pendaftaran</h2>
                        <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            
                            <!-- Form Sections -->
                            <div class="space-y-6">
                                <!-- Section: Data Pribadi -->
                                <div>
                                    <h3 class="text-lg font-medium border-b pb-2 mb-4">Data Pribadi</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">Nama Lengkap</span>
                                                <span class="label-text-alt text-error">*</span>
                                            </label>
                                            <input type="text" name="name" class="input input-bordered" required>
                                        </div>
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">NISN</span>
                                                <span class="label-text-alt text-error">*</span>
                                            </label>
                                            <input type="text" name="nisn" maxlength="10" class="input input-bordered" required>
                                        </div>
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
                                </div>
                                
                                <!-- Section: Data Kelahiran -->
                                <div>
                                    <h3 class="text-lg font-medium border-b pb-2 mb-4">Data Kelahiran</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">Jenis Kelamin</span>
                                                <span class="label-text-alt text-error">*</span>
                                            </label>
                                            <select name="gender" class="select select-bordered" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="male">Laki-laki</option>
                                                <option value="female">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">Asal Sekolah</span>
                                                <span class="label-text-alt text-error">*</span>
                                            </label>
                                            <input type="text" name="previous_school" class="input input-bordered" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Section: Data Orang Tua -->
                                <div>
                                    <h3 class="text-lg font-medium border-b pb-2 mb-4">Data Orang Tua</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">Nama Orang Tua</span>
                                                <span class="label-text-alt text-error">*</span>
                                            </label>
                                            <input type="text" name="parent_name" class="input input-bordered" required>
                                        </div>
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text">No. Telepon Orang Tua</span>
                                                <span class="label-text-alt text-error">*</span>
                                            </label>
                                            <input type="tel" name="parent_phone" class="input input-bordered" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Section: Alamat -->
                                <div>
                                    <h3 class="text-lg font-medium border-b pb-2 mb-4">Alamat</h3>
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text">Alamat Lengkap</span>
                                            <span class="label-text-alt text-error">*</span>
                                        </label>
                                        <textarea name="address" class="textarea textarea-bordered" rows="3" required></textarea>
                                    </div>
                                </div>
                                
                                <!-- Section: Dokumen -->
                                <div>
                                    <h3 class="text-lg font-medium border-b pb-2 mb-4">Dokumen Pendukung</h3>
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text">Dokumen Pendukung</span>
                                            <span class="label-text-alt text-error">*</span>
                                        </label>
                                        <input type="file" name="documents[]" class="file-input file-input-bordered w-full" multiple required>
                                        <label class="label">
                                            <span class="label-text-alt">Upload foto, scan ijazah/SKL, dan dokumen pendukung lainnya</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-control mt-6">
                                <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Status Check Column -->
                <div class="space-y-8">
                    <!-- Status Check Form -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-6">Cek Status Pendaftaran</h2>
                            <form action="{{ route('ppdb.check') }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text">NISN</span>
                                        </label>
                                        <input type="text" name="nisn" maxlength="10" class="input input-bordered" required>
                                    </div>
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text">Email</span>
                                        </label>
                                        <input type="email" name="email" class="input input-bordered" required>
                                    </div>
                                </div>
                                <div class="form-control">
                                    <button type="submit" class="btn btn-secondary">Cek Status</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Information Card -->
                    <div class="card bg-base-200 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-xl mb-4">Informasi Penting</h2>
                            <div class="space-y-4">
                                <div>
                                    <h3 class="font-medium">Persyaratan Dokumen:</h3>
                                    <ul class="list-disc list-inside text-sm mt-2">
                                        <li>Pas foto terbaru (3x4)</li>
                                        <li>Scan Ijazah/SKL</li>
                                        <li>Scan Kartu Keluarga</li>
                                        <li>Scan Akta Kelahiran</li>
                                        <li>Scan Kartu NISN</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="font-medium">Biaya Pendaftaran:</h3>
                                    <p class="text-sm mt-2">
                                        Biaya pendaftaran sebesar Rp 200.000 dapat dibayarkan melalui transfer bank ke rekening resmi sekolah.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection