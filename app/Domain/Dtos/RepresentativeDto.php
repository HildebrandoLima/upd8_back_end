<?php

namespace App\Domain\Dtos;

use App\Domain\Traits\Dtos\DefaultFields;
use App\Domain\Traits\Dtos\City;
use App\Domain\Traits\Dtos\Client;

class RepresentativeDto
{
    use DefaultFields, Client, City;

    public string $name = "";
    public string $cnpj = "";
    public string $address = "";
    public array $clients = [];
    public $city;

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
        $this->city = $this->city($data['city'] ?? []);
        $this->clients = $this->clients($data['clients'] ?? []);
    }
}
