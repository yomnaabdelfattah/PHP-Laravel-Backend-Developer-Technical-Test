<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        //retreiving posts and their comments
        $posts = Post::with('comments')->get();
        return response()->json($posts);  
    }

public function store(Request $request)
{
    //make sure of data before storing
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    //saving posts with user's data
    $post = Post::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'content' => $request->content,
    ]);

    //successful response
    return response()->json($post, 201);
}

public function show(Post $post)
{
    //retreiving comments
    return $post->load('comments');
}

public function update(Request $request, Post $post)
{ 
    //make sure of data when updating posts
    $request->validate([
        'title' => 'sometimes|required|string|max:255',
        'content' => 'sometimes|required|string',
    ]);
    //saving post update
    $post->update($request->only(['title', 'content']));
    //succesful post update
    return response()->json($post, 200);
}

public function destroy(Post $post)
{
    //delet a post
    $post->delete();
    return response()->json(null, 204);
}

}
