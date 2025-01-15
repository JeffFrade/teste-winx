<?php

namespace App\Observers;

use App\Models\User;
use App\Repositories\BatchRepository;
use App\Repositories\UserRepository;
use Laravel\Passport\ClientRepository;

class UserObserver
{
    public function created(User $user)
    {
        $client = app(ClientRepository::class)->createPasswordGrantClient($user->id, 'J3M', env('APP_URL'),'users');
        $this->addClient($user->id, $client->id, $client->plainSecret);
    }

    public function deleting(User $user)
    {
        app(BatchRepository::class)->customDelete('id_user', $user->id);
    }

    private function addClient(int $idUser, string $id, string $secret)
    {
        app(UserRepository::class)->update([
            'client_id' => $id,
            'client_secret' => $secret
        ], $idUser);
    }
}
