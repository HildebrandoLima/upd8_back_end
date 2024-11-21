<?php

namespace App\Data\Repositories\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\IDeleteClientByIdRepository;
use App\Models\Client;

class DeleteClientByIdRepository implements IDeleteClientByIdRepository
{
    public function  delete(int $id): bool
    {
        return Client::where('id', $id)->delete();
    }
}
