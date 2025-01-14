<?php

namespace App\Listeners;

use App\Events\CollaboratorStore;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CollaboratorStoreNotify
{
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
        //
    }
}
