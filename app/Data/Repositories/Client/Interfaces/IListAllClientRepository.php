<?php

namespace App\Data\Repositories\Client\Interfaces;

use App\Http\Requests\Client\ClientRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IListAllClientRepository
{
    public function hasPagination(ClientRequest $request): LengthAwarePaginator;
    public function noPagination(ClientRequest $request): Collection;
}
