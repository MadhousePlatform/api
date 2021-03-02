MadApi
======

[![MadAPI](https://github.com/MadhousePlatform/api/actions/workflows/laravel.yml/badge.svg?branch=main)](https://github.com/MadhousePlatform/api/actions/workflows/madhouseapi.yml)

The Madhouse API

Useful urls:

- [Telescope](http://localhost/telescope)
- [Mailhog](http://localhost:8025)
- [Websockets](http://localhost/ws)

## Installation

Create the environment file and configure it.
```shell
> cp .env.example .env
```

Next, get Laravel Sail running
```shell
> ./vendor/bin/sail up 
```
To run the docker environments in the background add the `-d` flag.

Some handy bash aliases that'll help with cmd line stuff.
```shell
alias sail="./vendor/bin/sail"
alias phpunit="sail artisan test"
alias dusk="sail dusk"
alias tests="phpunit ; dusk"
alias start="sail up -d"
alias stop="sail down"
alias ide="sail artisan ide-helper:generate ; sail artisan ide-helper:meta ; sail artisan ide-helper:models -W"
alias ziggy="sail artisan ziggy:generate"
```

From here, you want to edit the User Seeder to contain your details.
This file is located `database/seeders/DatabaseSeeder.php`.

Then run the database migrations and seed the database with test data.
```shell
> sail artisan migrate:fresh --seed
```

### Notes

- I have ripped out all of the laravel front-end stuff since I intended to
use it only for the API.
  
- To authenticate the front-end, see the following documentation: https://laravel.com/docs/8.x/sanctum


