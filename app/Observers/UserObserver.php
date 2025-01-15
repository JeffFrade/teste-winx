<?php

namespace App\Observers;

use App\Models\User;
use App\Repositories\BatchRepository;

class UserObserver
{
    public function deleting(User $user)
    {
        app(BatchRepository::class)->customDelete('id_user', $user->id);
    }
}
