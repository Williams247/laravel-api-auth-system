<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\App\AuthService;
use Illuminate\Validation\ValidationException;
use App\Services\JsonResponseService;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    # Register user with validation
    public function register_user(Request $request)
    {
        try {
            # Validate request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:6',
            ]);

            # Call service
            $data = $this->authService->register_user($validated);

            return $data;

        } catch (ValidationException $e) {
            return JsonResponseService::json('Validation error', false, 422, $e->errors());
        } catch (\Throwable $e) {
            return JsonResponseService::json('Something went wrong', false, 500, data: null);
        }
    }

    public function login_user(Request $request)
    {
        try {
            # Validate request
            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:6',
            ]);

            $data = $this->authService->login_user($validated);

            return $data;

        } catch (ValidationException $e) {
            return JsonResponseService::json('Validation error', false, 422, $e->errors());
        } catch (\Throwable $e) {
            return JsonResponseService::json('Invalid credentials',false, 401,data: null);
        }
    }
}
