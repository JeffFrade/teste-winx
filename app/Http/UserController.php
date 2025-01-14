<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\PermissionService;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;
    private $permissionService;

    public function __construct(
        UserService $userService,
        PermissionService $permissionService
    )
    {
        $this->userService = $userService;
        $this->permissionService = $permissionService;
    }
}
