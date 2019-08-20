<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    public function index()
    {
       echo '<pre>';
       print_r('sdfsdf');
       echo '</pre>';
    }
    public function store()
    {
        $book = Book::create($this->validateReq());
        return redirect($book->path());

    }

    public function update(Book $book)
    {
        $book->update($this->validateReq());
        return redirect($book->path());

    }
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/books');
    }

    /**
     * @return mixed
     * parthl
     */
    public function validateReq()
    {
        $data = \request()->validate([
            'title'  => 'required',
            'author' => 'required',
        ]);

        return $data;
    }
}
