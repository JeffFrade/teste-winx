<?php

namespace Tests\Unit\Util;

use App\Helpers\StringHelper;
use App\Models\User;

class AuthenticatedUser
{
    public static function getUser(int $idCompany = 1)
    {
        return new User([
            'id' => 1000000,
            'id_company' => $idCompany,
            'name' => 'Test User',
            'email' => 'test@mail.com',
            'password' => StringHelper::hashPassword('123'),
            'active' => 1
        ]);
    }
}
