<?php

namespace App\Data\Repositories\Representative\Concretes;

use App\Data\Repositories\Representative\Interfaces\ICreateRepresentativeRepository;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Representative\CreateRepresentativeRequest;
use App\Models\City;
use App\Models\Representative;
use App\Models\RepresentativeClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class CreateRepresentativeRepository implements ICreateRepresentativeRepository
{
    private City $city;
    private Representative $representative;

    use RequestConfigurator;

    public function create(CreateRepresentativeRequest $request): bool
    {
        try {
            DB::beginTransaction();
            $this->setRequest($request);
            $this->createCity();
            $this->createRepresentative();
            $this->createRepresentativeClient();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar cadastro do representante:', ['exception' => $e->getMessage()]);
			return false;
        }
    }

    private function createCity(): void
    {
        $this->city = City::query()->create([
            'state' => $this->request->state,
            'city_name' => $this->request->city_name,
        ]);
    }

    private function createRepresentative(): void
    {
        $this->representative = Representative::query()
        ->create([
            'name' => $this->request->name,
            'cnpj' => $this->request->cnpj,
            'address' => $this->request->address,
            'city_id' => $this->city->id,
        ]);
    }

    private function createRepresentativeClient(): void
    {
        foreach ($this->request->clients as $value) {
            RepresentativeClient::query()->create([
                'representative_id' => $this->representative->id,
                'client_id' => $value,
            ]);
        }
    }
}
