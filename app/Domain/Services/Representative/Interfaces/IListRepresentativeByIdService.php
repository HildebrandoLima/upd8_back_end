<?php

namespace App\Domain\Services\Representative\Interfaces;

use Illuminate\Support\Collection;

interface IListRepresentativeByIdService
{
    public function listFind(int $id): Collection;
}
