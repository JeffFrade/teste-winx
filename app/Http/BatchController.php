<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\BatchService;

class BatchController extends Controller
{
    private $batchService;

    public function __construct(BatchService $batchService)
    {
        $this->batchService = new BatchService();
    }

    public function index()
    {
        $batches = $this->batchService->index();

        return view('batches.index', compact('batches'));
    }
}
