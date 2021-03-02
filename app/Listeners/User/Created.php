<?php

namespace App\Listeners\User;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\CreatedNotification;

class Created implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle( object $event ): void
    {
        $user = User::all()->first();
        Notification::send($user, new CreatedNotification($event->user));
    }
}
