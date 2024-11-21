<?php

namespace App\Domain\Services\Representative\Concretes;

use App\Data\Repositories\Representative\Interfaces\IListRepresentativeByIdRepository;
use App\Domain\Dtos\RepresentativeDto;
use App\Domain\Services\Representative\Interfaces\IListRepresentativeByIdService;
use App\Domain\Traits\Dtos\ListPaginationMapper;
use Illuminate\Support\Collection;

class ListRepresentativeByIdService implements IListRepresentativeByIdService
{
    use ListPaginationMapper;

    private IListRepresentativeByIdRepository $listRepresentativeByIdRepository;

    public function __construct(IListRepresentativeByIdRepository $listRepresentativeByIdRepository)
    {
        $this->listRepresentativeByIdRepository = $listRepresentativeByIdRepository;
    }

    public function listFind(int $id): Collection
    {
        $listCollection = $this->listRepresentativeByIdRepository->listFindById($id);
        return $this->mapToDtoList($listCollection, RepresentativeDto::class);
    }
}
