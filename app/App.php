<?php

namespace App;

class App {

    /**
     * MadAPI Version
     */
    public const VERSION = '1.0';

    /**
     * While debug mode is set to false, should we still send debug notifications to Discord/Admins?
     *
     * @return bool
     */
    public static function showDebugNotifications(): bool
    {
        return config('app.debug') || config('app.debug_notifications');
    }

    public static function icon(): string
    {
        return config('app.icon');
    }

}
