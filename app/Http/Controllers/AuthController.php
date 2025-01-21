<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(StoreAuthorRequest $request)
    {
        $validated = $request->validated();
        $author = Author::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'date_of_birth' => $validated['date_of_birth'],
            'password' => Hash::make($validated['password']),
        ]);


        $token = $author->createToken($author->email)->plainTextToken;

        return response()->json([
            'message' => 'Author successfully registered',
            'author' => $author,
            'token' => $token,
        ], 201);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:authors,email',
            'password' => 'required|string|min:8',
        ]);

        $author = Author::where('email', $credentials['email'])->first();

        if (!$author || !Hash::check($credentials['password'], $author->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $author->createToken($author->email)->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'author' => $author,
            'token' => $token,
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
