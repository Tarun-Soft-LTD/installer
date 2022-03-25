<?php

namespace NirapodSoft\Installer;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use NirapodSoft\Installer\Http\Middleware\Activator;
use NirapodSoft\Installer\Http\Middleware\canInstall;

class InstallerServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $router->middlewareGroup('install',[canInstall::class]);
        $router->middlewareGroup('application',[Activator::class]);
        $this->loadRoutesFrom(__DIR__.'/routes/installer.php');
        $this->loadViewsFrom(__DIR__.'/views','installer');
        $this->publishItems();
    }

    protected function publishItems()
    {
        $this->publishes([
            __DIR__.'/config/nirapodInstaller.php' => config_path('nirapodInstaller.php')
        ],'nirapod-installer-config');
    }
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/nirapodInstaller.php','nirapodInstaller');
    }
}