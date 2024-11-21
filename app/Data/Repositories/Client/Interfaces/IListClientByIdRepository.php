<?php

namespace App\Data\Repositories\Client\Interfaces;

use Illuminate\Support\Collection;

interface IListClientByIdRepository
{
    public function listFindById(int $id): Collection;
}
