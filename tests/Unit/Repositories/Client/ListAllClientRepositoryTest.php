<?php

namespace Tests\Unit\Repositories\Client;

use App\Data\Repositories\Client\Concretes\ListAllClientRepository;
use App\Http\Requests\Client\ClientRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ListAllClientRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private ListAllClientRepository $listAllClientRepository;

    public function test_success_list_client_all_has_pagination_repository(): void
    {
        //  Arrange
        $request = new ClientRequest();
        $request['page'] = 1;
        $request['perPage'] = 10;

        //  Act
        $this->listAllClientRepository = new ListAllClientRepository();
        $result = $this->listAllClientRepository->hasPagination($request);

        //  Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    public function test_success_list_client_all_no_pagination_repository(): void
    {
        //Arrange
        $request = new ClientRequest();

        //Act
        $this->listAllClientRepository = new ListAllClientRepository();
        $result = $this->listAllClientRepository->noPagination($request);

        //Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(Collection::class, $result);
    }
}
