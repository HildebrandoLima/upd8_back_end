<?php

namespace Tests\Unit\Services\Client;

use App\Data\Repositories\Client\Interfaces\ICreateClientRepository;
use App\Domain\Services\Client\Concretes\CreateClientService;
use App\Domain\Traits\GenerateData\GenerateCPF;
use App\Http\Requests\Client\CreateClientRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateClientServiceTest extends TestCase
{
    use GenerateCPF;

    private CreateClientRequest $request;
    private ICreateClientRepository $createClientRepository;
    private Collection $sex;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->sex = collect(['M', 'F']);
        $randSex = $this->sex->random();
        $this->data = [
            'name' => Str::random(10),
            'cpf' => $this->generateCPF(),
            'address' => Str::random(50),
            'date_birth' => '2000-10-02',
            'sex' => $randSex,
            'state' => 'CE',
            'city_name' => 'Fortaleza',
        ];
    }

    public function test_success_create_client_service(): void
    {
        // Arrange
        $this->request = new CreateClientRequest();
        $this->request['name'] = $this->data['name'];
        $this->request['cpf'] = $this->data['cpf'];
        $this->request['address'] = $this->data['address'];
        $this->request['date_birth'] = $this->data['date_birth'];
        $this->request['sex'] = $this->data['sex'];
        $this->request['state'] = $this->data['state'];
        $this->request['city_name'] = $this->data['city_name'];

        $this->createClientRepository = $this->mock(ICreateClientRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $createClientService = new CreateClientService($this->createClientRepository);
        $result = $createClientService->create($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
        $this->assertEquals($this->request['name'], $this->data['name']);
        $this->assertEquals($this->request['cpf'], $this->data['cpf']);
        $this->assertEquals($this->request['address'], $this->data['address']);
        $this->assertEquals($this->request['date_birth'], $this->data['date_birth']);
        $this->assertEquals($this->request['sex'], $this->data['sex']);
        $this->assertEquals($this->request['state'], $this->data['state']);
        $this->assertEquals($this->request['city_name'], $this->data['city_name']);
    }
}
