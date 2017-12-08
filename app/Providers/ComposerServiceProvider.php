<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('management.permission.*', 'App\Http\ViewComposers\SourceComposer');
        view()->composer('management.role.*', 'App\Http\ViewComposers\SourceComposer');
        view()->composer('management.user_role.*', 'App\Http\ViewComposers\SourceComposer');
        view()->composer('management.user_permission.*', 'App\Http\ViewComposers\SourceComposer');
        view()->composer('management.*', 'App\Http\ViewComposers\SidebarComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
