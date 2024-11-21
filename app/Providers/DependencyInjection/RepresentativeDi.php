<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Representative\Concretes\CreateRepresentativeRepository;
use App\Data\Repositories\Representative\Concretes\DeleteRepresentativeByIdRepository;
use App\Data\Repositories\Representative\Concretes\ListAllRepresentativeRepository;
use App\Data\Repositories\Representative\Concretes\ListRepresentativeByIdRepository;
use App\Data\Repositories\Representative\Concretes\UpdateRepresentativeRepository;

use App\Data\Repositories\Representative\Interfaces\ICreateRepresentativeRepository;
use App\Data\Repositories\Representative\Interfaces\IDeleteRepresentativeByIdRepository;
use App\Data\Repositories\Representative\Interfaces\IListAllRepresentativeRepository;
use App\Data\Repositories\Representative\Interfaces\IListRepresentativeByIdRepository;
use App\Data\Repositories\Representative\Interfaces\IUpdateRepresentativeRepository;

use App\Domain\Services\Representative\Concretes\ListAllRepresentativeService;
use App\Domain\Services\Representative\Concretes\CreateRepresentativeService;
use App\Domain\Services\Representative\Concretes\DeleteRepresentativeByIdService;
use App\Domain\Services\Representative\Concretes\ListRepresentativeByIdService;
use App\Domain\Services\Representative\Concretes\UpdateRepresentativeService;

use App\Domain\Services\Representative\Interfaces\ICreateRepresentativeService;
use App\Domain\Services\Representative\Interfaces\IDeleteRepresentativeByIdService;
use App\Domain\Services\Representative\Interfaces\IListAllRepresentativeService;
use App\Domain\Services\Representative\Interfaces\IListRepresentativeByIdService;
use App\Domain\Services\Representative\Interfaces\IUpdateRepresentativeService;

class RepresentativeDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ICreateRepresentativeService::class, CreateRepresentativeService::class],
            [IDeleteRepresentativeByIdService::class, DeleteRepresentativeByIdService::class],
            [IListAllRepresentativeService::class, ListAllRepresentativeService::class],
            [IListRepresentativeByIdService::class, ListRepresentativeByIdService::class],
            [IUpdateRepresentativeService::class, UpdateRepresentativeService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreateRepresentativeRepository::class, CreateRepresentativeRepository::class],
            [IDeleteRepresentativeByIdRepository::class, DeleteRepresentativeByIdRepository::class],
            [IListAllRepresentativeRepository::class, ListAllRepresentativeRepository::class],
            [IListRepresentativeByIdRepository::class, ListRepresentativeByIdRepository::class],
            [IUpdateRepresentativeRepository::class, UpdateRepresentativeRepository::class]
        ];
    }
}
