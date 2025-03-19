<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class LibraryController extends Controller
{
    public function index()
    {
        $books = Library::latest()->paginate(10);
        return response()->json($books);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'publisher' => 'required|string|max:255',
                'publication_year' => 'required|integer|min:1900|max:2024',
                'isbn' => 'required|string|unique:libraries',
                'category' => 'required|string',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'cover_image' => 'nullable|image|max:2048',
                'file_path' => 'nullable|file|mimes:pdf|max:10240',
            ]);

            if ($request->hasFile('cover_image')) {
                $validated['cover_image'] = $request->file('cover_image')
                    ->store('covers', 'public');
            }

            if ($request->hasFile('file_path')) {
                $validated['file_path'] = $request->file('file_path')
                    ->store('books', 'public');
            }

            $book = Library::create($validated);

            return response()->json([
                'message' => 'Book created successfully',
                'data' => $book
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function show(Library $library)
    {
        return response()->json($library);
    }

    public function update(Request $request, Library $library)
    {
        try {
            $validated = $request->validate([
                'title' => 'sometimes|string|max:255',
                'author' => 'sometimes|string|max:255',
                'publisher' => 'sometimes|string|max:255',
                'publication_year' => 'sometimes|integer|min:1900|max:2024',
                'isbn' => 'sometimes|string|unique:libraries,isbn,' . $library->id,
                'category' => 'sometimes|string',
                'stock' => 'sometimes|integer|min:0',
                'description' => 'nullable|string',
                'cover_image' => 'nullable|image|max:2048',
                'file_path' => 'nullable|file|mimes:pdf|max:10240',
            ]);

            if ($request->hasFile('cover_image')) {
                if ($library->cover_image) {
                    Storage::disk('public')->delete($library->cover_image);
                }
                $validated['cover_image'] = $request->file('cover_image')
                    ->store('covers', 'public');
            }

            if ($request->hasFile('file_path')) {
                if ($library->file_path) {
                    Storage::disk('public')->delete($library->file_path);
                }
                $validated['file_path'] = $request->file('file_path')
                    ->store('books', 'public');
            }

            $library->update($validated);

            return response()->json([
                'message' => 'Book updated successfully',
                'data' => $library
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function destroy(Library $library)
    {
        if ($library->cover_image) {
            Storage::disk('public')->delete($library->cover_image);
        }
        if ($library->file_path) {
            Storage::disk('public')->delete($library->file_path);
        }
        
        $library->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ]);
    }

    public function search(Request $request)
    {
        $query = Library::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('author', 'like', "%{$searchTerm}%")
                    ->orWhere('isbn', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->has('category') && $request->category !== '') {
            $query->where('category', $request->category);
        }

        $books = $query->latest()->paginate(12)->withQueryString();
        
        if ($request->wantsJson()) {
            return response()->json($books);
        }
        
        return $books;
    }
}