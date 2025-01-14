<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;

class StringHelper
{
    public static function hashPassword(?string $password)
    {
        if (empty($password)) {
            return null;
        }

        return Hash::make($password);
    }
}
