<?php

namespace App\Providers;

use App;
use App\Repositories\SsoTicket\SsoTicketInterface;
use App\Repositories\SsoTicket\SsoTicketRepository;
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
    }
}
