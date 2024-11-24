<?php

namespace Tests\Feature\City;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllCityTest extends TestCase
{
    private int $count = 5;
    private array $city = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->city = City::factory($this->count)->create()->toArray();
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_get_list_all_base_response_200(): void
    {
        // Arrange
        $this->city;

        // Act
        $response = $this->getJson(route('cities'));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
