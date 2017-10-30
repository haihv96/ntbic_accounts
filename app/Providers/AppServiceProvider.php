<?php

namespace App\Providers;

use App;
use App\Repositories\SsoTicket\SsoTicketInterface;
use App\Repositories\SsoTicket\SsoTicketRepository;

use App\Repositories\SpatiePermission\SpatiePermissionInterface;
use App\Repositories\SpatiePermission\SpatiePermissionRepository;

use App\Repositories\SpatieRole\SpatieRoleInterface;
use App\Repositories\SpatieRole\SpatieRoleRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(SsoTicketInterface::class, SsoTicketRepository::class);
        App::bind(SpatiePermissionInterface::class, SpatiePermissionRepository::class);
        App::bind(SpatieRoleInterface::class, SpatieRoleRepository::class);
    }
}
