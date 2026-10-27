<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::with('user')
            ->latest()
            ->get()
            ->map(fn (Post $post) => $this->formatPost($post));

        return response()->json($posts);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $post = Post::create([
            'post' => $validated['message'],
            'description' => $validated['message'],
            'status' => 'A',
            'user_id' => $request->user()?->id,
        ]);

        return response()->json($this->formatPost($post->load('user')), 201);
    }

    private function formatPost(Post $post): array
    {
        return [
            'id' => $post->id,
            'message' => $post->post,
            'created_at' => $post->created_at,
            'user' => $post->user ? [
                'name' => $post->user->name,
            ] : null,
        ];
    }
}
