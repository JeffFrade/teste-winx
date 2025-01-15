<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService
{
    private $permissionRepository;

    public function __construct()
    {
        $this->permissionRepository = new PermissionRepository();
    }

    public function getPermissions()
    {
        return $this->permissionRepository->allNoTrashed();
    }
}
