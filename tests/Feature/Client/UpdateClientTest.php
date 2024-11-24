<?php

namespace Tests\Feature\Client;

use App\Models\City;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateClientTest extends TestCase
{
    private array $client = [];
    private array $city = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = Client::factory()->createOne()->toArray();
        $this->city = City::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $data = [
            'client_id' => $this->client['id'],
            'city_id' => $this->city['id'],
            'address' => $this->client['address'],
            'state' => 'CE',
            'city_name' => 'Fortaleza',
        ];

        // Act
        $response = $this->putJson(route('client.update'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_put_base_response_400(): void
    {
        // Arrange
        $data = [
            'client_id' =>  $this->client['id'],
            'city_id' => null,
            'address' => $this->client['address'],
            'state' => null,
            'city_name' => 'Fortaleza',
        ];

        // Act
        $response = $this->putJson(route('client.update'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
