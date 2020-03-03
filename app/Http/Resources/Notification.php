<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Notification extends JsonResource
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
                'type' => 'notifications',
                'notification_id' => $this->id,
                'time_ago' => $this->created_at->diffForHumans(),
                'attributes' => $this->data
            ],
            'links' => [
                'self' => url('/notifications/' . $this->id)
            ]
        ];
    }
}
