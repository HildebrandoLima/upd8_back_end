<?php

namespace App\Data\Repositories\Representative\Concretes;

use App\Data\Repositories\Representative\Interfaces\IDeleteRepresentativeByIdRepository;
use App\Models\Representative;
use App\Models\RepresentativeClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class DeleteRepresentativeByIdRepository implements IDeleteRepresentativeByIdRepository
{
    public function delete(int $id): bool
    {
        try {
            DB::beginTransaction();
            $this->deleteRepresentativeClient($id);
            $this->deleteRepresentative($id);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar remoção do representante:', ['exception' => $e->getMessage()]);
			return false;
        }
    }

    private function deleteRepresentativeClient(int $id): void
    {
        RepresentativeClient::where('representative_id', $id)->delete();
    }

    private function deleteRepresentative(int $id): void
    {
        Representative::where('id', $id)->delete();
    }
}
