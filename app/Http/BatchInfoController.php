<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Exceptions\BatchNotFoundException;
use App\Services\BatchInfoService;
use App\Services\BatchService;
use Illuminate\Http\Request;

class BatchInfoController extends Controller
{
    private $batchInfoService;
    private $batchService;

    public function __construct(
        BatchInfoService $batchInfoService,
        BatchService $batchService
    )
    {
        $this->batchInfoService = $batchInfoService;
        $this->batchService = $batchService;
    }

    public function show(Request $request, int $id)
    {
        try {
            $params = $request->all();
            $this->batchService->checkBatch($id);
            $infos = $this->batchInfoService->show($id, $params);

            return view('batch_infos.show', compact('infos', 'id', 'params'));
        } catch (BatchNotFoundException $e) {
            return redirect(route('home.batches.index'))
                ->with('error', $e->getMessage());
        }
    }
}
