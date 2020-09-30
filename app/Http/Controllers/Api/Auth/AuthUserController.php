<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthUserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);

            if ($validator->fails())
                return response(['errors' => $validator->errors()->all()], 400);

            /**
             * @var $user User
             */
            $user = User::query()->where('email', $request->get('email'))->first();
            if (!$user)
                return response(['errors' => ['Invalid user credentials']], 401);

            if (!Hash::check($request->get('password'), $user->password))
                return response(['errors' => ['Invalid user credentials']], 401);

            $token = $user->createToken(env('APP_NAME'))->accessToken;

            return response(['token' => $token, 'user' => $user], 200);
        }
        catch (\Throwable $exception) {
            return response(['errors' => [$exception->getMessage()]], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails())
                return response(['errors' => $validator->errors()->all()], 400);

            $request['password'] = Hash::make($request->get('password'));
            $request['remember_token'] = Str::random(15);

            /**
             * @var $user User
             */
            $user = User::factory()->create($request->all(['name', 'email', 'password']));
            $token = $user->createToken(env('APP_NAME'))->accessToken;
            return response(['token' => $token], 200);

        } catch (\Throwable $exception) {
            return response(['errors' => [$exception->getMessage()]], 500);
        }
    }
}
