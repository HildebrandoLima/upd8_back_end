<?php

namespace App\Data\Repositories\City\Interfaces;

use Illuminate\Support\Collection;

interface IListAllCityRepository
{
    public function listAll(): Collection;
}
