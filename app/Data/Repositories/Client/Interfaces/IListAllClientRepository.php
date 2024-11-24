<?php

namespace App\Data\Repositories\Client\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IListAllClientRepository
{
    public function hasPagination(Request $request): LengthAwarePaginator;
    public function noPagination(Request $request): Collection;
}
