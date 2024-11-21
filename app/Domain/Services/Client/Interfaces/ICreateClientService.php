<?php

namespace App\Domain\Services\Client\Interfaces;

use App\Http\Requests\Client\CreateClientRequest;

interface ICreateClientService
{
    public function create(CreateClientRequest $request): bool;
}
