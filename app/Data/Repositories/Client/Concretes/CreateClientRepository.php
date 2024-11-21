<?php

namespace App\Data\Repositories\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\ICreateClientRepository;
use App\Http\Requests\Client\CreateClientRequest;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class CreateClientRepository implements ICreateClientRepository
{
    public function create(CreateClientRequest $request): bool
    {
        try {
            DB::beginTransaction();
            Client::query()
            ->create([
				'name' => $request->name,
                'cpf' => $request->cpf,
				'date_birth' => $request->date_birth,
				'sex' => $request->sex,
				'address' => $request->address,
                'city_id' => $request->city_id,
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar cadastro de usuário:', ['exception' => $e->getMessage()]);
			return false;
        }
    }
}
