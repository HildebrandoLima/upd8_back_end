<?php

namespace App\Domain\Services\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\IListAllClientRepository;
use App\Domain\Dtos\ClientDto;
use App\Domain\Services\Client\Interfaces\IListAllClientService;
use App\Domain\Traits\Dtos\ListPaginationMapper;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Client\ClientRequest;
use App\Support\Utils\Paginator\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Support\Collection;

class ListAllClientService implements IListAllClientService
{
    use RequestConfigurator, ListPaginationMapper;

    private IListAllClientRepository $listAllClientRepository;
    private IPagination $pagination;
    private ISearch $search;

    public function __construct
    (
        IListAllClientRepository $listAllClientRepository,
        IPagination $pagination,
        ISearch $search
    )
    {
        $this->listAllClientRepository = $listAllClientRepository;
        $this->pagination = $pagination;
        $this->search = $search;
    }

    public function listAll(ClientRequest $request): Collection
    {
        $this->setParams($request, $this->pagination, $this->search);
        $this->setRequest($request);
        return $this->pagination->hasPagination() ? $this->paginatedList() : $this->noPaginatedList();
    }

    private function paginatedList(): Collection
    {
        $paginatedList = $this->listAllClientRepository->hasPagination($this->request);
        return $this->mapToDtoList($paginatedList, ClientDto::class);
    }

    private function noPaginatedList(): Collection
    {
        $noPaginatedList = $this->listAllClientRepository->noPagination($this->request);
        return $this->mapToDtoList($noPaginatedList, ClientDto::class);
    }
}
