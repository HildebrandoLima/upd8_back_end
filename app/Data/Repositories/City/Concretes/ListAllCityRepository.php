<?php

namespace App\Data\Repositories\City\Concretes;

use App\Data\Repositories\City\Interfaces\IListAllCityRepository;
use App\Models\City;
use Illuminate\Support\Collection;

class ListAllCityRepository implements IListAllCityRepository
{
    public function listAll(): Collection
    {
        return City::orderBy('city_name')->get();
    }
}
