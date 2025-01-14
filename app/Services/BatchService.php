<?php

namespace App\Services;

use App\Repositories\BatchRepository;
use Illuminate\Support\Facades\Auth;

class BatchService
{
    private $batchRepository;

    public function __construct()
    {
        $this->batchRepository = new BatchRepository();
    }

    public function store()
    {
        return $this->batchRepository->create([
            'id_company' => Auth::user()->id_company,
            'id_user' => Auth::user()->id,
            'status' => 'C'
        ]);
    }

    public function changeStatus(int $id, string $status)
    {
        $this->batchRepository->update([
            'status' => $status
        ], $id);
    }
}
