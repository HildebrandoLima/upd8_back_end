<?php

namespace Tests\Unit\Repositories\Representative;

use App\Data\Repositories\Representative\Concretes\CreateRepresentativeRepository;
use App\Domain\Traits\GenerateData\GenerateCNPJ;
use App\Http\Requests\Representative\CreateRepresentativeRequest;
use App\Models\Client;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateRepresentativeRepositoryTest extends TestCase
{
    use GenerateCNPJ;

    use DatabaseTransactions;
    private CreateRepresentativeRepository $createRepresentativeRepository;

    public function test_success_create_representative_repository(): void
    {
        //  Arrange
        $request = new CreateRepresentativeRequest();
        $request['name'] = Str::random(10);
        $request['cnpj'] = $this->generateCNPJ();
        $request['address'] = Str::random(50);
        $request['state'] = 'CE';
        $request['city_name'] = 'Fortaleza';
        $request['clients'] = [Client::factory()->createOne()->id];

        //  Act
        $this->createRepresentativeRepository = new CreateRepresentativeRepository();
        $result = $this->createRepresentativeRepository->create($request);

        //  Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
    }
}
