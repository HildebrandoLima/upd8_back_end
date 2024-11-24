<?php

namespace App\Http\Controllers;

use App\Domain\Services\Representative\Interfaces\ICreateRepresentativeService;
use App\Domain\Services\Representative\Interfaces\IDeleteRepresentativeByIdService;
use App\Domain\Services\Representative\Interfaces\IListAllRepresentativeService;
use App\Domain\Services\Representative\Interfaces\IListRepresentativeByIdService;
use App\Domain\Services\Representative\Interfaces\IUpdateRepresentativeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Representative\RepresentativeRequest;
use App\Http\Requests\Representative\CreateRepresentativeRequest;
use App\Http\Requests\Representative\UpdateRepresentativeRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Exception;

class RepresentativeController extends Controller
{
    private ICreateRepresentativeService     $createRepresentativeService;
    private IDeleteRepresentativeByIdService $deleteRepresentativeByIdService;
    private IListAllRepresentativeService    $listAllRepresentativeService;
    private IListRepresentativeByIdService   $listRepresentativeByIdService;
    private IUpdateRepresentativeService     $updateRepresentativeService;

    public function __construct
    (
        ICreateRepresentativeService     $createRepresentativeService,
        IDeleteRepresentativeByIdService $deleteRepresentativeByIdService,
        IListAllRepresentativeService    $listAllRepresentativeService,
        IListRepresentativeByIdService   $listRepresentativeByIdService,
        IUpdateRepresentativeService     $updateRepresentativeService
    )
    {
        $this->createRepresentativeService     = $createRepresentativeService;
        $this->deleteRepresentativeByIdService = $deleteRepresentativeByIdService;
        $this->listAllRepresentativeService    = $listAllRepresentativeService;
        $this->listRepresentativeByIdService   = $listRepresentativeByIdService;
        $this->updateRepresentativeService     = $updateRepresentativeService;
    }

    public function index(Request $request): Response
    {
        try {
            $success = $this->listAllRepresentativeService->listAll($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function show(RepresentativeRequest $request): Response
    {
        try {
            $success = $this->listRepresentativeByIdService->listFind($request->id);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function store(CreateRepresentativeRequest $request): Response
    {
        try {
            $success = $this->createRepresentativeService->create($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(UpdateRepresentativeRequest $request): Response
    {
        try {
            $success = $this->updateRepresentativeService->update($request);
            return Controller::put($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function destroy(RepresentativeRequest $request): Response
    {
        try {
            $success = $this->deleteRepresentativeByIdService->delete($request->id);
            return Controller::delete($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
