<?php

namespace App\Domain\Services\Client\Interfaces;

interface IDeleteClientByIdService
{
    public function delete(int $id): bool;
}
