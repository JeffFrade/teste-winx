<?php

namespace App\Services;

use App\Repositories\CompanyRepository;

class CompanyService
{
    private $companyRepository;

    public function __construct()
    {
        $this->companyRepository = new CompanyRepository();
    }
}
