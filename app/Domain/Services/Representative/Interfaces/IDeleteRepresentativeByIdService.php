<?php

namespace App\Domain\Services\Representative\Interfaces;

interface IDeleteRepresentativeByIdService
{
    public function delete(int $id): bool;
}
