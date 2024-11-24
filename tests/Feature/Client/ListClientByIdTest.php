<?php

namespace Tests\Feature\Client;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListClientByIdTest extends TestCase
{
    private array $client = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = Client::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_get_list_find_by_id_base_response_200(): void
    {
        // Arrange
        $client = $this->client;

        // Act
        $response = $this->getJson(route('client.find', ['id' => $client['id']]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
