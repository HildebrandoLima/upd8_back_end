<?php

namespace Tests\Unit\Repositories\Representative;

use App\Data\Repositories\Representative\Concretes\ListAllRepresentativeRepository;
use App\Http\Requests\Representative\RepresentativeRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ListAllRepresentativeRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private ListAllRepresentativeRepository $listAllRepresentativeRepository;

    public function test_success_list_representative_all_has_pagination_repository(): void
    {
        //  Arrange
        $request = new RepresentativeRequest();
        $request['page'] = 1;
        $request['perPage'] = 10;

        //  Act
        $this->listAllRepresentativeRepository = new ListAllRepresentativeRepository();
        $result = $this->listAllRepresentativeRepository->hasPagination($request);

        //  Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    public function test_success_list_Representative_all_no_pagination_repository(): void
    {
        //Arrange
        $request = new RepresentativeRequest();

        //Act
        $this->listAllRepresentativeRepository = new ListAllRepresentativeRepository();
        $result = $this->listAllRepresentativeRepository->noPagination($request);

        //Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(Collection::class, $result);
    }
}
