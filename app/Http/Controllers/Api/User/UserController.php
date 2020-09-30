<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function details(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user)
                return response(['errors' => ['Unauthorized']], 401);
            return response(['user' => new UserResource($user)]);
        }
        catch (\Throwable $exception) {
            return response(['errors' => [$exception->getMessage()]], 500);
        }
    }
}
