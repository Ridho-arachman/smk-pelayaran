<?php

namespace App\Http\Controllers;

use App\Models\PPDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PPDBController extends Controller
{
    public function index()
    {
        return view('pages.ppdb');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => 'required|string|size:10|unique:ppdb',
            'email' => 'required|email|unique:ppdb',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'previous_school' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'address' => 'required|string',
            'documents.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Handle multiple document uploads
        $documents = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('ppdb/documents', 'public');
                $documents[] = [
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'type' => $file->getClientMimeType(),
                ];
            }
        }

        $validated['documents'] = $documents;
        $validated['status'] = 'pending';

        PPDB::create($validated);

        return redirect()->route('ppdb')
            ->with('success', 'Pendaftaran berhasil! Silakan tunggu informasi selanjutnya melalui email.');
    }

    public function check(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'required|string|size:10',
            'email' => 'required|email'
        ]);

        $registration = PPDB::where('nisn', $validated['nisn'])
            ->where('email', $validated['email'])
            ->first();

        if (!$registration) {
            return back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        return view('pages.ppdb-status', compact('registration'));
    }
}