<?php

namespace App\Services;

use App\Repositories\CollaboratorRepository;
use Illuminate\Support\Facades\Auth;

class CollaboratorService
{
    private $collaboratorRepository;

    public function __construct()
    {
        $this->collaboratorRepository = new CollaboratorRepository();
    }

    public function index(array $data)
    {
        $search = $data['search'] ?? null;
        $idCompany = Auth::user()->id_company;

        return $this->collaboratorRepository->index($idCompany, $search);
    }
}
