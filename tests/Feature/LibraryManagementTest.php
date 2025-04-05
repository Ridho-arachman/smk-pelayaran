<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Library;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class LibraryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_add_new_book()
    {
        Storage::fake('public');
        
        /** @var \App\Models\User $admin */
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'gender' => 'male',
            'is_active' => true
        ]);

        $response = $this->actingAs($admin)->post('/admin/library', [
            'title' => 'New Book',
            'author' => 'Test Author',
            'isbn' => '9780123456789',
            'publication_year' => '2024',
            'publisher' => 'Test Publisher',
            'stock' => 5,
            'is_available' => true,
            'category' => 'fiction',
            'description' => 'Test description',
            'cover_image' => UploadedFile::fake()->image('book.jpg')
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('libraries', [
            'title' => 'New Book',
            'isbn' => '9780123456789'
        ]);
    }

    public function test_student_can_borrow_book()
    {
        /** @var \App\Models\User $student */
        $student = User::create([
            'name' => 'Student User',
            'email' => 'student@test.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'gender' => 'male',
            'is_active' => true
        ]);

        $book = Library::create([
            'title' => 'Test Book',
            'author' => 'Test Author',
            'isbn' => '9780123456789',
            'publication_year' => '2024',
            'publisher' => 'Test Publisher',
            'stock' => 1,
            'is_available' => true,
            'category' => 'fiction',
            'description' => 'Test description',
            'cover_image' => 'books/test-cover.jpg'
        ]);

        $response = $this->actingAs($student)->post('/library/borrow', [
            'book_id' => $book->id
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('book_loans', [
            'user_id' => $student->id,
            'library_id' => $book->id,
            'status' => 'borrowed'
        ]);
    }
}