<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class ModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $modulesPath = app_path('Modules');

        if (! File::exists($modulesPath)) {
            return;
        }

        $modules = File::directories($modulesPath);

        foreach ($modules as $module) {
            $sidebarPath = $module . '/Sidebar/register.php';
            if (File::exists($sidebarPath)) {
                require $sidebarPath;
            }
        }

        foreach ($modules as $module) {
            $routePath = $module . '/Routes/web.php';
            if (File::exists($routePath)) {
                Route::middleware('web')
                    ->group($routePath);
            }

            $viewsPath = $module . '/Views';
            if (File::exists($viewsPath)) {
                $moduleName = basename($module);
                $this->loadViewsFrom($viewsPath, $moduleName);
            }
        }
    }
}
