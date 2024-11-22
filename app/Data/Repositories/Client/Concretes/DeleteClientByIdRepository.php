<?php

namespace App\Data\Repositories\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\IDeleteClientByIdRepository;
use App\Models\Client;
use App\Models\RepresentativeClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class DeleteClientByIdRepository implements IDeleteClientByIdRepository
{
    public function  delete(int $id): bool
    {
        try {
            DB::beginTransaction();
            $this->deleteRepresentativeClient($id);
            $this->deleteClient($id);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar remoção do cliente:', ['exception' => $e->getMessage()]);
			return false;
        }
    }

    private function deleteRepresentativeClient(int $id): void
    {
        RepresentativeClient::where('client_id', $id)->delete();
    }

    private function deleteClient(int $id): void
    {
        Client::where('id', $id)->delete();
    }
}
