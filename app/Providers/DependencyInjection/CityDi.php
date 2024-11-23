<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\City\Concretes\ListAllCityRepository;
use App\Data\Repositories\City\Interfaces\IListAllCityRepository;

use App\Domain\Services\City\Concretes\ListAllCityService;
use App\Domain\Services\City\Interfaces\IListAllCityService;

class CityDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [IListAllCityService::class, ListAllCityService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [IListAllCityRepository::class, ListAllCityRepository::class]
        ];
    }
}
