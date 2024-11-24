<?php

namespace Tests\Unit\Services\Client;

use App\Data\Repositories\Client\Interfaces\IListAllClientRepository;
use App\Domain\Services\Client\Concretes\ListAllClientService;
use App\Http\Requests\Client\ClientRequest;
use App\Support\Utils\Paginator\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListAllClientServiceTest extends TestCase
{
    private IListAllClientRepository $listAllClientRepository;
    private IPagination $pagination;
    private ISearch $search;
    private ClientRequest $request;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_client_all_has_pagination_service(): void
    {
        // Arrange
        $this->request = new ClientRequest(['page' => 1, 'perPage' => 10]);
        $this->pagination = $this->setMockPagination(true);
        $this->search = $this->setMockSearch('');

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = $this->paginatedList();

        $this->listAllClientRepository = $this->mock(IListAllClientRepository::class,
            function (MockInterface $mock) use ($expectedResultRepository) {
                $mock->shouldReceive('hasPagination')
                     ->with($this->request)
                     ->andReturn($expectedResultRepository);

                $mock->shouldReceive('noPagination')
                     ->with($this->request)
                     ->andReturn(collect([]));
        });

        // Act
        $listAllClientService = new ListAllClientService
        (
            $this->listAllClientRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllClientService->listAll($this->request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }

    public function test_success_list_client_all_has_pagination_search_name_service(): void
    {
        // Arrange
        $this->request = new ClientRequest(['page' => 1, 'perPage' => 10, 'name' => Str::random(10)]);
        $this->pagination = $this->setMockPagination(true);
        $this->search = $this->setMockSearch('');

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = $this->paginatedList();

        $this->listAllClientRepository = $this->mock(IListAllClientRepository::class,
            function (MockInterface $mock) use ($expectedResultRepository) {
                $mock->shouldReceive('hasPagination')
                     ->with($this->request)
                     ->andReturn($expectedResultRepository);

                $mock->shouldReceive('noPagination')
                     ->with($this->request)
                     ->andReturn(collect([]));
        });

        // Act
        $listAllClientService = new ListAllClientService
        (
            $this->listAllClientRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllClientService->listAll($this->request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }

    public function test_success_list_client_all_no_pagination_service(): void
    {
        // Arrange
        $this->request = new ClientRequest();
        $this->pagination = $this->setMockPagination(false);
        $this->search = $this->setMockSearch('');

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = collect([]);

        $this->listAllClientRepository = $this->mock(IListAllClientRepository::class,
            function (MockInterface $mock) use ($expectedResultRepository) {
                $mock->shouldReceive('hasPagination')
                     ->with($this->request)
                     ->andReturn($expectedResultRepository);

                $mock->shouldReceive('noPagination')
                     ->with($this->request)
                     ->andReturn(collect([]));
        });

        // Act
        $listAllClientService = new ListAllClientService
        (
            $this->listAllClientRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllClientService->listAll($this->request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }
}
