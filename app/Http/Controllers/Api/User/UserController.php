<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function details(Request $request)
    {
        $user = $request->user();
        if (!$user)
            return response(['errors' => ['Unauthorized']], 401);
        return response(['user' => $user]);
    }
}
