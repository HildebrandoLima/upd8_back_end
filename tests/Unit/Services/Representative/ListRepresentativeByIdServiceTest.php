<?php

namespace Tests\Unit\Services\Representative;

use App\Data\Repositories\Representative\Concretes\ListRepresentativeByIdRepository;
use App\Domain\Services\Representative\Concretes\ListRepresentativeByIdService;
use Mockery\MockInterface;
use Tests\TestCase;

class ListRepresentativeByIdServiceTest extends TestCase
{
    private ListRepresentativeByIdRepository $listRepresentativeByIdRepository;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_representative_find_by_id_service(): void
    {
        // Arrange
        $id = rand(0, 100);
        $expectedResult = collect([]);

        $this->listRepresentativeByIdRepository = $this->mock(ListRepresentativeByIdRepository::class,
            function (MockInterface $mock) use ($expectedResult, $id) {
                $mock->shouldReceive('listFindById')
                     ->with($id)
                     ->andReturn($expectedResult);
        });

        // Act
        $listRepresentativeByIdService = new ListRepresentativeByIdService($this->listRepresentativeByIdRepository);
        $result = $listRepresentativeByIdService->listFind($id);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
