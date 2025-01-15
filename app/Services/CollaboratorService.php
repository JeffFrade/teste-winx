<?php

namespace App\Services;

use App\Exceptions\CollaboratorNotFoundException;
use App\Helpers\IniHelper;
use App\Jobs\ProcessCsvJob;
use App\Repositories\CollaboratorRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class CollaboratorService
{
    private $collaboratorRepository;
    private $batchService;

    public function __construct()
    {
        $this->collaboratorRepository = new CollaboratorRepository();
        $this->batchService = new BatchService();
    }

    public function index(array $data, bool $isApi = false)
    {
        $search = $data['search'] ?? null;
        $idCompany = Auth::user()->id_company;

        $collaborators = $this->collaboratorRepository->index($idCompany, $search);

        if ($isApi && $collaborators->count() == 0) {
            throw new CollaboratorNotFoundException('Não há dados para os filtros informados', 404);
        }

        return $collaborators;
    }

    public function store(array $data)
    {
        if (empty($data['id_company'] ?? '')) {
            $data['id_company'] = Auth::user()->id_company;
        }

        return $this->collaboratorRepository->create($data);
    }

    public function edit(int $id)
    {
        $collaborator = $this->collaboratorRepository->findFirst('id', $id);

        if (empty($collaborator) || ($collaborator->id_company ?? '') != Auth::user()->id_company) {
            throw new CollaboratorNotFoundException('Colaborador Inexistente', 404);
        }

        return $collaborator;
    }

    public function update(array $data, int $id)
    {
        $this->edit($id);

        $this->collaboratorRepository->update($data, $id);
    }

    public function status(int $id)
    {
        $collaborator = $this->edit($id);
        $message = 'Colaborador inativado com sucesso!';
        $active = 0;

        if (!$collaborator->active) {
            $message = 'Colaborador ativado com sucesso!';
            $active = 1;
        }

        $this->collaboratorRepository->update([
            'active' => $active
        ], $id);
        
        return $message;
    }

    public function batch(UploadedFile $file)
    {
        IniHelper::setMemoryIniVars();

        $batch = $this->batchService->store();

        $rows = file_get_contents($file->getRealPath());
        $rows = explode("\n", $rows);
        array_shift($rows);

        $data = [
            'id_company' => Auth::user()->id_company,
            'id_batch' => $batch->id,
            'rows' => array_filter($rows)
        ];

        ProcessCsvJob::dispatch($data);
    }

    public function findByEmail(string $email)
    {
        return $this->collaboratorRepository->findFirst('email', $email);
    }
}
