<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\Collaborator;

class CollaboratorRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Collaborator();
    }

    public function index(int $idCompany, ?string $search = null)
    {
        $model = $this->model->where('id_company', $idCompany);
        
        if (!is_null($search)) {
            $model = $this->model->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('position', 'LIKE', '%' . $search . '%');
        }

        return $model->orderBy('name')->simplePaginate();
    }
}
