<?php

namespace App\Events;

use App\Models\Collaborator;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CollaboratorStore
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $collaborator;

    /**
     * Create a new event instance.
     */
    public function __construct(Collaborator $collaborator)
    {
        $this->collaborator = $collaborator;
    }

    public function getCollaborator()
    {
        return $this->collaborator;
    }
}
