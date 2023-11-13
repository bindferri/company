<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;

class AuthService {


    public function register(array $request)
    {
        $request['uuid'] = Uuid::uuid4()->toString();
        $user = User::create($request);

        $token = $user->createToken(config('auth.secret_key'))->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(array $request)
    {
        $user = User::where('email', $request['email'])->firstOrFail();

        if (!Hash::check($request['password'], $user->password)) {
           throw new UnauthorizedException('The provided credentials are incorrect.');
        }

        $token = $user->createToken(config('auth.secret_key'))->plainTextToken;

        return response()->json(['token' => $token], 200);
    }
}
