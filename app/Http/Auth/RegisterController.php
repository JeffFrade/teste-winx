<?php

namespace App\Http\Auth;

use App\Core\Support\Controller;
use App\Helpers\StringHelper;
use App\Models\User;
use App\Services\CompanyService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    private $companyService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CompanyService $companyService)
    {
        $this->middleware('guest');
        $this->companyService = $companyService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'company_name' => ['required', 'string', 'max:150'],
            'document' => ['required', 'string', 'size:18', 'unique:companies'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $company = $this->storeCompany($data);
        
        $user = User::create([
            'id_company' => $company->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => StringHelper::hashPassword($data['password']),
        ]);

        $this->givePermission($user);

        return $user;
    }

    private function storeCompany(array $data)
    {
        return $this->companyService->store($data);
    }

    private function givePermission(User $user)
    {
        $user->givePermissionTo([
            'admin'
        ]);
    }
}
