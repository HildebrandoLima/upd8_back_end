<?php

namespace App\Domain\Services\Representative\Concretes;

use App\Data\Repositories\Representative\Interfaces\IDeleteRepresentativeByIdRepository;
use App\Domain\Services\Representative\Interfaces\IDeleteRepresentativeByIdService;

class DeleteRepresentativeByIdService implements IDeleteRepresentativeByIdService
{
    private IDeleteRepresentativeByIdRepository $deleteRepresentativeByIdRepository;

    public function __construct(IDeleteRepresentativeByIdRepository $deleteRepresentativeByIdRepository)
    {
        $this->deleteRepresentativeByIdRepository = $deleteRepresentativeByIdRepository;
    }

    public function delete(int $id): bool
    {
        return $this->deleteRepresentativeByIdRepository->delete($id);
    }
}
