<?php

namespace Tests\Feature;
use App\Book;
use PHPUnit\Framework\TestResult;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function add_book_to_library()
    {
//        $this->withoutExceptionHandling();

        $response = $this->post("/books", [
           "title" => "Book Title",
           "author" => "Myself"
        ]);

        $book = Book::first();
//        $response->assertOk();
        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());

    }

    /** @test */
    public function a_title_is_required()
    {
////        $this->withoutExceptionHandling();

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
////        $this->withoutExceptionHandling();

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
//        $this->withoutExceptionHandling();

      $this->post("/books", [
            "title" => "Book Title",
            "author" => "Myself"
        ]);

        $book = Book::first();

        $response = $this->patch($book->path(),[
            "title" => "New Title",
            "author" => "New Author"
        ]);
//        dd($response);
//        $response->assertOk();
        $this->assertEquals("New Title", Book::first()->title);
        $this->assertEquals("New Author", Book::first()->author);
//        $this->assertCount(1, Book::all());
//        $response->assertRedirect($book->path());
        $response->assertRedirect($book->fresh()->path());

    }
    /** @test */
    public function book_can_be_deleted()
    {

//        $this->withoutExceptionHandling();

        $this->post("/books", [
            "title" => "Book Title",
            "author" => "Myself"
        ]);


        $book = Book::first();
        $this->assertCount(1, Book::all());

        $response = $this->delete($book->path());
        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');
    }
}
