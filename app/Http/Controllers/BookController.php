<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\updateBookRequest;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::with('author')->paginate(10));
    }

    public function store(StoreBookRequest $request)
    {

        $book = $request->user()->books()->create($request->validated());
        return response()->json($book,201);
    }

    public function show(Book $book)
    {
        return response()->json($book->load('author'));
    }

    public function update(Book $book, updateBookRequest $request)
    {
        if (auth()->user()->id !== $book->author_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $book->update($request->validated());
        return response()->json($book);
    }

    public function destroy(Book $book)
    {
        if (auth()->user()->id !== $book->author_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $book->delete();
        return response()->json([
        'message' => "Book deleted"
        ], 200);
    }
}
