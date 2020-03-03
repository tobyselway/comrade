<?php

namespace App\Notifications;

use App\Friend;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FriendshipRequested extends Notification
{
    use Queueable;

    private $friendship;

    /**
     * Create a new notification instance.
     *
     * @param Friend $friendship
     */
    public function __construct(Friend $friendship)
    {
        $this->friendship = $friendship;
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
        $body = $this->friendship->user->name . ' requested your friendship.';

        return [
            'type' => 'Friendship Request',
            'data' => [
                'body' => $body,
            ],
            'links' => [
                'user' => '/users/' . $this->friendship->user->id
            ]
        ];
    }
}
