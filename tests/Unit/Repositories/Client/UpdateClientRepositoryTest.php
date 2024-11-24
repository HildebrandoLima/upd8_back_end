<?php

namespace Tests\Unit\Repositories\Client;

use App\Data\Repositories\Client\Concretes\UpdateClientRepository;
use App\Http\Requests\Client\UpdateClientRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateClientRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private UpdateClientRepository $updateClientRepository;

    public function test_success_update_client_repository(): void
    {
        //  Arrange
        $request = new UpdateClientRequest();
        $request['client_id'] = 1;
        $request['city_id'] = 50;
        $request['address'] = Str::random(50);
        $request['state'] = 'CE';
        $request['city_name'] = 'Fortaleza';

        //  Act
        $this->updateClientRepository = new UpdateClientRepository();
        $result = $this->updateClientRepository->update($request);

        //  Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
    }
}
