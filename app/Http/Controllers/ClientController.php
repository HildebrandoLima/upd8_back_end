<?php

namespace App\Http\Controllers;

use App\Domain\Services\Client\Interfaces\ICreateClientService;
use App\Domain\Services\Client\Interfaces\IListAllClientService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientRequest;
use App\Http\Requests\Client\CreateClientRequest;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class ClientController extends Controller
{
    private ICreateClientService  $createClientService;
    private IListAllClientService $listAllClientService;

    public function __construct
    (
        ICreateClientService  $createClientService,
        IListAllClientService $listAllClientService
    )
    {
        $this->createClientService  = $createClientService;
        $this->listAllClientService = $listAllClientService;
    }

    public function index(ClientRequest $request): Response
    {
        try {
            $success = $this->listAllClientService->listAll($request);
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
}
