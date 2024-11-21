<?php

namespace App\Http\Controllers;

use App\Domain\Services\Client\Interfaces\IListAllClientService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientRequest;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class ClientController extends Controller
{
    private IListAllClientService $listAllClientService;

    public function __construct
    (
        IListAllClientService $listAllClientService
    )
    {
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
}
