<?php

namespace App\Http\Controllers;

use App\Domain\Services\Client\Interfaces\ICreateClientService;
use App\Domain\Services\Client\Interfaces\IDeleteClientByIdService;
use App\Domain\Services\Client\Interfaces\IListAllClientService;
use App\Domain\Services\Client\Interfaces\IListClientByIdService;
use App\Domain\Services\Client\Interfaces\IUpdateClientService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientRequest;
use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Exception;

class ClientController extends Controller
{
    private ICreateClientService     $createClientService;
    private IDeleteClientByIdService $deleteClientByIdService;
    private IListAllClientService    $listAllClientService;
    private IListClientByIdService   $listClientByIdService;
    private IUpdateClientService     $updateClientService;

    public function __construct
    (
        ICreateClientService     $createClientService,
        IDeleteClientByIdService $deleteClientByIdService,
        IListAllClientService    $listAllClientService,
        IListClientByIdService   $listClientByIdService,
        IUpdateClientService     $updateClientService
    )
    {
        $this->createClientService     = $createClientService;
        $this->deleteClientByIdService = $deleteClientByIdService;
        $this->listAllClientService    = $listAllClientService;
        $this->listClientByIdService   = $listClientByIdService;
        $this->updateClientService     = $updateClientService;
    }

    public function index(Request $request): Response
    {
        try {
            $success = $this->listAllClientService->listAll($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function show(ClientRequest $request): Response
    {
        try {
            $success = $this->listClientByIdService->listFind($request->id);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function store(CreateClientRequest $request): Response
    {
        try {
            $success = $this->createClientService->create($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(UpdateClientRequest $request): Response
    {
        try {
            $success = $this->updateClientService->update($request);
            return Controller::put($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function destroy(ClientRequest $request): Response
    {
        try {
            $success = $this->deleteClientByIdService->delete($request->id);
            return Controller::delete($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
