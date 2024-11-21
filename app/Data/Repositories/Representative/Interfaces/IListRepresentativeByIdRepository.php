<?php

namespace App\Data\Repositories\Representative\Interfaces;

use Illuminate\Support\Collection;

interface IListRepresentativeByIdRepository
{
    public function listFindById(int $id): Collection;
}
