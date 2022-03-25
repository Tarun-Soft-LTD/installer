<?php

namespace Nirapodsoft\Installer;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Nirapodsoft\Installer\Http\Middleware\Activator;
use Nirapodsoft\Installer\Http\Middleware\canInstall;

class InstallerServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $router->middlewareGroup('install',[canInstall::class]);
        $router->middlewareGroup('application',[Activator::class]);
        $this->loadRoutesFrom(__DIR__.'/routes/installer.php');
        $this->loadViewsFrom(__DIR__.'/views','installer');
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config/nirapodInstaller.php' => config_path('nirapodInstaller.php')
            ],'nirapod-installer-config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/nirapodInstaller.php','nirapodInstaller');
    }
}