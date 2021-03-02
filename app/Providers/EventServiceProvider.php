<?php

namespace App\Providers;

use App\Models\User;
use App\Events\Hook as EventHook;
use App\Events\User as EventUser;
use App\Listeners\Hook as ListenHook;
use App\Listeners\User as ListenUser;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Observers\User\CreateObserver as UserCreateObserver;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        EventHook\Agent\Issue::class => [
            ListenHook\Agent\Issue\Notify::class,
        ],

        EventUser\CreatedEvent::class => [
            ListenUser\Created::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->observers();
    }

    /**
     * Return all event observers.
     *
     * @return void
     */
    private function observers(): void
    {
        User::observe(UserCreateObserver::class);
    }
}
