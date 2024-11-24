<?php

namespace Tests\Unit\Services\Representative;

use App\Data\Repositories\Representative\Concretes\DeleteRepresentativeByIdRepository;
use App\Domain\Services\Representative\Concretes\DeleteRepresentativeByIdService;
use Mockery\MockInterface;
use Tests\TestCase;

class DeleteRepresentativeByIdServiceTest extends TestCase
{
    private DeleteRepresentativeByIdRepository $deleteRepresentativeByIdRepository;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_Representative_delete_service(): void
    {
        // Arrange
        $id = rand(0, 100);

        $this->deleteRepresentativeByIdRepository = $this->mock(DeleteRepresentativeByIdRepository::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('delete')
                     ->with($id)
                     ->andReturn(true);
        });

        // Act
        $deleteRepresentativeByIdService = new DeleteRepresentativeByIdService($this->deleteRepresentativeByIdRepository);
        $result = $deleteRepresentativeByIdService->delete($id);

        // Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
    }
}
