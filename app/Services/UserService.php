<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }
}
