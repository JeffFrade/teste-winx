<?php

namespace App\Services;

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
}
