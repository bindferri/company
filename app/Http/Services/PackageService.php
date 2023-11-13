<?php

namespace App\Http\Services;

use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Ramsey\Uuid\Uuid;

class PackageService {


    public function getAll()
    {
        return response()->json(Package::all(), 200);
    }

    public function create(array $request)
    {
        $request['uuid'] = Uuid::uuid4()->toString();
        $package = Package::create($request);

        return response(['data' => $package->id], 201);
    }

    public function register(Package $package)
    {
        $user = User::find(Auth::id());

        if (!($package->limit > $package->registrations->count())) {
            throw new UnauthorizedException('This is not available');
        }

        $registration = $user->registrations()->attach($package->id,
            ['uuid' => Uuid::uuid4()->toString()
        ]);
        return response()->json(['data' => true]);
    }

}
