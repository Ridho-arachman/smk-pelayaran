<?php

namespace App\Http\Controllers;

use App\Models\PPDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PPDBController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'nisn' => 'required|string|unique:ppdb',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'email' => 'required|email|unique:ppdb',
            'phone' => 'required|string|max:20',
            'previous_school' => 'required|string|max:255',
            'major' => 'required|in:nautika,teknika',
            'photo' => 'required|image|max:2048',
            'certificate' => 'required|file|mimes:pdf|max:2048',
        ]);

        $validated['photo'] = $request->file('photo')->store('ppdb/photos', 'public');
        $validated['certificate'] = $request->file('certificate')->store('ppdb/certificates', 'public');
        
        PPDB::create($validated);

        return redirect()->route('ppdb')
            ->with('success', 'Pendaftaran berhasil! Silakan cek email Anda untuk informasi selanjutnya.');
    }
}