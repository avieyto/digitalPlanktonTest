<?php


namespace App\Services\Contracts;

use App\Models\User;
use Laravel\Passport\PersonalAccessTokenResult;

/**
 * Interface ITokenService
 * @package App\Services\Contracts
 */
interface ITokenService
{
    /**
     * Create a new token from user
     * @param User $user
     * @return PersonalAccessTokenResult
     */
    function createTokenByUser(User $user);
}
