@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
    <!-- Hero Section -->
    <div class="hero min-h-[40vh] mt-16 " style="background-image: url('{{ asset('images/contact/hero.webp') }}');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Kontak Kami</h1>
                <p class="mb-5">Hubungi kami untuk informasi lebih lanjut tentang program pendidikan di SMK Pelayaran</p>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <section class="relative w-full py-16 bg-base-100">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Contact Form -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-6">Kirim Pesan</h2>
                        <form action="#" method="POST">
                            @csrf
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Nama Lengkap</span>
                                </label>
                                <input type="text" name="name" class="input input-bordered w-full" required />
                            </div>
                            <div class="form-control w-full mt-4">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                </label>
                                <input type="email" name="email" class="input input-bordered w-full" required />
                            </div>
                            <div class="form-control w-full mt-4">
                                <label class="label">
                                    <span class="label-text">Subjek</span>
                                </label>
                                <input type="text" name="subject" class="input input-bordered w-full" required />
                            </div>
                            <div class="form-control w-full mt-4">
                                <label class="label">
                                    <span class="label-text">Pesan</span>
                                </label>
                                <x-forms.tinymce-editor />
                            </div>
                            <div class="form-control mt-6">
                                <button class="btn btn-primary">Kirim Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="space-y-8">
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-6">Informasi Kontak</h2>
                            <div class="space-y-4">
                                <div class="flex items-center gap-4">
                                    <div class="bg-primary p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-content"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold">Alamat</h3>
                                        <p>Panancangan, Kec. Cipocok Jaya, Kota Serang, Banten 42124</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="bg-primary p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-content"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold">Email</h3>
                                        <p>info@smkpelayaran.ac.id</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="bg-primary p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-content"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold">Telepon</h3>
                                        <p>(0254) 7931970</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-6">Lokasi Kami</h2>
                            <div class="w-full h-64 rounded-lg overflow-hidden">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d507791.270948234!2d105.85489179185353!3d-6.114637305392501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e41f5020f223dd7%3A0x58fe278450d9009f!2sSMK%20PELAYARAN%20NUSANTARA%20KOTA%20SERANG!5e0!3m2!1sid!2sid!4v1742119342792!5m2!1sid!2sid"
                                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/ve2qqaazqocqgb8o37h0111c82d6klelq4vf8w3zs44qmexx/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#message',
            height: 300,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }'
        });
    </script>
@endpush
