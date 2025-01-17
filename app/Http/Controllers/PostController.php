<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\ActivityLog;

class PostController extends Controller
{

    private function logActivity($action)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'performed_at' => now(),
        ]);
    }

    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }


    public function getUserPosts()
    {
        $posts = Post::where('user_id', auth()->id())->get();

        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        $post = $request->user()->posts()->create($request->validated());

        $this->logActivity(auth()->user()->name . ' created a new post: ' . $post->title);

        return response()->json([
            'message' => 'Post created successfully.',
            'data' => $post
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found.'
            ], 404);
        }

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, PostUpdateRequest $postUpdateRequest)
    {
        $post = Post::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$post) {
            return response()->json(['error' => 'Unauthorized or post not found'], 403);
        }

        $post->update($postUpdateRequest->validated());
        $this->logActivity(auth()->user()->name . ' update a post: ' . $post->title);

        return response()->json([
            'message' => 'Post updated successfully',
            'post' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$post) {
            return response()->json(['error' => 'Unauthorized or post not found'], 403);
        }

        $post->delete();

        $this->logActivity(auth()->user()->name . ' Deleted a post: ' . $post->title);

        return response()->json([
            'message' => 'Post deleted successfully'
        ]);
    }
}
