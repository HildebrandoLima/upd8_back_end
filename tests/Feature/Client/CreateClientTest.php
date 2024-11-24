<?php

namespace Tests\Feature\Client;

use App\Domain\Traits\GenerateData\GenerateCPF;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateClientTest extends TestCase
{
    use GenerateCPF;

    private Collection $sex;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sex = collect(['M', 'F']);
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $randSex = $this->sex->random();
        $data = [
            'name' => Str::random(10),
            'cpf' => $this->generateCPF(),
            'address' => Str::random(50),
            'date_birth' => '2000-10-02',
            'sex' => $randSex,
            'state' => 'CE',
            'city_name' => 'Fortaleza',
        ];

        // Act
        $response = $this->postJson(route('client.create'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $randSex = $this->sex->random();
        $data = [
            'name' => Str::random(10),
            'cpf' => $this->generateCPF(),
            'address' => Str::random(50),
            'date_birth' => date('Y-m-d'),
            'sex' => $randSex,
            'state' => 'CE',
            'city_name' => 'Fortaleza',
        ];

        // Act
        $response = $this->postJson(route('client.create'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_post_base_response_409(): void
    {
        // Arrange
        $client = Client::factory()->createOne()->toArray();
        $randSex = $this->sex->random();
        $data = [
            'name' => $client['name'],
            'cpf' =>  $client['cpf'],
            'address' => Str::random(50),
            'date_birth' => date('Y-m-d'),
            'sex' => $randSex,
            'state' => 'CE',
            'city_name' => 'Fortaleza',
        ];

        // Act
        $response = $this->postJson(route('client.create'), $data);

        // Assert
        $response->assertStatus(409);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 409);
    }
}
