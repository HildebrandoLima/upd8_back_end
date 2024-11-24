<?php

namespace App\Domain\Services\Representative\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListAllRepresentativeService
{
    public function listAll(Request $request): Collection;
}
