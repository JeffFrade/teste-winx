<?php

namespace App\Services;

use App\Helpers\StringHelper;
use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Auth;

class CompanyService
{
    private $companyRepository;

    public function __construct()
    {
        $this->companyRepository = new CompanyRepository();
    }

    public function store(array $data)
    {
        $data['document'] = StringHelper::replaceRegex($data['document'], '/\D/i', '');

        return $this->companyRepository->create($data);
    }

    public function update(array $data)
    {
        $this->companyRepository->update($data, Auth::user()->id_company);
    }

    public function getCompany()
    {
        return $this->companyRepository->findFirst('id', Auth::user()->id_company);
    }

    public function delete(int $id)
    {
        $this->companyRepository->delete($id);
    }
}
