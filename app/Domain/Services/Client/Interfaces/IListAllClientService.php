<?php

namespace App\Domain\Services\Client\Interfaces;

use App\Http\Requests\Client\ClientRequest;
use Illuminate\Support\Collection;

interface IListAllClientService
{
    public function listAll(ClientRequest $request): Collection;
}
