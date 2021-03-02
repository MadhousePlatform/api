<?php

namespace App\Notifications\Hook\Agent\Issue;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class DiscordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     *
     * @param object $event
     */
    public function __construct(object $event)
    {
        $this->data = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [DiscordChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return DiscordMessage
     */
    public function toDiscord($notifiable): DiscordMessage
    {
        return DiscordMessage::create(<<<TEXT
**An issue has been detected!**
{$this->data->issue}
{$this->data->message}
TEXT
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'title' => '**An issue has been detected!**',
            'issue' => $this->data->issue,
            'message' => $this->data->message
        ];
    }
}
