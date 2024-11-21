<?php

namespace App\Domain\Services\Representative\Interfaces;

use App\Http\Requests\Representative\RepresentativeRequest;
use Illuminate\Support\Collection;

interface IListAllRepresentativeService
{
    public function listAll(RepresentativeRequest $request): Collection;
}
