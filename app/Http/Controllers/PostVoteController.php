<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationErrorException;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\VoteCollection;
use App\Notifications\PostVoted;
use App\Post;
use App\Vote;
use Illuminate\Http\Request;

class PostVoteController extends Controller
{

    public function store(Post $post, Request $request) {
        if($request->score != 1 && $request->score != -1 && $request->score != 0) {
            throw new ValidationErrorException();
        }

        $vote = Vote::where('post_id', $post->id)
            ->where('user_id', auth()->user()->id)
            ->get()->first();

        if($request->score == 0) {
            $vote->delete();
        } else {
            if(!$vote) $vote = Vote::create([
                'user_id' => auth()->user()->id,
                'post_id' => $post->id
            ]);

            $vote->score = $request->score;
            $vote->save();

            $vote->post->user->notify(new PostVoted($vote));
        }

        $post->refresh();

        return new PostResource($post);
    }

}
