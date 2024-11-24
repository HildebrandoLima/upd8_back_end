<?php

namespace App\Domain\Services\Client\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListAllClientService
{
    public function listAll(Request $request): Collection;
}
