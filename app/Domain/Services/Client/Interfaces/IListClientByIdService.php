<?php

namespace App\Domain\Services\Client\Interfaces;

use Illuminate\Support\Collection;

interface IListClientByIdService
{
    public function listFind(int $id): Collection;
}
