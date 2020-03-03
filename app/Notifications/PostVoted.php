<?php

namespace App\Notifications;

use App\Vote;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PostVoted extends Notification
{
    use Queueable;

    private $vote;

    /**
     * Create a new notification instance.
     *
     * @param $vote
     */
    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $body = null;
        switch($this->vote->score) {
            case -1:
                $body = $this->vote->user->name . ' downvoted your post.';
                break;
            case 1:
                $body = $this->vote->user->name . ' upvoted your post.';
                break;
        }

        return [
            'type' => 'Vote on Post',
            'data' => [
                'body' => $body
            ]
        ];
    }
}
