<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('permission:create-permission "admin" web');
        Artisan::call('permission:create-permission "user" web');

        $user = (new \App\Repositories\UserRepository())->findFirst('id', 1);

        $user->givePermissionTo([
            'admin'
        ]);
    }
}
