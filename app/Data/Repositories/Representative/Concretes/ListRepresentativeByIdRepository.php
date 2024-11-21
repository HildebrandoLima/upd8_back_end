<?php

namespace App\Data\Repositories\Representative\Concretes;

use App\Data\Repositories\Representative\Interfaces\IListRepresentativeByIdRepository;
use App\Models\Representative;
use Illuminate\Support\Collection;

class ListRepresentativeByIdRepository implements IListRepresentativeByIdRepository
{
    public function listFindById(int $id): Collection
    {
        return Representative::with(['city', 'clients'])->where('id', $id)->get();
    }
}
