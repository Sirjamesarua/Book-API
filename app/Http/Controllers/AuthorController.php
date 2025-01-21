<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use Illuminate\Http\Request;
// use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{

    public function index()
    {
        return response()->json(Author::with('books')->paginate(10));
    }

    // public function store(StoreAuthorRequest $request)
    // {
    //     $author = Author::create($request->validated());
    //     return response()->json($author, 201);
    // }

    public function show(Author $author)
    {
        return response()->json($author->load('books'));
    }
}
