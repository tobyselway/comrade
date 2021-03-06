<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Vote extends JsonResource
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
                'type' => 'votes',
                'vote_id' => $this->id,
                'attributes' => [
                    'score' => $this->pivot->score
                ]
            ],
            'links' => [
                'self' => url('/posts/' . $this->pivot->post_id)
            ]
        ];
    }
}
