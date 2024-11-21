<?php

namespace App\Domain\Services\Client\Interfaces;

use App\Http\Requests\Client\UpdateClientRequest;

interface IUpdateClientService
{
    public function update(UpdateClientRequest $request): bool;
}
