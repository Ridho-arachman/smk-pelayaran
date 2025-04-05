<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Library;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LibraryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_book()
    {
        $bookData = [
            'title' => 'Test Book',
            'author' => 'Test Author',
            'isbn' => '9780123456789',
            'publication_year' => '2024',
            'publisher' => 'Test Publisher',
            'stock' => 5,
            'is_available' => true,
            'category' => 'fiction',
            'description' => 'Test book description',
            'cover_image' => 'books/test-cover.jpg'
        ];

        Library::create($bookData);

        $this->assertDatabaseHas('libraries', [
            'title' => 'Test Book',
            'isbn' => '9780123456789',
            'description' => 'Test book description'
        ]);
    }



    public function test_book_has_unique_isbn()
    {
        $book1 = Library::create([
            'title' => 'Test Book 1',
            'author' => 'Test Author',
            'isbn' => '9780123456787',
            'publication_year' => '2024',
            'publisher' => 'Test Publisher',
            'stock' => 5,
            'is_available' => true,
            'category' => 'fiction',
            'description' => 'Test book description',
            'cover_image' => 'books/test-book-1.jpg'
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        Library::create([
            'title' => 'Test Book 2',
            'author' => 'Test Author',
            'isbn' => '9780123456787', // Same ISBN as book1
            'publication_year' => '2024',
            'publisher' => 'Test Publisher',
            'stock' => 3,
            'is_available' => true,
            'category' => 'fiction',
            'description' => 'Another test book description'
        ]);
    }
}
