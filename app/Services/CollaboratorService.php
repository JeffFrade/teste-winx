<?php

namespace App\Services;

use App\Exceptions\CollaboratorNotFoundException;
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

    public function edit(int $id)
    {
        $collaborator = $this->collaboratorRepository->findFirst('id', $id);

        if (empty($collaborator) || ($collaborator->id_account ?? '') != Auth::user()->id_account) {
            throw new CollaboratorNotFoundException('Colaborador Inexistente', 404);
        }

        return $collaborator;
    }

    public function status(int $id)
    {
        $collaborator = $this->edit($id);
        $message = 'Colaborador inativado com sucesso!';
        $active = 0;

        if (!$collaborator->active) {
            $message = 'Colaborador ativado com sucesso!';
            $active = 1;
        }

        $this->collaboratorRepository->update([
            'active' => $active
        ], $id);
        
        return $message;
    }
}
