<?php

namespace App\Services;

use App\Exceptions\BatchNotFoundException;
use App\Repositories\BatchRepository;
use Illuminate\Support\Facades\Auth;

class BatchService
{
    private $batchRepository;

    public function __construct()
    {
        $this->batchRepository = new BatchRepository();
    }

    public function index()
    {
        $idCompany = Auth::user()->id_company;

        return $this->batchRepository->index($idCompany);
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

    public function checkBatch(int $id)
    {
        $batch = $this->batchRepository->findFirst('id', $id);

        if (empty($batch) || ($batch->id_company ?? '') != Auth::user()->id_company) {
            throw new BatchNotFoundException('Lote inexistente.', 404);
        }

        return $batch;
    }
}
