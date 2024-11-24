<?php

namespace Tests\Unit\Repositories\Representative;

use App\Data\Repositories\Representative\Concretes\ListRepresentativeByIdRepository;
use App\Models\Representative;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ListRepresentativeByIdRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private ListRepresentativeByIdRepository $listRepresentativeByIdRepository;

    public function test_success_list_representative_find_by_id_repository(): void
    {
        //  Arrange
        $Representative = Representative::factory()->createOne();

        //  Act
        $this->listRepresentativeByIdRepository = new ListRepresentativeByIdRepository();
        $result = $this->listRepresentativeByIdRepository->listFindById($Representative->id);

        //  Assert
        $this->assertEquals($Representative->id, $result[0]->id);
        $this->assertInstanceOf(Collection::class, $result);
    }
}
