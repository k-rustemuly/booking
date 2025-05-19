<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::exists()) {
            User::factory(1)->create(
                [
                    'email' => 'user@mail.com',
                    'password' => '123456'
                ]
            );
        }
    }
}
