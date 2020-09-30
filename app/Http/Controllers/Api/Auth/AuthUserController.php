<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\Services\Contracts\ITokenService;
use App\Services\Contracts\IUserRegisterService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthUserController extends Controller
{
    /**
     * @var ITokenService
     */
    protected $tokenService;

    public function __construct(ITokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]))
                return response(['errors' => ['Invalid user credentials']], 401);

            /**
             * @var $user User
             */
            $user = Auth::user();

            $token = $this->tokenService->createTokenByUser($user);
            return response(['token' => new TokenResource($token)], 200);
        }
        catch (\Throwable $exception) {
            return response(['errors' => [$exception->getMessage()]], 500);
        }
    }

    /**
     * @param RegisterRequest $request
     * @param IUserRegisterService $registerService
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request, IUserRegisterService $registerService)
    {
        try {
            $user = $registerService->registerUser($request);

            $token = $this->tokenService->createTokenByUser($user);

            return response(['token' => new TokenResource($token), 'user' => new UserResource($user)], 200);

        }
        catch (\Throwable $exception) {
            return response(['errors' => [$exception->getMessage()]], 500);
        }
    }
}
