<?php

namespace Tests\Unit\Repositories\Representative;

use App\Data\Repositories\Representative\Concretes\UpdateRepresentativeRepository;
use App\Http\Requests\Representative\UpdateRepresentativeRequest;
use App\Models\City;
use App\Models\Client;
use App\Models\Representative;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateRepresentativeRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private UpdateRepresentativeRepository $updateRepresentativeRepository;

    public function test_success_update_representative_repository(): void
    {
        //  Arrange
        $request = new UpdateRepresentativeRequest();
        $request['representative_id'] = Representative::factory()->createOne()->id;
        $request['city_id'] = City::factory()->createOne()->id;
        $request['address'] = Str::random(50);
        $request['state'] = 'CE';
        $request['city_name'] = 'Fortaleza';
        $request['clients'] = [Client::factory()->createOne()->id];

        //  Act
        $this->updateRepresentativeRepository = new UpdateRepresentativeRepository();
        $result = $this->updateRepresentativeRepository->update($request);

        //  Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
    }
}
