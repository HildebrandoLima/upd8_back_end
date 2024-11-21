<?php

namespace App\Data\Repositories\Representative\Interfaces;

use App\Http\Requests\Representative\CreateRepresentativeRequest;

interface ICreateRepresentativeRepository
{
    public function create(CreateRepresentativeRequest $request): bool;
}
