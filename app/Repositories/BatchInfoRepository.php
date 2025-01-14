<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\BatchInfo;

class BatchInfoRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new BatchInfo();
    }
}
