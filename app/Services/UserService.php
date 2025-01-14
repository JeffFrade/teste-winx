<?php

namespace App\Services;

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
}
