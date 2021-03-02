<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['name' => "string", 'username' => "string", 'email' => "string", 'password' => "string", 'admin' => "false"])]
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'username' => str_replace('.', '_', $this->faker->userName),
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'admin' => false,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified(): Factory
    {
        return $this->state(function ( array $attributes ) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
