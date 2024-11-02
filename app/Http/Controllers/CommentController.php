<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        //retreiving comments with their posts
        return $post->comments;
    }

    public function store(Request $request, Post $post)
    {
            //make sure of data before storing
        $request->validate([
            'content' => 'required|string',
        ]);

            //saving comments with post's and user's data
        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        //successful process
        return response()->json($comment, 201);
    }

    public function show(Post $post, Comment $comment)
    {
        //retreiving the comment
        return $comment;
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
            //make sure of data when updating posts
        $request->validate([
            'content' => 'sometimes|required|string',
        ]);

        $comment->update($request->only(['content']));
    //succesful comment update
        return response()->json($comment, 200);
    }

    public function destroy(Post $post, Comment $comment)
    {
        //comment deletion
        $comment->delete();
        return response()->json(null, 204);
    }
}
