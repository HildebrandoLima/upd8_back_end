<?php

namespace Tests\Unit\Repositories\Client;

use App\Data\Repositories\Client\Concretes\ListClientByIdRepository;
use App\Models\Client;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ListClientByIdRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private ListClientByIdRepository $listClientByIdRepository;

    public function test_success_list_client_find_by_id_repository(): void
    {
        //  Arrange
        $client = Client::factory()->createOne();

        //  Act
        $this->listClientByIdRepository = new ListClientByIdRepository();
        $result = $this->listClientByIdRepository->listFindById($client->id);

        //  Assert
        $this->assertEquals($client->id, $result[0]->id);
        $this->assertInstanceOf(Collection::class, $result);
    }
}
