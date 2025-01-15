<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\User;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new User();
    }

    public function index(string $search, int $idCompany)
    {
        $model = $this->model->where('id_company', $idCompany);

        if (!empty($search)) {
            $model = $model->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        }

        return $model->orderBy('name')
            ->simplePaginate();
    }
}
