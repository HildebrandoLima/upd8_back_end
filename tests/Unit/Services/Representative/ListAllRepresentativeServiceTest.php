<?php

namespace Tests\Unit\Services\Representative;

use App\Data\Repositories\Representative\Interfaces\IListAllRepresentativeRepository;
use App\Domain\Services\Representative\Concretes\ListAllRepresentativeService;
use App\Http\Requests\Representative\RepresentativeRequest;
use App\Support\Utils\Paginator\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListAllRepresentativeServiceTest extends TestCase
{
    private IListAllRepresentativeRepository $listAllRepresentativeRepository;
    private IPagination $pagination;
    private ISearch $search;
    private RepresentativeRequest $request;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_representative_all_has_pagination_service(): void
    {
        // Arrange
        $this->request = new RepresentativeRequest(['page' => 1, 'perPage' => 10]);
        $this->pagination = $this->setMockPagination(true);
        $this->search = $this->setMockSearch('');

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = $this->paginatedList();

        $this->listAllRepresentativeRepository = $this->mock(IListAllRepresentativeRepository::class,
            function (MockInterface $mock) use ($expectedResultRepository) {
                $mock->shouldReceive('hasPagination')
                     ->with($this->request)
                     ->andReturn($expectedResultRepository);

                $mock->shouldReceive('noPagination')
                     ->with($this->request)
                     ->andReturn(collect([]));
        });

        // Act
        $listAllRepresentativeService = new ListAllRepresentativeService
        (
            $this->listAllRepresentativeRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllRepresentativeService->listAll($this->request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }

    public function test_success_list_representative_all_has_pagination_search_name_service(): void
    {
        // Arrange
        $this->request = new RepresentativeRequest(['page' => 1, 'perPage' => 10, 'name' => Str::random(10)]);
        $this->pagination = $this->setMockPagination(true);
        $this->search = $this->setMockSearch('');

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = $this->paginatedList();

        $this->listAllRepresentativeRepository = $this->mock(IListAllRepresentativeRepository::class,
            function (MockInterface $mock) use ($expectedResultRepository) {
                $mock->shouldReceive('hasPagination')
                     ->with($this->request)
                     ->andReturn($expectedResultRepository);

                $mock->shouldReceive('noPagination')
                     ->with($this->request)
                     ->andReturn(collect([]));
        });

        // Act
        $listAllRepresentativeService = new ListAllRepresentativeService
        (
            $this->listAllRepresentativeRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllRepresentativeService->listAll($this->request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }

    public function test_success_list_representative_all_no_pagination_service(): void
    {
        // Arrange
        $this->request = new RepresentativeRequest();
        $this->pagination = $this->setMockPagination(false);
        $this->search = $this->setMockSearch('');

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = collect([]);

        $this->listAllRepresentativeRepository = $this->mock(IListAllRepresentativeRepository::class,
            function (MockInterface $mock) use ($expectedResultRepository) {
                $mock->shouldReceive('hasPagination')
                     ->with($this->request)
                     ->andReturn($expectedResultRepository);

                $mock->shouldReceive('noPagination')
                     ->with($this->request)
                     ->andReturn(collect([]));
        });

        // Act
        $listAllRepresentativeService = new ListAllRepresentativeService
        (
            $this->listAllRepresentativeRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllRepresentativeService->listAll($this->request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }
}
