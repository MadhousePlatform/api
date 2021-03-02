<?php

namespace App\Listeners\Hook\Agent\Issue;

use App\Models\User;
use App\Notifications\Hook\Agent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class Notify implements ShouldQueue
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
        $this->notifyAdministrators($event);

        $user = User::all()->first();
        Notification::send($user, new Agent\Issue\DiscordNotification($event));
    }

    /**
     * Find and notify any user who is an administrator.
     *
     * @param object $event
     */
    private function notifyAdministrators(object $event): void
    {
        $admins = User::whereAdmin(true)->get();

        foreach( $admins as $admin ) {
            $admin->notify(new Agent\Issue\EmailNotification($event));
        }
    }
}
