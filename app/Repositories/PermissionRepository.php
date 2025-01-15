<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Permission();
    }
}
