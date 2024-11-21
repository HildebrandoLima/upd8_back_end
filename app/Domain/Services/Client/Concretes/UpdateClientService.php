<?php

namespace App\Domain\Services\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\IUpdateClientRepository;
use App\Domain\Services\Client\Interfaces\IUpdateClientService;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Client\UpdateClientRequest;

class UpdateClientService implements IUpdateClientService
{
    use RequestConfigurator;

    private IUpdateClientRepository $updateClientRepository;

    public function __construct(IUpdateClientRepository $updateClientRepository)
    {
        $this->updateClientRepository = $updateClientRepository;
    }

    public function update(UpdateClientRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function updated(): bool
    {
        return $this->updateClientRepository->update($this->request);
    }
}
