<?php

namespace Tests\Unit\Repositories\Representative;

use App\Data\Repositories\Representative\Concretes\DeleteRepresentativeByIdRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DeleteRepresentativeByIdRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private DeleteRepresentativeByIdRepository $deleteRepresentativeByIdRepository;

    public function test_success_delete_representative_repository(): void
    {
        //  Arrange
        $id = 10;

        //  Act
        $this->deleteRepresentativeByIdRepository = new DeleteRepresentativeByIdRepository();
        $result = $this->deleteRepresentativeByIdRepository->delete($id);

        //  Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
    }
}
