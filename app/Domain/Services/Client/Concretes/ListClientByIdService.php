<?php

namespace App\Domain\Services\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\IListClientByIdRepository;
use App\Domain\Dtos\ClientDto;
use App\Domain\Services\Client\Interfaces\IListClientByIdService;
use App\Domain\Traits\Dtos\ListPaginationMapper;
use Illuminate\Support\Collection;

class ListClientByIdService implements IListClientByIdService
{
    use ListPaginationMapper;

    private IListClientByIdRepository $listClientByIdRepository;

    public function __construct(IListClientByIdRepository $listClientByIdRepository)
    {
        $this->listClientByIdRepository = $listClientByIdRepository;
    }

    public function listFind(int $id): Collection
    {
        $listCollection = $this->listClientByIdRepository->listFindById($id);
        return $this->mapToDtoList($listCollection, ClientDto::class);
    }
}
