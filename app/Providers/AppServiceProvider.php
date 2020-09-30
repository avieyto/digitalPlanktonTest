<?php

namespace App\Providers;

use App\Services\Contracts\INotificationService;
use App\Services\Contracts\ITokenService;
use App\Services\Contracts\IUserRegisterService;
use App\Services\NotificationService;
use App\Services\TokenService;
use App\Services\UserRegisterService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ITokenService::class, TokenService::class);
        $this->app->bind(IUserRegisterService::class, UserRegisterService::class);
        $this->app->bind(INotificationService::class, NotificationService::class);
    }
}
