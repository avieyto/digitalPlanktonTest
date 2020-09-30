<?php


namespace App\Services\Contracts;


use App\Http\Requests\RegisterRequest;
use App\Models\User;

interface IUserRegisterService
{
    /**
     * @param RegisterRequest $registerRequest
     * @return User
     */
    function registerUser(RegisterRequest $registerRequest);
}
