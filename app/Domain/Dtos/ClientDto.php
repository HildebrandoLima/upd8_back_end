<?php

namespace App\Domain\Dtos;

use App\Domain\Traits\Dtos\DefaultFields;
use App\Domain\Traits\Dtos\City;

class ClientDto
{
    use DefaultFields, City;

    public string $name = "";
    public string $cpf = "";
    public string $sex = "";
    public string $address = "";
    public string $dateBirth = "";
    public $city;

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
        $this->city = $this->city($data['city'] ?? []);
    }
}
