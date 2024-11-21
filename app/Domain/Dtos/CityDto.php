<?php

namespace App\Domain\Dtos;

use App\Domain\Traits\Dtos\DefaultFields;

class CityDto
{
    use DefaultFields;

    public string $state = "";
    public string $cityName = "";

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
    }
}
