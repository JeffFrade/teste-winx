<?php

namespace App\Console\Commands;

use App\Services\BatchInfoService;
use App\Services\BatchService;
use App\Services\CompanyService;
use Illuminate\Console\Command;

class DeleteCompanyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'company:delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete company by ID';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $batches = app(BatchService::class)->getBatchesByIdCompany($id);

        foreach ($batches as $batch) {
            app(BatchInfoService::class)->deleteByIdBatch($batch->id);
        }

        app(CompanyService::class)->delete($id);
        $this->info('Company deleted!');
    }
}
