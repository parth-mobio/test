<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    public function store()
    {
        Book::create($this->validateReq());
    }

    public function update(Book $book)
    {
        $book->update($this->validateReq());
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
