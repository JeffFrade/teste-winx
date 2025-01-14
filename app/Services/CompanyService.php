<?php

namespace App\Services;

use App\Helpers\StringHelper;
use App\Repositories\CompanyRepository;

class CompanyService
{
    private $companyRepository;

    public function __construct()
    {
        $this->companyRepository = new CompanyRepository();
    }

    public function store(array $data)
    {
        dump($data);
        $data['document'] = StringHelper::replaceRegex($data['document'], '/\D/i', '');

        return $this->companyRepository->create($data);
    }
}
