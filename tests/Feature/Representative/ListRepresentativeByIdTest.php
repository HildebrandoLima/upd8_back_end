<?php

namespace Tests\Feature\Representative;

use App\Models\Representative;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListRepresentativeByIdTest extends TestCase
{
    private array $representative = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->representative = Representative::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group representative
     */
    public function it_endpoint_get_list_find_by_id_base_response_200(): void
    {
        // Arrange
        $representative = $this->representative;
        $data = [
            'id' => $representative['id']
        ];

        // Act
        $response = $this->getJson(route('representative.find', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group representative
     */
    public function it_endpoint_get_list_find_by_id_base_response_404(): void
    {
        // Arrange
        $data = [
            'id' => 9999
        ];

        // Act
        $response = $this->getJson(route('representative.find', $data));

        // Assert
        $response->assertStatus(404);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 404);
    }
}
