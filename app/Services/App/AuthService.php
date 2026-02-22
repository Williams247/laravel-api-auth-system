<?php

namespace App\Services\App;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\JsonResponseService;

class AuthService
{

    public function register_user(array $validatedData)
    {
        # Check if user already exists
        if (User::where('email', $validatedData['email'])->exists()) {
            return JsonResponseService::json('User already exists', false, 409, null);
        }

        # Create user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        # Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        # Return response data
        return JsonResponseService::json('User registered successfully', true, 201, [
            'user' => $user->only('id', 'name', 'email'),
            'token' => $token
        ]);
    }

    public function login_user(array $validatedData)
    {
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return JsonResponseService::json('Invalid credentials', false, 401, null);
        }

        # Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        # Return response
        return JsonResponseService::json('Login successful', true, 200, [
            'user' => $user->only('id', 'name', 'email'),
            'token' => $token
        ]);
    }
}
