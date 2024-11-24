<?php

namespace App\Data\Repositories\Representative\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IListAllRepresentativeRepository
{
    public function hasPagination(Request $request): LengthAwarePaginator;
    public function noPagination(Request $request): Collection;
}
