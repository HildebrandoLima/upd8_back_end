<?php

namespace App\Data\Repositories\Representative\Interfaces;

use App\Http\Requests\Representative\RepresentativeRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IListAllRepresentativeRepository
{
    public function hasPagination(RepresentativeRequest $request): LengthAwarePaginator;
    public function noPagination(RepresentativeRequest $request): Collection;
}
