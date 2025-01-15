<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Exceptions\UserNotFoundException;
use App\Services\PermissionService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $this->userService->store($params);

        return redirect(route('home.users.index'))
            ->with('message', 'Usuário cadastrado com sucesso!');
    }

    public function edit(int $id)
    {
        try {
            $permissions = $this->permissionService->getPermissions();
            $user = $this->userService->edit($id);

            return view('users.edit', compact('permissions', 'user'));
        } catch (UserNotFoundException $e) {
            $route = Auth::user()->can('admin') ? 'home.users.index' : 'home';

            return redirect(route($route))
                ->with('error', $e->getMessage());
        }
    }

    public function profile()
    {
        return $this->edit(Auth::user()->id);
    }

    public function update(Request $request, int $id)
    {
        try {
            $params = $this->toValidate($request, true, $id);
            $this->userService->update($params, $id);

            $route = Auth::user()->can('admin') ? 'home.users.index' : 'home';

            return redirect(route($route))
                ->with('message', 'Usuário atualizado com sucesso!');
        } catch (UserNotFoundException $e) {
            return redirect(route('home.users.index'))
                ->with('error', $e->getMessage());
        }
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
