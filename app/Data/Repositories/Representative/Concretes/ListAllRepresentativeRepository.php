<?php

namespace App\Data\Repositories\Representative\Concretes;

use App\Data\Repositories\Representative\Interfaces\IListAllRepresentativeRepository;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Representative\RepresentativeRequest;
use App\Models\Representative;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ListAllRepresentativeRepository implements IListAllRepresentativeRepository
{
    use RequestConfigurator;
    private Builder $query;
    private string $order = "";

    public function hasPagination(RepresentativeRequest $request): LengthAwarePaginator
    {
        $this->setRequest($request);
        $this->queryBuilder();
        return Cache::remember('clients', 60, function() {
            return $this->query->paginate(10);
        });
    }

    public function noPagination(RepresentativeRequest $request): Collection
    {
        $this->setRequest($request);
        $this->queryBuilder();
        return Cache::remember('clients', 60, function() {
            return $this->query->get();
        });
    }

    private function queryBuilder(): void
    {
        $this->query = Representative::with(['city', 'clients']);
        $this->getFilter();
        $this->order();
    }

    private function getFilter(): void
    {
        if (!empty($this->request->name)) {
            $this->query->where('representative.name', 'like', '%' . $this->request->name . '%');
        }

        if (!empty($this->request->cpf)) {
            $this->query->where('representative.cnpj', 'like', '%' . $this->request->cpf . '%');
        }

        if (!empty($this->request->state)) {
            $this->query->where('city.state', $this->request->state);
        }

        if (!empty($this->request->city)) {
            $this->query->where('city.city', $this->request->city);
        }

        $this->order = strtoupper($this->request->order);
    }

    private function order(): void
    {
        $this->query = $this->query->orderBy('representative.id', in_array($this->order, ['ASC', 'DESC']) ? $this->order : 'ASC');
    }
}
