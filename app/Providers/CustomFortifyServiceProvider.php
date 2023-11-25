<?php
namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Fortify\FortifyServiceProvider as ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;

class CustomFortifyServiceProvider extends ServiceProvider
{
    // ...
}
