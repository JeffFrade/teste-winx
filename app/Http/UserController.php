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

    public function create()
    {
        $permissions = $this->permissionService->getPermissions();

        return view('users.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $params = $this->toValidate($request);

        $user = $this->userService->store($params);

        return redirect(route('home.users.index'))
            ->with('message', 'Usuário cadastrado com sucesso!');
    }

    protected function toValidate(Request $request, bool $isUpdate = false, ?int $id = null)
    {
        $passwordField = ($isUpdate ? 'nullable' : 'required');
        $permissionField = ($isUpdate ? 'nullable' : 'required');

        $toValidateArr = [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,' . $id,
            'permission' => $permissionField . '|max:255',
            'password' => $passwordField . '|min:8',
        ];

        return $this->validate($request, $toValidateArr);
    }
}
