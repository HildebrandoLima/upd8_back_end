<?php

namespace App\Domain\Services\City\Concretes;

use App\Data\Repositories\City\Interfaces\IListAllCityRepository;
use App\Domain\Dtos\CityDto;
use App\Domain\Services\City\Interfaces\IListAllCityService;
use App\Domain\Traits\Dtos\ListPaginationMapper;
use Illuminate\Support\Collection;

class ListAllCityService implements IListAllCityService
{
    use ListPaginationMapper;

    private IListAllCityRepository $listAllCityRepository;

    public function __construct(IListAllCityRepository $listAllCityRepository)
    {
        $this->listAllCityRepository = $listAllCityRepository;
    }

    public function listAll(): Collection
    {
        $listCollection = $this->listAllCityRepository->listAll();
        return $this->mapToDtoList($listCollection, CityDto::class);
    }
}
