<?php

namespace App\Data\Repositories\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\IUpdateClientRepository;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class UpdateClientRepository implements IUpdateClientRepository
{
    public function update(UpdateClientRequest $request): bool
    {
        try {
            DB::beginTransaction();
            Client::where('id', $request->id)
            ->update([
				'address' => $request->address,
                'city_id' => $request->city_id,
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar edição de cliente:', ['exception' => $e->getMessage()]);
			return false;
        }
    }
}
