<?php

namespace App\Domain\Services\City\Interfaces;

use Illuminate\Support\Collection;

interface IListAllCityService
{
    public function listAll(): Collection;
}
