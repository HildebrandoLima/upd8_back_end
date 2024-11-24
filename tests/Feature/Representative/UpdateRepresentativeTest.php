<?php

namespace Tests\Feature\Representative;

use App\Models\City;
use App\Models\Client;
use App\Models\Representative;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateRepresentativeTest extends TestCase
{
    private array $representative = [];
    private array $city = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->representative = Representative::factory()->createOne()->toArray();
        $this->city = City::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group representative
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $data = [
            'representative_id' => $this->representative['id'],
            'city_id' => $this->city['id'],
            'address' => $this->representative['address'],
            'state' => 'CE',
            'city_name' => 'Fortaleza',
            'clients' => [Client::factory()->createOne()->id],
        ];

        // Act
        $response = $this->putJson(route('representative.update'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group representative
     */
    public function it_endpoint_put_base_response_400(): void
    {
        // Arrange
        $data = [
            'client_id' =>  $this->representative['id'],
            'city_id' => null,
            'address' => $this->representative['address'],
            'state' => null,
            'city_name' => 'Fortaleza',
        ];

        // Act
        $response = $this->putJson(route('representative.update'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
