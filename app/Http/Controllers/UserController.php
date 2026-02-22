<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\App\UserService;
use App\Services\JsonResponseService;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    # Fetch authenticated user profile
    public function fetch_user(Request $request)
    {
        try {

            # Sanctum already authenticated the user
            $user = $request->user();

            return $this->userService->fetch_user($user->only('id'));

        } catch (\Throwable $e) {

            return JsonResponseService::json(
                'Something went wrong',
                false,
                500,
                null
            );
        }
    }
}

?>
