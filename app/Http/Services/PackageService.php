<?php

namespace App\Http\Services;

use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PackageService {


    public function getAll()
    {
        return response()->json(Package::all(), 200);
    }

    public function create(array $request)
    {
        $package = Package::create($request);

        return response(['id' => $package->id], 201);
    }

}
