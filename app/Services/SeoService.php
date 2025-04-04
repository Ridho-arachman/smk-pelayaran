<?php

namespace App\Services;

class SeoService
{
    public static function getMetadata($title = null, $description = null, $keywords = null)
    {
        return [
            'title' => $title ?? config('app.name') . ' - Sekolah Menengah Kejuruan Pelayaran',
            'description' => $description ?? 'SMK Pelayaran adalah lembaga pendidikan maritim yang mendidik calon pelaut profesional untuk masa depan maritim Indonesia.',
            'keywords' => $keywords ?? 'smk pelayaran, sekolah pelayaran, pendidikan maritim, nautika, teknika, manajemen pelayaran',
            'author' => 'SMK Pelayaran',
            'og_type' => 'website',
            'og_url' => url()->current(),
            'og_image' => asset('images/logo.png'),
            'twitter_card' => 'summary_large_image',
        ];
    }
}