<?php

namespace App\Data\Repositories\Representative\Interfaces;

use App\Http\Requests\Representative\UpdateRepresentativeRequest;

interface IUpdateRepresentativeRepository
{
    public function update(UpdateRepresentativeRequest $request): bool;
}
