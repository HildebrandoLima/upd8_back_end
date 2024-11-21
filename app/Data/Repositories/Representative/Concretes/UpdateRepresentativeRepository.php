<?php

namespace App\Data\Repositories\Representative\Concretes;

use App\Data\Repositories\Representative\Interfaces\IUpdateRepresentativeRepository;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Representative\UpdateRepresentativeRequest;
use App\Models\City;
use App\Models\Representative;
use App\Models\RepresentativeClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class UpdateRepresentativeRepository implements IUpdateRepresentativeRepository
{
    private City $city;

    use RequestConfigurator;

    public function update(UpdateRepresentativeRequest $request): bool
    {
        try {
            DB::beginTransaction();
            $this->setRequest($request);
            $this->updateCity();
            $this->updateRepresentative();
            $this->deleteRepresentativeClient();
            $this->createRepresentativeClient();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar edição de representante:', ['exception' => $e->getMessage()]);
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

    private function updateRepresentative(): void
    {
        Representative::where('id', $this->request->representative_id)
        ->update([
            'address' => $this->request->address,
        ]);
    }

    private function deleteRepresentativeClient(): void
    {
        RepresentativeClient::where('representative_id', $this->request->representative_id)->delete();
    }

    private function createRepresentativeClient(): void
    {
        foreach ($this->request->clients as $value) {
            RepresentativeClient::query()->create([
                'representative_id' => $this->request->representative_id,
                'client_id' => $value,
            ]);
        }
    }
}
