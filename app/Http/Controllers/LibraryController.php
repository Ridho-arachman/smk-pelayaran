<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\UserLibrary;
use Illuminate\Http\Request;
use App\Models\BookAccessLog;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $query = Library::query();

        // Search functionality for students
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Get all categories with book count
        $categories = Library::select('category')
            ->selectRaw('count(*) as book_count')
            ->groupBy('category')
            ->pluck('book_count', 'category')
            ->toArray();

        // Only show available books
        $books = $query->where('is_available', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('pages.library', compact('books', 'categories'));
    }

    public function read(Library $library)
    {
        $user = Auth::user();

        if ($library->type === 'digital' && in_array($user->role, ['student', 'teacher'])) {
            // Auto-create access if not exists
            UserLibrary::firstOrCreate([
                'user_id' => $user->id,
                'library_id' => $library->id,
            ], [
                'is_active' => true
            ]);
        }

        // Log student's access
        BookAccessLog::create([
            'user_id' => Auth::id(),
            'library_id' => $library->id,
            'accessed_at' => now(),
            'action' => 'view',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // For physical books, show details page
        if ($library->type === 'physical') {
            return view('pages.library-detail', compact('library'));
        }

        // For digital books, serve the file through route
        return redirect()->route('library.show', $library);
    }

    public function show(Library $library)
    {
        if ($library->type === 'physical') {
            return view('pages.library-detail', compact('library'));
        }

        return response()->file(storage_path('app/public/' . $library->file_path));
    }

    public function detail(Library $library)
    {
        return view('pages.library-detail', compact('library'));
    }
}
