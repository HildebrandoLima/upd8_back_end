<?php

namespace Tests\Unit\Repositories\Client;

use App\Data\Repositories\City\Concretes\ListAllCityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ListAllCityRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private ListAllCityRepository $listAllCityRepository;

    public function test_success_list_city_all_repository(): void
    {
        //  Arrange

        //  Act
        $this->listAllCityRepository = new ListAllCityRepository();
        $result = $this->listAllCityRepository->listAll();

        //  Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(Collection::class, $result);
    }
}
