<?php

namespace App\Domain\Services\Representative\Interfaces;

use App\Http\Requests\Representative\UpdateRepresentativeRequest;

interface IUpdateRepresentativeService
{
    public function update(UpdateRepresentativeRequest $request): bool;
}
