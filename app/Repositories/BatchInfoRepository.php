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

    public function show(int $id, ?string $search = null)
    {
        $model = $this->model->where('id', $id);

        if (!is_null($search)) {
            $model = $model->where('line_content', 'LIKE', '%' . $search . '%');
        }

        return $model->simplePaginate();
    }
}
