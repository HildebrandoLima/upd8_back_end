<?php

namespace App\Domain\Services\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\ICreateClientRepository;
use App\Domain\Services\Client\Interfaces\ICreateClientService;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Client\CreateClientRequest;

class CreateClientService implements ICreateClientService
{
    use RequestConfigurator;

    private ICreateClientRepository $createClientRepository;

    public function __construct(ICreateClientRepository $createClientRepository)
    {
        $this->createClientRepository = $createClientRepository;
    }

    public function create(CreateClientRequest $request): bool
    {
        $this->setRequest($request);
        return $this->created();
    }

    private function created(): bool
    {
        return $this->createClientRepository->create($this->request);
    }
}
