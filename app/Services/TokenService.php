<?php


namespace App\Services;


use App\Models\User;
use App\Services\Contracts\ITokenService;

class TokenService implements ITokenService
{
    /**
     * @inheritDoc
     */
    public function createTokenByUser(User $user)
    {
        $appName = env('APP_NAME');
        return $user->createToken($appName);
    }
}
