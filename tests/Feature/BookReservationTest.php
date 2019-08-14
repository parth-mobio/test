<?php

namespace Tests\Feature;
use App\Book;
use PHPUnit\Framework\TestResult;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function add_book_to_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post("/books", [
           "title" => "Book Title",
           "author" => "Myself"
        ]);
        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required()
    {
//        $this->withoutExceptionHandling();

        $response = $this->post("/books", [
            "title" => "",
            "author" => "Myself"
        ]);
        $response->assertSessionHasErrors('title');
//        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_author_is_required()
    {
//        $this->withoutExceptionHandling();

        $response = $this->post("/books", [
            "title" => "Book Title",
            "author" => ""
        ]);
        $response->assertSessionHasErrors('author');
//        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function update_book_in_library()
    {
        $this->withoutExceptionHandling();

      $this->post("/books", [
            "title" => "Book Title",
            "author" => "Myself"
        ]);

        $book = Book::first();

        $response = $this->patch('/books/'.$book->id,[
            "title" => "New Title",
            "author" => "New Author"
        ]);
//        $response->assertOk();
        $this->assertEquals("New Title", Book::first()->title);
        $this->assertEquals("New Author", Book::first()->author);
//        $this->assertCount(1, Book::all());
    }
}
