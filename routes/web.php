<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\AuthController;

// Static Pages
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Auth Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    // Library Routes
    Route::prefix('library')->group(function () {
        Route::get('/', [LibraryController::class, 'index'])->name('library');
        Route::get('/search', [LibraryController::class, 'index'])->name('library.search');
        Route::get('/{library}', [LibraryController::class, 'show'])->name('library.show');
        Route::get('/{library}/read', [LibraryController::class, 'read'])->name('library.read');
        Route::get('/library/{library}/detail', [LibraryController::class, 'detail'])->name('library.detail');
    });

    // Learning Routes
    Route::prefix('learning')->group(function () {
        Route::get('/', [LearningController::class, 'index'])->name('learning');
        Route::get('/course/{course}', [LearningController::class, 'course'])->name('learning.course');
        Route::get('/material/{material}', [LearningController::class, 'material'])->name('learning.material');
    });
});

// PPDB Routes
Route::prefix('ppdb')->group(function () {
    Route::get('/', [PPDBController::class, 'index'])->name('ppdb');
    Route::post('/store', [PPDBController::class, 'store'])->name('ppdb.store');
    Route::post('/check', [PPDBController::class, 'check'])->name('ppdb.check');
    Route::get('/status', [PPDBController::class, 'status'])->name('ppdb.status');
});
