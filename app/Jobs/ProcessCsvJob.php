<?php

namespace App\Jobs;

use App\Events\CollaboratorError;
use App\Events\CollaboratorStore;
use App\Events\FinishImport;
use App\Helpers\DateHelper;
use App\Helpers\IniHelper;
use App\Services\BatchInfoService;
use App\Services\BatchService;
use App\Services\CollaboratorService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessCsvJob implements ShouldQueue
{
    use Queueable;

    private $data;
    private $collaboratorService;
    private $batchService;
    private $batchInfoService;

    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->collaboratorService = new CollaboratorService();
        $this->batchService = new BatchService();
        $this->batchInfoService = new BatchInfoService();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        IniHelper::setMemoryIniVars();

        try {
            $this->batchService->changeStatus($this->data['id_batch'], 'R');

            $finalStatus = 'F';
            $line = 2;

            foreach ($this->data['rows'] as $rowContent) {
                $row = explode(';', $rowContent);
                $errors = [];

                $errors[] = $this->validateName($row[0]);
                $errors[] = $this->validateEmail($row[1]);
                $errors[] = $this->validatePosition($row[2]);
                $errors[] = $this->validatePosition($row[3]);

                $errors = array_filter($errors);

                $this->storeInfo(
                    $line,
                    $rowContent,
                    $errors
                );

                $line += 1;
                
                if (count($errors) == 0) {
                    $admissionDate = DateHelper::parse($row[3], 'd/m/Y');
                    $admissionDate = $admissionDate->format('Y-m-d');

                    $collaborator = $this->collaboratorService->store([
                        'id_company' => $this->data['id_company'],
                        'name' => $row[0],
                        'email' => $row[1],
                        'position' => $row[2],
                        'admission_date' => $admissionDate,
                    ]);

                    event(new CollaboratorStore($collaborator));
                    
                    continue;
                }

                event(new CollaboratorError($errors));

                $finalStatus = 'W';
            }

            $this->batchService->changeStatus($this->data['id_batch'], $finalStatus);

            event(new FinishImport());
        } catch (\Exception $e) {
            Log::error('Error: ' . json_encode($e));
            $this->batchService->changeStatus($this->data['id_batch'], 'X');
        }
    }

    private function validateName(string $name)
    {
        if (empty($name)) {
            return 'Nome vazio.';
        }
    }

    private function validateEmail(string $email)
    {
        if (empty($email)) {
            return 'Nome vazio.';
        }

        $collaborator = $this->collaboratorService->findByEmail($email);

        if (!empty($collaborator)) {
            return 'Colaborador existente.';
        }
    }

    private function validatePosition(string $position)
    {
        if (empty($position)) {
            return 'Cargo vazio.';
        }
    }

    private function validateAdmissionDate(string $date)
    {
        $date = explode('/', $date);

        if (!checkdate($date[1], $date[0], $date[2])) {
            return 'Data inválida';
        }
    }

    private function storeInfo(
        int $line,
        string $lineContent,
        array $errors = []
    )
    {
        $status = 'S';
        $obs = implode(' | ', $errors) ?? null;

        if (count($errors) > 0) {
            $status = 'F';
        }

        $this->batchInfoService->store([
            'id_batch' => $this->data['id_batch'],
            'line' => $line,
            'line_content' => $lineContent,
            'status' => $status,
            'obs' => trim($obs),
        ]);
    }
}
