<?php

namespace App\Providers;

use App;

use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;

use App\Repositories\SsoTicket\SsoTicketInterface;
use App\Repositories\SsoTicket\SsoTicketRepository;

use App\Repositories\Permission\PermissionInterface;
use App\Repositories\Permission\PermissionRepository;

use App\Repositories\Role\RoleInterface;
use App\Repositories\Role\RoleRepository;

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
        App::bind(PermissionInterface::class, PermissionRepository::class);
        App::bind(RoleInterface::class, RoleRepository::class);
    }
}
