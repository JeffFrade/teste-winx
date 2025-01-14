<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Exceptions\CollaboratorNotFoundException;
use App\Services\CollaboratorService;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    private $collaboratorService;

    public function __construct(CollaboratorService $collaboratorService)
    {
        $this->collaboratorService = $collaboratorService;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $collaborators = $this->collaboratorService->index($params);

        return view('collaborators.index', compact('params', 'collaborators'));
    }

    public function create()
    {
        return view('collaborators.create');
    }

    public function store(Request $request)
    {
        $params = $this->toValidate($request);
        $this->collaboratorService->store($params);

        return redirect(route('home.collaborators.index'))
            ->with('message', 'Colaborador cadastrado com sucesso!');
    }

    public function edit(int $id)
    {
        try {
            $collaborator = $this->collaboratorService->edit($id);

            return view('collaborators.edit', compact('collaborator'));
        } catch (CollaboratorNotFoundException $e) {
            return redirect(route('home.collaborators.index'))
                ->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $params = $this->toValidate($request, $id);
            $this->collaboratorService->update($params, $id);

            return redirect(route('home.collaborators.index'))
                ->with('message', 'Colaborador atualizado com sucesso!');
        } catch (CollaboratorNotFoundException $e) {
            return redirect(route('home.collaborators.index'))
                ->with('error', $e->getMessage());
        }
    }

    public function status(int $id)
    {
        try {
            $message = $this->collaboratorService->status($id);

            return $this->sendJsonSuccessResponse($message);
        } catch (CollaboratorNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }

    public function batch(Request $request)
    {
        $this->toValidateBatch($request);
        $file = request()->file('csv');
        
        $this->collaboratorService->batch($file);
        
        return redirect(route('home.collaborators.index'))
            ->with('message', 'Arquivo carregado com sucesso! (Será notificado via e-mail com o término da importação).');
    }

    protected function toValidate(Request $request, ?int $id = null)
    {
        $toValidateArr = [
            'name' => 'required|max:75',
            'email' => 'required|max:150|unique:collaborators,email,' . $id,
            'position' => 'required|max:70',
            'admission_date' => 'required|date',
        ];

        return $this->validate($request, $toValidateArr);
    }

    protected function toValidateBatch(Request $request)
    {
        $toValidateArr = [
            'csv' => 'file|mimes:csv,txt'
        ];

        return $this->validate($request, $toValidateArr);
    }
}
