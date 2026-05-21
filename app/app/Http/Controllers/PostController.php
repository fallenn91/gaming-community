<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
          'content' => 'required|string',
          'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('image')) {
          $path = $request->file('image')->store('posts', 'public');
        }

          $posts = Post::create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
            'image' => $path,
          ]);
        
          return redirect()->back()->with('success', 'Post created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('user', 'comments.user', 'likes.user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);
        $post->update($request->only('content'));
        return redirect()->back()->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted successfully!');
    }
}
