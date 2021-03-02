<?php

return [

    'discord' => [
        'token' => env('DISCORD_BOT_TOKEN'),
        'channels' => [
            'notification' => env('DISCORD_NOTIFICATION_CHANNEL')
        ]
    ],

];
