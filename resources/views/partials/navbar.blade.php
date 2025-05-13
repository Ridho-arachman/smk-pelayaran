<div class="navbar bg-base-100 shadow-lg fixed z-50 top-0 right-0 left-0">
    <div class="navbar-start">
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </label>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="{{ route('home') }}"
                        class="{{ Route::currentRouteName() === 'home' ? 'bg-slate-500' : '' }}">Beranda</a></li>
                
                <li>
                    <a class="{{ Route::currentRouteName() === 'about' ? 'bg-slate-500' : '' }}">
                        Tentang Kami
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    <ul class="p-2 bg-base-100 z-[2]">
                        <li><a href="{{ route('about') }}">Profil Sekolah</a></li>
                        <li><a href="{{ route('about') }}#visi-misi">Visi & Misi</a></li>
                        <li><a href="{{ route('about') }}#sejarah">Sejarah</a></li>
                        <li><a href="{{ route('about') }}#tim-pengajar">Tim Pengajar</a></li>
                    </ul>
                </li>
                
                <li><a href="{{ route('contact') }}"
                        class="{{ Route::currentRouteName() === 'contact' ? 'bg-slate-500' : '' }}">Kontak</a></li>
                <li><a href="{{ route('ppdb') }}"
                        class="{{ Route::currentRouteName() === 'ppdb' ? 'bg-slate-500' : '' }}">PPDB</a></li>
                @auth
                    <li><a href="{{ route('learning') }}"
                            class="{{ Route::currentRouteName() === 'learning' ? 'bg-slate-500' : '' }}">E-Learning</a></li>
                    <li><a href="{{ route('library') }}"
                            class="{{ Route::currentRouteName() === 'library' ? 'bg-slate-500' : '' }}">Perpustakaan</a>
                    </li>
                @endauth
            </ul>
        </div>
        <a href="/" class="btn btn-ghost normal-case text-xl">
            <img src={{ asset('favicon-32x32.png') }} alt="">SMK Pelayaran
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="{{ route('home') }}"
                    class="{{ Route::currentRouteName() === 'home' ? 'bg-slate-500' : '' }}">Beranda</a></li>
            
            <li>
                <details>
                    <summary class="{{ Route::currentRouteName() === 'about' ? 'bg-slate-500' : '' }}">Tentang Kami</summary>
                    <ul class="p-2 bg-base-100 z-[2]">
                        <li><a href="{{ route('about') }}">Profil Sekolah</a></li>
                        <li><a href="{{ route('about') }}#visi-misi">Visi & Misi</a></li>
                        <li><a href="{{ route('about') }}#sejarah">Sejarah</a></li>
                        <li><a href="{{ route('about') }}#tim-pengajar">Tim Pengajar</a></li>
                    </ul>
                </details>
            </li>
            
            <li><a href="{{ route('contact') }}"
                    class="{{ Route::currentRouteName() === 'contact' ? 'bg-slate-500' : '' }}">Kontak</a></li>
            <li><a href="{{ route('ppdb') }}"
                    class="{{ Route::currentRouteName() === 'ppdb' ? 'bg-slate-500' : '' }}">PPDB</a></li>
            @auth
                <li><a href="{{ route('learning') }}"
                        class="{{ Route::currentRouteName() === 'learning' ? 'bg-slate-500' : '' }}">E-Learning</a></li>
                <li><a href="{{ route('library') }}"
                        class="{{ Route::currentRouteName() === 'library' ? 'bg-slate-500' : '' }}">Perpustakaan</a></li>
            @endauth
        </ul>
    </div>
    <div class="navbar-end flex gap-6 justify-end items-center">


        @auth
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost">
                    <span>{{ Auth::user()->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </label>
                <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-left text-error">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary rounded hidden md:flex">Login</a>
        @endauth
    </div>
</div>

<!-- Theme toggle script remains unchanged -->
