<?php

namespace App\Http\Resources;

use App\Vote;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'posts',
                'post_id' => $this->id,
                'attributes' => [
                    'body' => $this->body,
                    'image' => $this->image ? url($this->image) : null,
                    'posted_at' => $this->created_at->diffForHumans(),
                    'score' => Vote::where('post_id', $this->id)->sum('score'),
                    'user_voted' => optional(Vote::where('post_id', $this->id)->where('user_id', auth()->user()->id)->get()->first())->score,
                    'posted_by' => new UserResource($this->user),
                    'votes' => new VoteCollection($this->votes),
                    'comments' => new CommentCollection($this->comments)
                ]
            ],
            'links' => [
                'self' => url('/posts/' . $this->id)
            ]
        ];
    }
}
