<?php

namespace App\Data\Repositories\Client\Interfaces;

use App\Http\Requests\Client\UpdateClientRequest;

interface IUpdateClientRepository
{
    public function update(UpdateClientRequest $request): bool;
}
