<?php

namespace App\Providers;

use App;

use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;

use App\Repositories\SsoTicket\SsoTicketInterface;
use App\Repositories\SsoTicket\SsoTicketRepository;

use App\Repositories\SpatiePermission\SpatiePermissionInterface;
use App\Repositories\SpatiePermission\SpatiePermissionRepository;

use App\Repositories\SpatieRole\SpatieRoleInterface;
use App\Repositories\SpatieRole\SpatieRoleRepository;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(UserInterface::class, UserRepository::class);
        App::bind(SsoTicketInterface::class, SsoTicketRepository::class);
        App::bind(SpatiePermissionInterface::class, SpatiePermissionRepository::class);
        App::bind(SpatieRoleInterface::class, SpatieRoleRepository::class);
    }
}
