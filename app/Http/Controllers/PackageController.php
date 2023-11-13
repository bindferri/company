<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageRequest;
use App\Http\Services\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    private $packageService;

    public function __construct(PackageService $packageService)
    {
        $this->packageService = $packageService;
    }

    public function index()
    {
        return $this->packageService->getAll();
    }

    public function store(PackageRequest $request)
    {
        return $this->packageService->create($request->validated());
    }
}
