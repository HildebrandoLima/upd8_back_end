<?php

namespace Tests\Unit\Services\Client;

use App\Data\Repositories\Client\Concretes\DeleteClientByIdRepository;
use App\Domain\Services\Client\Concretes\DeleteClientByIdService;
use Mockery\MockInterface;
use Tests\TestCase;

class DeleteClientByIdServiceTest extends TestCase
{
    private DeleteClientByIdRepository $deleteClientByIdRepository;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_client_delete_service(): void
    {
        // Arrange
        $id = rand(0, 100);

        $this->deleteClientByIdRepository = $this->mock(DeleteClientByIdRepository::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('delete')
                     ->with($id)
                     ->andReturn(true);
        });

        // Act
        $deleteClientByIdService = new DeleteClientByIdService($this->deleteClientByIdRepository);
        $result = $deleteClientByIdService->delete($id);

        // Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
    }
}
