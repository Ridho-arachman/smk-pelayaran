@extends('layouts.app')

@section('title', 'Status Pendaftaran')

@section('content')
    <div class="min-h-screen py-16 mt-16">
        <div class="container mx-auto px-4">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title text-2xl mb-6">Status Pendaftaran</h2>
                    
                    <div class="grid gap-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="font-semibold">Nomor Pendaftaran</h3>
                                <p>{{ $registration->registration_number }}</p>
                            </div>
                            <div>
                                <h3 class="font-semibold">Status</h3>
                                <div class="badge badge-{{ $registration->status === 'accepted' ? 'success' : ($registration->status === 'rejected' ? 'error' : 'warning') }}">
                                    {{ $registration->status === 'pending' ? 'Menunggu' : ($registration->status === 'accepted' ? 'Diterima' : 'Ditolak') }}
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="font-semibold">Nama Lengkap</h3>
                                <p>{{ $registration->name }}</p>
                            </div>
                            <div>
                                <h3 class="font-semibold">NISN</h3>
                                <p>{{ $registration->nisn }}</p>
                            </div>
                            <div>
                                <h3 class="font-semibold">Email</h3>
                                <p>{{ $registration->email }}</p>
                            </div>
                            <div>
                                <h3 class="font-semibold">No. Telepon</h3>
                                <p>{{ $registration->phone }}</p>
                            </div>
                        </div>

                        @if($registration->notes)
                            <div class="divider"></div>
                            <div>
                                <h3 class="font-semibold">Catatan</h3>
                                <p class="whitespace-pre-line">{{ $registration->notes }}</p>
                            </div>
                        @endif

                        @if($registration->status === 'accepted')
                            <div class="divider"></div>
                            <div class="alert alert-success">
                                <h3 class="font-semibold">Selamat! Anda diterima sebagai siswa baru.</h3>
                                <p>Silakan cek email Anda untuk informasi selanjutnya mengenai proses daftar ulang.</p>
                            </div>
                        @endif
                    </div>

                    <div class="card-actions justify-end mt-6">
                        <a href="{{ route('ppdb') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection