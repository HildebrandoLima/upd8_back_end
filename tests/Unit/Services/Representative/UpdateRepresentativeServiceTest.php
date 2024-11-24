<?php

namespace Tests\Unit\Services\Representative;

use App\Data\Repositories\Representative\Interfaces\IUpdateRepresentativeRepository;
use App\Domain\Services\Representative\Concretes\UpdateRepresentativeService;
use App\Http\Requests\Representative\UpdateRepresentativeRequest;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateRepresentativeServiceTest extends TestCase
{
    private UpdateRepresentativeRequest $request;
    private IUpdateRepresentativeRepository $updateUserRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'Representative_id' => 1,
            'city_id' => 50,
            'address' => Str::random(50),
            'state' => 'CE',
            'city_name' => 'Fortaleza',
            'clients' => [1, 2],
        ];
    }

    public function test_success_edit_Representative_service(): void
    {
        // Arrange
        $this->request = new UpdateRepresentativeRequest();
        $this->request['Representative_id'] = $this->data['Representative_id'];
        $this->request['city_id'] = $this->data['city_id'];
        $this->request['address'] = $this->data['address'];
        $this->request['state'] = $this->data['state'];
        $this->request['city_name'] = $this->data['city_name'];
        $this->request['clients'] = $this->data['clients'];

        $this->updateUserRepository = $this->mock(IUpdateRepresentativeRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $updateRepresentativeService = new UpdateRepresentativeService($this->updateUserRepository);
        $result = $updateRepresentativeService->update($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
        $this->assertEquals($this->request['Representative_id'], $this->data['Representative_id']);
        $this->assertEquals($this->request['city_id'], $this->data['city_id']);
        $this->assertEquals($this->request['address'], $this->data['address']);
        $this->assertEquals($this->request['state'], $this->data['state']);
        $this->assertEquals($this->request['city_name'], $this->data['city_name']);
        $this->assertEquals($this->request['clients'], $this->data['clients']);
    }
}
