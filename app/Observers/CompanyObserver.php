<?php

namespace App\Observers;

use App\Models\Company;
use App\Repositories\UserRepository;

class CompanyObserver
{
    public function deleting(Company $company)
    {
        app(UserRepository::class)->customDelete('id_company', $company->id);
    }
}
