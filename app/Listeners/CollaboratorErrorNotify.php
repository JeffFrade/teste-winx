<?php

namespace App\Listeners;

use App\Events\CollaboratorError;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CollaboratorErrorNotify implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CollaboratorError $event): void
    {
        Log::error('Erro(s) ao cadastrar colaborador: ' . json_encode($event->getErrors()));
    }
}
