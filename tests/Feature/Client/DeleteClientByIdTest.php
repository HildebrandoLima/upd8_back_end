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

        // Act
        $response = $this->deleteJson(route('client.delete', ['id' => $client['id']]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
