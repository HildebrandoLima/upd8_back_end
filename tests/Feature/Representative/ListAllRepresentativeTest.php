<?php

namespace Tests\Feature\Representative;

use App\Models\Representative;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllRepresentativeTest extends TestCase
{
    private int $count = 10;
    private array $representative = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->representative = Representative::factory($this->count)->create()->toArray();
    }

    /**
     * @test
     * @group representative
     */
    public function it_endpoint_get_list_all_has_pagination_base_response_200(): void
    {
        // Arrange
        $this->representative;

        // Act
        $response = $this->getJson(route('representative.all', ['page' => 1, 'perPage' => 10]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->count, $this->countPaginateList($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group representative
     */
    public function it_endpoint_get_list_all_no_pagination_base_response_200(): void
    {
        // Arrange
        $this->representative;

        // Act
        $response = $this->getJson(route('representative.all', []));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group representative
     */
    public function it_endpoint_get_list_all_has_pagination_base_and_seacrh_name_response_200(): void
    {
        // Arrange
        $this->representative;

        // Act
        $response = $this->getJson(route('representative.all', ['page' => 1, 'perPage' => 10, 'name' => $this->representative[0]['name']]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals(1, $this->countPaginateList($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
