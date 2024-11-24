<?php

namespace Tests\Unit\Services\Client;

use App\Data\Repositories\Client\Interfaces\IUpdateClientRepository;
use App\Domain\Services\Client\Concretes\UpdateClientService;
use App\Http\Requests\Client\UpdateClientRequest;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateClientServiceTest extends TestCase
{
    private UpdateClientRequest $request;
    private IUpdateClientRepository $updateUserRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'client_id' => 1,
            'city_id' => 50,
            'address' => Str::random(50),
            'state' => 'CE',
            'city_name' => 'Fortaleza',
        ];
    }

    public function test_success_edit_client_service(): void
    {
        // Arrange
        $this->request = new UpdateClientRequest();
        $this->request['client_id'] = $this->data['client_id'];
        $this->request['city_id'] = $this->data['city_id'];
        $this->request['address'] = $this->data['address'];
        $this->request['state'] = $this->data['state'];
        $this->request['city_name'] = $this->data['city_name'];

        $this->updateUserRepository = $this->mock(IUpdateClientRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $updateClientService = new UpdateClientService($this->updateUserRepository);
        $result = $updateClientService->update($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
        $this->assertEquals($this->request['client_id'], $this->data['client_id']);
        $this->assertEquals($this->request['city_id'], $this->data['city_id']);
        $this->assertEquals($this->request['address'], $this->data['address']);
        $this->assertEquals($this->request['state'], $this->data['state']);
        $this->assertEquals($this->request['city_name'], $this->data['city_name']);
    }
}
