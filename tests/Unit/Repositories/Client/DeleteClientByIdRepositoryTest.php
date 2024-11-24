<?php

namespace Tests\Unit\Repositories\Client;

use App\Data\Repositories\Client\Concretes\DeleteClientByIdRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DeleteClientByIdRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private DeleteClientByIdRepository $deleteClientByIdRepository;

    public function test_success_delete_client_repository(): void
    {
        //  Arrange
        $id = 10;

        //  Act
        $this->deleteClientByIdRepository = new DeleteClientByIdRepository();
        $result = $this->deleteClientByIdRepository->delete($id);

        //  Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
    }
}
