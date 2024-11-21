<?php

namespace App\Data\Repositories\Client\Interfaces;

interface IDeleteClientByIdRepository
{
    public function delete(int $id): bool;
}
