<?php

namespace App\Services;

use App\Exceptions\UserDeleteYourselfException;
use App\Exceptions\UserNotFoundException;
use App\Helpers\StringHelper;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index(array $data)
    {
        $search = $data['search'] ?? '';

        $idCompany = Auth::user()->id_company;

        return $this->userRepository->index($search, $idCompany);
    }

    public function store(array $data)
    {
        $data['id_company'] = Auth::user()->id_company;
        $data['password'] = StringHelper::hashPassword($data['password']);
        $user = $this->userRepository->create($data);

        $user->givePermissionTo([
            $data['permission']
        ]);

        return $user;
    }

    public function edit(int $id)
    {
        $user = $this->userRepository->findFirst('id', $id);

        if (empty($user) || ($user->id_company ?? '') != Auth::user()->id_company) {
            throw new UserNotFoundException('Usuário inexistente.', 404);
        }

        return $user;
    }

    public function update(array $data, int $id)
    {
        $data['password'] = StringHelper::hashPassword($data['password'] ?? '');

        if (Auth::user()->cannot('admin') && Auth::user()->id != $id) {
            throw new UserNotFoundException();
        }

        $this->userRepository->update(array_filter($data), $id);
    }

    public function delete(int $id)
    {
        $user = $this->edit($id);

        if ($user->id == Auth::user()->id) {
            throw new UserDeleteYourselfException('Não é possível excluir a si mesmo. Solicite a outro usuário com perfil de administrador para efetuar essa operação.', 400);
        }

        $this->userRepository->delete($id);
    }
}
