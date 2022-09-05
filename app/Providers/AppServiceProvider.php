<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
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
        $this->app->bind('App\Interfaces\CampInterface', 'App\Repositories\CampRepository');
        $this->app->bind('App\Interfaces\BlockInterface', 'App\Repositories\BlockRepository');
        $this->app->bind('App\Interfaces\AgencyInterface', 'App\Repositories\AgencyRepository');
        $this->app->bind('App\Interfaces\TeamInterface', 'App\Repositories\TeamRepository');
        $this->app->bind('App\Interfaces\UserInterface', 'App\Repositories\UserRepository');
        $this->app->bind('App\Interfaces\RoleInterface', 'App\Repositories\RoleRepository');
        $this->app->bind('App\Interfaces\TagAreaInterface', 'App\Repositories\TagAreaRepository');
        $this->app->bind('App\Interfaces\TagUserInterface', 'App\Repositories\TagUserRepository');
        $this->app->bind('App\Interfaces\LatrineInterface', 'App\Repositories\LatrineRepository');
        $this->app->bind('App\Interfaces\DesludgeInterface', 'App\Repositories\DesludgeRepository');
        $this->app->bind('App\Interfaces\SanitizationZoneInterface', 'App\Repositories\SanitizationZoneRepository');
        $this->app->bind('App\Interfaces\DashboardInterface', 'App\Repositories\DashboardRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
