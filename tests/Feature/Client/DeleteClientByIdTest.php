<?php

namespace Tests\Feature\Client;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteClientByIdTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_delete_base_response_200(): void
    {
        // Arrange
        $client = Client::factory()->createOne()->toArray();
        $data = [
            'id' => $client['id']
        ];

        // Act
        $response = $this->deleteJson(route('client.delete'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_delete_base_response_400(): void
    {
        // Arrange
        $data = [9999];

        // Act
        $response = $this->deleteJson(route('client.delete'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
