<?php

namespace App\Services\App;

use App\Models\User;
use App\Services\JsonResponseService;

class UserService
{
    # Return authenticated user profile
    public function fetch_user($id)
    {
       # Fetch user from db
       $user = User::where('id', $id)->first();

        # Return response
        return JsonResponseService::json(
            'User fetched successfully',
            true,
            200,
            [
                'user' => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at,
                ]
            ]
        );
    }
}

?>
