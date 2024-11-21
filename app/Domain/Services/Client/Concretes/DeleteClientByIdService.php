<?php

namespace App\Domain\Services\Client\Concretes;

use App\Data\Repositories\Client\Interfaces\IDeleteClientByIdRepository;
use App\Domain\Services\Client\Interfaces\IDeleteClientByIdService;

class DeleteClientByIdService implements IDeleteClientByIdService
{
    private IDeleteClientByIdRepository $deleteClientByIdRepository;

    public function __construct(IDeleteClientByIdRepository $deleteClientByIdRepository)
    {
        $this->deleteClientByIdRepository = $deleteClientByIdRepository;
    }

    public function delete(int $id): bool
    {
        return $this->deleteClientByIdRepository->delete($id);
    }
}
