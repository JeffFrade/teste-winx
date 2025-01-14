<?php

namespace Database\Seeders;

use App\Helpers\StringHelper;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => StringHelper::hashPassword('123')
        ])->create();
    }
}
