<?php

namespace Tests\Feature\Client;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllClientTest extends TestCase
{
    private int $count = 10;
    private array $client = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = Client::factory($this->count)->create()->toArray();
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_get_list_all_has_pagination_base_response_200(): void
    {
        // Arrange
        $this->client;

        // Act
        $response = $this->getJson(route('client.all', ['page' => 1, 'perPage' => 10]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->count, $this->countPaginateList($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_get_list_all_no_pagination_base_response_200(): void
    {
        // Arrange
        $this->client;

        // Act
        $response = $this->getJson(route('client.all', []));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_get_list_all_has_pagination_base_and_seacrh_name_response_200(): void
    {
        // Arrange
        $this->client;

        // Act
        $response = $this->getJson(route('client.all', ['page' => 1, 'perPage' => 10, 'name' => $this->client[0]['name']]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals(1, $this->countPaginateList($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
