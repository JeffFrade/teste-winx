<?php

namespace App\Listeners;

use App\Events\CollaboratorStore;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CollaboratorStoreNotify implements ShouldQueue
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
    public function handle(CollaboratorStore $event): void
    {
        Log::info('Colaborador cadastrado: ' . json_encode($event->getCollaborator()));
    }
}
