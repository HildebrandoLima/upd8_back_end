<?php

namespace App\Data\Repositories\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\IUpdateClientRepository;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\City;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class UpdateClientRepository implements IUpdateClientRepository
{
    private City $city;

    use RequestConfigurator;

    public function update(UpdateClientRequest $request): bool
    {
        try {
            DB::beginTransaction();
            $this->setRequest($request);
            $this->updateCity();
            $this->updateClient();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar edição de cliente:', ['exception' => $e->getMessage()]);
			return false;
        }
    }

    private function updateCity(): void
    {
        City::where('id', $this->request->city_id)
        ->update([
            'state' => $this->request->state,
            'city_name' => $this->request->city_name,
        ]);
    }

    private function updateClient(): void
    {
        Client::where('id', $this->request->client_id)
        ->update([
            'address' => $this->request->address,
        ]);
    }
}
