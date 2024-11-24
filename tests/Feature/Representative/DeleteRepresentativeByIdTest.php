<?php

namespace Tests\Feature\Representative;

use App\Models\Representative;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteRepresentativeByIdTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @group representative
     */
    public function it_endpoint_delete_base_response_200(): void
    {
        // Arrange
        $representative = Representative::factory()->createOne()->toArray();
        $data = [
            'id' => $representative['id'],
        ];

        // Act
        $response = $this->deleteJson(route('representative.delete', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
