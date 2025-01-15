<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function edit()
    {
        $company = $this->companyService->getCompany();

        return view('companies.edit', compact('company'));
    }

    public function update(Request $request)
    {
        $params = $this->toValidate($request);
        $this->companyService->update($params);

        return redirect(route('home.companies.edit'))
            ->with('message', 'Empresa atualizada com sucesso!');
    }

    protected function toValidate(Request $request)
    {
        $toValidateArr = [
            'name' => 'required|max:150'
        ];

        return $this->validate($request, $toValidateArr);
    }
}
