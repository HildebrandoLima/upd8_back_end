<?php

namespace Tests\Unit\Services\Client;

use App\Data\Repositories\Client\Concretes\ListClientByIdRepository;
use App\Domain\Services\Client\Concretes\ListClientByIdService;
use Mockery\MockInterface;
use Tests\TestCase;

class ListClientByIdServiceTest extends TestCase
{
    private ListClientByIdRepository $listClientByIdRepository;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_client_find_by_id_service(): void
    {
        // Arrange
        $id = rand(0, 100);
        $expectedResult = collect([]);

        $this->listClientByIdRepository = $this->mock(ListClientByIdRepository::class,
            function (MockInterface $mock) use ($expectedResult, $id) {
                $mock->shouldReceive('listFindById')
                     ->with($id)
                     ->andReturn($expectedResult);
        });

        // Act
        $listClientByIdService = new ListClientByIdService($this->listClientByIdRepository);
        $result = $listClientByIdService->listFind($id);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
