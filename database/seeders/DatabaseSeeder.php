<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'uuid' => Uuid::uuid4(),
            'name' => "",
            'username' => "",
            'email' => "",
            'admin' => true,
            'password' => '',
            'remember_token' => Str::random(10),
        ]);
        User::factory(10)->create();
    }
}
