<?php

namespace App\Domain\Services\Representative\Concretes;

use App\Data\Repositories\Representative\Interfaces\IUpdateRepresentativeRepository;
use App\Domain\Services\Representative\Interfaces\IUpdateRepresentativeService;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Representative\UpdateRepresentativeRequest;

class UpdateRepresentativeService implements IUpdateRepresentativeService
{
    use RequestConfigurator;

    private IUpdateRepresentativeRepository $updateRepresentativeRepository;

    public function __construct(IUpdateRepresentativeRepository $updateRepresentativeRepository)
    {
        $this->updateRepresentativeRepository = $updateRepresentativeRepository;
    }

    public function update(UpdateRepresentativeRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function updated(): bool
    {
        return $this->updateRepresentativeRepository->update($this->request);
    }
}
