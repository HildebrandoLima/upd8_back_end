<?php

namespace Tests\Unit\Services\Client;

use App\Data\Repositories\City\Concretes\ListAllCityRepository;
use App\Domain\Services\City\Concretes\ListAllCityService;
use Mockery\MockInterface;
use Tests\TestCase;

class ListAllCityServiceTest extends TestCase
{
    private ListAllCityRepository $listAllCityRepository;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_city_all_service(): void
    {
        // Arrange
        $expectedResult = collect([]);

        $this->listAllCityRepository = $this->mock(ListAllCityRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('listAll')
                     ->andReturn($expectedResult);
        });

        // Act
        $listAllCityService = new ListAllCityService($this->listAllCityRepository);
        $result = $listAllCityService->listAll();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
