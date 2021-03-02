<?php

namespace App\Observers\User;

use App\Events\User\CreatedEvent;
use App\Models\User;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\NoReturn;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\UserAccountException;
use Illuminate\Support\Facades\Validator;

class CreateObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created( User $user ): void
    {
        event(new CreatedEvent($user));
    }

    /**
     * @param $user
     * @throws UserAccountException
     */
    #[NoReturn]
    public function creating( $user ): void
    {
        $uuid = User::createUuid();

        $validation = Validator::make($user->getAttributes(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'username' => ['required', 'alpha_dash', 'unique:users', 'max:255'],
            'password' => ['required', 'min:6'],
        ]);

        if ( $validation->passes() ) {
            $user->uuid = $uuid;
            $user->password = Hash::make($user->password);
        } else {
            throw new UserAccountException($validation->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated( User $user ): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted( User $user ): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param User $user
     * @return void
     */
    public function restored( User $user ): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function forceDeleted( User $user ): void
    {
        //
    }
}
