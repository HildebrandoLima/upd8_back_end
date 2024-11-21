<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Client\Concretes\CreateClientRepository;
use App\Data\Repositories\Client\Concretes\DeleteClientByIdRepository;
use App\Data\Repositories\Client\Concretes\ListAllClientRepository;

use App\Data\Repositories\Client\Interfaces\ICreateClientRepository;
use App\Data\Repositories\Client\Interfaces\IDeleteClientByIdRepository;
use App\Data\Repositories\Client\Interfaces\IListAllClientRepository;

use App\Domain\Services\Client\Concretes\ListAllClientService;
use App\Domain\Services\Client\Concretes\CreateClientService;
use App\Domain\Services\Client\Concretes\DeleteClientByIdService;

use App\Domain\Services\Client\Interfaces\ICreateClientService;
use App\Domain\Services\Client\Interfaces\IDeleteClientByIdService;
use App\Domain\Services\Client\Interfaces\IListAllClientService;

class ClientDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ICreateClientService::class, CreateClientService::class],
            [IDeleteClientByIdService::class, DeleteClientByIdService::class],
            [IListAllClientService::class, ListAllClientService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreateClientRepository::class, CreateClientRepository::class],
            [IDeleteClientByIdRepository::class, DeleteClientByIdRepository::class],
            [IListAllClientRepository::class, ListAllClientRepository::class]
        ];
    }
}
