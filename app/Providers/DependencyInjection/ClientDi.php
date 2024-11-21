<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Client\Concretes\ListAllClientRepository;
use App\Data\Repositories\Client\Interfaces\IListAllClientRepository;

use App\Domain\Services\Client\Interfaces\IListAllClientService;
use App\Domain\Services\Client\Concretes\ListAllClientService;

class ClientDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [IListAllClientService::class, ListAllClientService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [IListAllClientRepository::class, ListAllClientRepository::class]
        ];
    }
}
