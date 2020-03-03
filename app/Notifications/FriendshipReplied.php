<?php

namespace App\Notifications;

use App\Friend;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FriendshipReplied extends Notification
{
    use Queueable;

    private $friendship;
    private $confirmed;

    /**
     * Create a new notification instance.
     *
     * @param Friend $friendship
     * @param bool $confirmed
     */
    public function __construct(Friend $friendship, bool $confirmed)
    {
        $this->friendship = $friendship;
        $this->confirmed = $confirmed;
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
        if($this->confirmed) {
            $body = $this->friendship->friend->name . ' accepted your friendship.';
        } else {
            $body = $this->friendship->friend->name . ' rejected your friendship.';
        }

        return [
            'type' => 'Friendship Reply',
            'data' => [
                'body' => $body,
            ],
            'links' => [
                'friend' => '/users/' . $this->friendship->friend->id
            ]
        ];
    }
}
