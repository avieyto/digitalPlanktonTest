<?php


namespace App\Services;


use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\Contracts\IUserRegisterService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRegisterService implements IUserRegisterService
{
    /**
     * @inheritdoc
     */
    public function registerUser(RegisterRequest $registerRequest)
    {
        $registerRequest['password'] = Hash::make($registerRequest->get('password'));
        $registerRequest['remember_token'] = Str::random(15);

        /**
         * @var $user User
         */
        $user = User::factory()->newModel($registerRequest->all(['name', 'email', 'password']));
        $user->save();
        return $user;
    }
}
