<?php

namespace App\Data\Repositories\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\IListClientByIdRepository;
use App\Models\Client;
use Illuminate\Support\Collection;

class ListClientByIdRepository implements IListClientByIdRepository
{
    public function listFindById(int $id): Collection
    {
        return Client::with('city')->where('id', $id)->get();
    }
}
