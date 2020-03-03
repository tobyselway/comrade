<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\CommentCollection;
use App\Notifications\PostCommented;
use App\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{

    public function store(Post $post, Request $request) {
        $data = $request->validate([
            'body' => 'required'
        ]);

        $comment = $post->comments()->create(array_merge($data, [
            'user_id' => auth()->user()->id
        ]));

        $post->user->notify(new PostCommented($comment));

        return new CommentCollection($post->comments);
    }

}
