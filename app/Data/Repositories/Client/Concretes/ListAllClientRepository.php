<?php

namespace App\Data\Repositories\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\IListAllClientRepository;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Client\ClientRequest;
use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListAllClientRepository implements IListAllClientRepository
{
    use RequestConfigurator;
    private Builder $query;
    private string $order = "";

    public function hasPagination(ClientRequest $request): LengthAwarePaginator
    {
        $this->setRequest($request);
        $this->queryBuilder();
        return $this->query->paginate(10);
    }

    public function noPagination(ClientRequest $request): Collection
    {
        $this->setRequest($request);
        $this->queryBuilder();
        return $this->query->get();
    }

    private function queryBuilder(): void
    {
        $this->query = Client::with('city')->join('city', 'city.id', '=', 'client.city_id');
        $this->getFilter();
        $this->order();
    }

    private function getFilter(): void
    {
        if (!empty($this->request->name)) {
            $this->query->where('client.name', 'like', '%' . $this->request->name . '%');
        }

        if (!empty($this->request->cpf)) {
            $this->query->where('client.cpf', 'like', '%' . $this->request->cpf . '%');
        }

        if (!empty($this->request->sex)) {
            $this->query->where('client.sex', $this->request->sex);
        }

        if (!empty($this->request->date_birth)) {
            $this->query->where('client.date_birth',  $this->request->date_birth);
        }

        if (!empty($this->request->state)) {
            $this->query->where('city.state', 'like', '%' . $this->request->state . '%');
        }

        if (!empty($this->request->city)) {
            $this->query->where('city.city_name', 'like', '%' . $this->request->city . '%');
        }

        $this->order = strtoupper($this->request->order);
    }

    private function order(): void
    {
        $this->query = $this->query->orderBy('client.id', in_array($this->order, ['ASC', 'DESC']) ? $this->order : 'ASC');
    }
}
