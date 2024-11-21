<?php

namespace App\Domain\Services\Representative\Concretes;

use App\Data\Repositories\Representative\Interfaces\ICreateRepresentativeRepository;
use App\Domain\Services\Representative\Interfaces\ICreateRepresentativeService;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Representative\CreateRepresentativeRequest;

class CreateRepresentativeService implements ICreateRepresentativeService
{
    use RequestConfigurator;

    private ICreateRepresentativeRepository $createRepresentativeRepository;

    public function __construct(ICreateRepresentativeRepository $createRepresentativeRepository)
    {
        $this->createRepresentativeRepository = $createRepresentativeRepository;
    }

    public function create(CreateRepresentativeRequest $request): bool
    {
        $this->setRequest($request);
        return $this->created();
    }

    private function created(): bool
    {
        return $this->createRepresentativeRepository->create($this->request);
    }
}
