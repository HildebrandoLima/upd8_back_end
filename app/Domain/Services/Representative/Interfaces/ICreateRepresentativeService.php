<?php

namespace App\Domain\Services\Representative\Interfaces;

use App\Http\Requests\Representative\CreateRepresentativeRequest;

interface ICreateRepresentativeService
{
    public function create(CreateRepresentativeRequest $request): bool;
}
