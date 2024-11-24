<?php

namespace Tests\Unit\Repositories\Client;

use App\Data\Repositories\Client\Concretes\CreateClientRepository;
use App\Http\Requests\Client\CreateClientRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateClientRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private CreateClientRepository $createClientRepository;

    public function test_success_create_client_repository(): void
    {
        //  Arrange
        $sex = collect(['M', 'F']);
        $randSex = $sex->random();
        $request = new CreateClientRequest();
        $request['name'] = Str::random(10);
        $request['cpf'] = $this->generateCPF();
        $request['address'] = Str::random(50);
        $request['date_birth'] = '2000-10-02';
        $request['sex'] = $randSex;
        $request['state'] = 'CE';
        $request['city_name'] = 'Fortaleza';

        //  Act
        $this->createClientRepository = new CreateClientRepository();
        $result = $this->createClientRepository->create($request);

        //  Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
    }
}
