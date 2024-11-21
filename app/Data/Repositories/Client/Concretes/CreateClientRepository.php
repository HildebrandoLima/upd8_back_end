<?php

namespace App\Data\Repositories\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\ICreateClientRepository;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Client\CreateClientRequest;
use App\Models\City;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class CreateClientRepository implements ICreateClientRepository
{
    private City $city;

    use RequestConfigurator;

    public function create(CreateClientRequest $request): bool
    {
        try {
            DB::beginTransaction();
            $this->setRequest($request);
            $this->createCity();
            $this->createClient();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar cadastro de cliente:', ['exception' => $e->getMessage()]);
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

    private function createClient(): void
    {
        Client::query()
        ->create([
            'name' => $this->request->name,
            'cpf' => $this->request->cpf,
            'date_birth' => $this->request->date_birth,
            'sex' => $this->request->sex,
            'address' => $this->request->address,
            'city_id' => $this->city->id,
        ]);
    }
}
