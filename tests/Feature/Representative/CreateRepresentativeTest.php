<?php

namespace Tests\Feature\Representative;

use App\Domain\Traits\GenerateData\GenerateCNPJ;
use App\Models\Client;
use App\Models\Representative;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateRepresentativeTest extends TestCase
{
    use GenerateCNPJ;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @group representative
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $data = [
            'name' => Str::random(10),
            'cnpj' => $this->generateCNPJ(),
            'address' => Str::random(50),
            'state' => 'CE',
            'city_name' => 'Fortaleza',
            'clients' => [Client::factory()->createOne()->id]
        ];

        // Act
        $response = $this->postJson(route('representative.create'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group representative
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $data = [
            'name' => null,
            'cnpj' => $this->generateCNPJ(),
            'address' => Str::random(50),
            'state' => 'CE',
            'city_name' => 'Fortaleza',
            'clients' => []
        ];

        // Act
        $response = $this->postJson(route('representative.create'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group representative
     */
    public function it_endpoint_post_base_response_409(): void
    {
        // Arrange
        $representative = Representative::factory()->createOne()->toArray();
        $data = [
            'name' => $representative['name'],
            'cnpj' => $representative['cnpj'],
            'address' => Str::random(50),
            'state' => 'CE',
            'city_name' => 'Fortaleza',
            'clients' => [1, 2]
        ];

        // Act
        $response = $this->postJson(route('representative.create'), $data);

        // Assert
        $response->assertStatus(409);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 409);
    }
}
