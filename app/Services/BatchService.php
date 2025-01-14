<?php

namespace App\Services;

use App\Repositories\BatchRepository;

class BatchService
{
    private $batchRepository;

    public function __construct()
    {
        $this->batchRepository = new BatchRepository();
    }
}
