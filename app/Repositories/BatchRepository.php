<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\Batch;

class BatchRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Batch();
    }

    public function index(int $idCompany)
    {
        return $this->model->with(['company', 'user'])
            ->where('id_company', $idCompany)
            ->orderBy('id', 'DESC')
            ->simplePaginate();
    }
}
