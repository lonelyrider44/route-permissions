<?php

namespace LR\Route\Permissions;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class RoutePermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->mergeConfigFrom(
        //     __DIR__.'/../config/courier.php', 'courier'
        // );

        app('router')->aliasMiddleware('crp', \LR\Route\Permissions\Middleware\CheckRoutePermission::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->publishes([
        //     __DIR__.'/../config/courier.php' => config_path('courier.php'),
        // ],'config');
        // $this->publishes([
        //     __DIR__.'/../resources/views' => resource_path('views/vendor/courier'),
        // ],'views');
        // \Log::debug(__DIR__.'/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'route_permissions');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }
}
