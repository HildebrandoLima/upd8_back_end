<?php

namespace App\Data\Repositories\Representative\Interfaces;

interface IDeleteRepresentativeByIdRepository
{
    public function delete(int $id): bool;
}
