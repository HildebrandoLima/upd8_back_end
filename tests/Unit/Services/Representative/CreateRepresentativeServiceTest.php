<?php

namespace Tests\Unit\Services\Representative;

use App\Data\Repositories\Representative\Interfaces\ICreateRepresentativeRepository;
use App\Domain\Services\Representative\Concretes\CreateRepresentativeService;
use App\Domain\Traits\GenerateData\GenerateCNPJ;
use App\Http\Requests\Representative\CreateRepresentativeRequest;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateRepresentativeServiceTest extends TestCase
{
    use GenerateCNPJ;

    private CreateRepresentativeRequest $request;
    private ICreateRepresentativeRepository $createRepresentativeRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'name' => Str::random(10),
            'cnpj' => $this->generateCNPJ(),
            'address' => Str::random(50),
            'state' => 'CE',
            'city_name' => 'Fortaleza',
            'clients' => [1, 2],
        ];
    }

    public function test_success_create_Representative_service(): void
    {
        // Arrange
        $this->request = new CreateRepresentativeRequest();
        $this->request['name'] = $this->data['name'];
        $this->request['cnpj'] = $this->data['cnpj'];
        $this->request['address'] = $this->data['address'];
        $this->request['state'] = $this->data['state'];
        $this->request['city_name'] = $this->data['city_name'];
        $this->request['clients'] = $this->data['clients'];

        $this->createRepresentativeRepository = $this->mock(ICreateRepresentativeRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $createRepresentativeService = new CreateRepresentativeService($this->createRepresentativeRepository);
        $result = $createRepresentativeService->create($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
        $this->assertEquals($this->request['name'], $this->data['name']);
        $this->assertEquals($this->request['cnpj'], $this->data['cnpj']);
        $this->assertEquals($this->request['address'], $this->data['address']);
        $this->assertEquals($this->request['state'], $this->data['state']);
        $this->assertEquals($this->request['city_name'], $this->data['city_name']);
        $this->assertEquals($this->request['clients'], $this->data['clients']);
    }
}
