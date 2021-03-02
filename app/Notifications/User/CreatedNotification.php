<?php

namespace App\Notifications\User;

use App\App;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class CreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var User
     */
    public User $user;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct( User $user )
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via( $notifiable ): array
    {
        return [DiscordChannel::class];
    }

    /**
     * Get the Discord representation of the notification.
     *
     * @param mixed $notifiable
     * @return DiscordMessage
     * @todo Profile url
     */
    public function toDiscord( $notifiable ): DiscordMessage
    {
        if ( App::showDebugNotifications() ) {
            return DiscordMessage::create(
                null,
                [
                    'title' => 'A new user has been created.',
                    'type' => 'rich',
                    'description' => sprintf('A new user account has been created on %s', config('app.name')),
                    'url' => url('/profile/' . $this->user->uuid),
                    'timestamp' => Carbon::now(),
                    'color' => 11510755,
                    'footer' => [
                        'text' => 'Event::User::Created'
                    ],
                    'author' => [
                        'name' => 'Madhouse API',
                        'icon_url' => App::icon(),
                    ]
                ]
            );
        }
    }
}
