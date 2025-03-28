<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\LibraryController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');
Route::get('/about', function () {
    return view('pages.about');
})->name('about');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
Route::get('/learning', function () {
    return view('pages.learning');
})->name('learning');

// Library Routes
Route::prefix('library')->group(function () {
    Route::get('/', [LibraryController::class, 'index'])->name('library');
    Route::get('/search', [LibraryController::class, 'index'])->name('library.search');
    Route::get('/{library}', [LibraryController::class, 'show'])->name('library.show');
    Route::get('/{library}/read', [LibraryController::class, 'read'])->name('library.read');
    Route::get('/library/{library}/detail', [LibraryController::class, 'detail'])->name('library.detail');
});

// Add this with your other routes
Route::get('/ppdb', function () {
    return view('pages.ppdb');
})->name('ppdb');

Route::post('/ppdb/store', [PPDBController::class, 'store'])->name('ppdb.store');
