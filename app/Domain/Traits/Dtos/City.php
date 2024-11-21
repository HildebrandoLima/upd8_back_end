<?php

namespace App\Domain\Traits\Dtos;

use App\Domain\Dtos\CityDto;

trait City
{
    use AutoMapper;

    public function city(array $city): CityDto
    {
        return $this->mapTo($city, CityDto::class);
    }
}
