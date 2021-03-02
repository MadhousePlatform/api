<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * First lets assert we have no users in our database.
     *
     * @return void
     */
    public function test_database_has_no_users(): void
    {
        $user = User::all();

        self::assertSame($user->count(), 0);
    }

    /**
     * Then lets test that we can create a user.
     * This is "pretty much" what graphql is calling, minus the fake data and
     * with a little more validation since it's calling the same validation
     * on the font-end. - Sketch, 2 Mar 2021
     *
     * @return void
     */
    public function test_create_user(): void
    {
        $new_user = [
            'password' => 'new-password',
        ];

        User::factory($new_user)->create();

        self::assertNotNull((new User)->find(1)->uuid);
    }

    /**
     * Let's test that the user can be authenticated.
     * This is rudimentary at best until there is proper
     * authentication stuff set up. - Sketch, 2 Mar 2021
     *
     * @todo make this a proper auth call rather than just use "actingAs".
     *
     * @return void
     */
    public function test_authenticate_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs((new User)->first());

        self::assertTrue(auth()->check());
        self::assertSame($user->uuid, auth()->user()->uuid);
    }
}
