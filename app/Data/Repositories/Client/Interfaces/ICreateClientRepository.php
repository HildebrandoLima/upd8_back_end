<?php

namespace App\Data\Repositories\Client\Interfaces;

use App\Http\Requests\Client\CreateClientRequest;

interface ICreateClientRepository
{
    public function create(CreateClientRequest $request): bool;
}
