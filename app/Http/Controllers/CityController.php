<?php

namespace App\Http\Controllers;

use App\Domain\Services\City\Interfaces\IListAllCityService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class CityController extends Controller
{
    private IListAllCityService $listAllCityService;

    public function __construct(IListAllCityService $listAllCityService)
    {
        $this->listAllCityService = $listAllCityService;
    }

    public function index(): Response
    {
        try {
            $success = $this->listAllCityService->listAll();
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
