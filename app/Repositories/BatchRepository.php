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
}
