<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\PermissionService;
use App\Services\UserService;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $params = $request->all();
        $users = $this->userService->index($params);

        return view('users.index', compact('params', 'users'));
    }
}
