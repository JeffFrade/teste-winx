<?php

namespace App\Services;

use App\Repositories\BatchInfoRepository;

class BatchInfoService
{
    private $batchInfoRepository;

    public function __construct()
    {
        $this->batchInfoRepository = new BatchInfoRepository();
    }
}
