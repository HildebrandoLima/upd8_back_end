<?php

namespace App\Domain\Services\Representative\Concretes;

use App\Data\Repositories\Representative\Interfaces\IListAllRepresentativeRepository;
use App\Domain\Dtos\RepresentativeDto;
use App\Domain\Services\Representative\Interfaces\IListAllRepresentativeService;
use App\Domain\Traits\Dtos\ListPaginationMapper;
use App\Domain\Traits\RequestConfigurator;
use App\Support\Utils\Paginator\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListAllRepresentativeService implements IListAllRepresentativeService
{
    use RequestConfigurator, ListPaginationMapper;

    private IListAllRepresentativeRepository $listAllRepresentativeRepository;
    private IPagination $pagination;
    private ISearch $search;

    public function __construct
    (
        IListAllRepresentativeRepository $listAllRepresentativeRepository,
        IPagination $pagination,
        ISearch $search
    )
    {
        $this->listAllRepresentativeRepository = $listAllRepresentativeRepository;
        $this->pagination = $pagination;
        $this->search = $search;
    }

    public function listAll(Request $request): Collection
    {
        $this->setParams($request, $this->pagination, $this->search);
        $this->setRequest($request);
        return $this->pagination->hasPagination() ? $this->paginatedList() : $this->noPaginatedList();
    }

    private function paginatedList(): Collection
    {
        $paginatedList = $this->listAllRepresentativeRepository->hasPagination($this->request);
        return $this->mapToDtoList($paginatedList, RepresentativeDto::class);
    }

    private function noPaginatedList(): Collection
    {
        $noPaginatedList = $this->listAllRepresentativeRepository->noPagination($this->request);
        return $this->mapToDtoList($noPaginatedList, RepresentativeDto::class);
    }
}
