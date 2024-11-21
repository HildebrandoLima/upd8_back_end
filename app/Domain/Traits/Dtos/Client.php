<?php

namespace App\Domain\Traits\Dtos;

use App\Domain\Dtos\ClientDto;

trait Client
{
    use AutoMapper;

    public function clients(array $clients): array
    {
        foreach ($clients as $key => $value) {
            $clients[$key] = $this->mapTo($value, ClientDto::class);
        }
        return $clients;
    }
}
