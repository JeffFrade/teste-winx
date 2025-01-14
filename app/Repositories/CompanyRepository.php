<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\Company;

class CompanyRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Company();
    }
}
