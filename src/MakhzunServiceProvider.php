<?php

namespace Firumon\Makhzun;

use Illuminate\Support\ServiceProvider;

class MakhzunServiceProvider extends ServiceProvider
{

    private static $root = __DIR__ . '\\..\\';
    private static $configKeys = ['adminlte.menu','adminlte.plugins','filesystems.disks','makhzun.page_routes'];
    private static $routeFiles = ['web.php','api.php'];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMacros();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */

    public function boot()
    {
        $this->publishes([__DIR__.'\..\makhzun.php' => config_path('makhzun.php')]);
        $this->mergeConfigs();

        $this->loadRoutes();

        ViewComponents::register();
        $this->loadViewsFrom(self::getRoot('views'),'Makhzun');
    }

    private static function getRoot($folder = null,$file = null){
        $path = ($folder ? "$folder\\" : "") . ($file ? "$file" : '');
        return self::$root . $path;
    }

    private function registerMacros(){ BlueprintMacros::macro(); }
    private function mergeConfigs(){ foreach (self::$configKeys as $key) $this->mergeConfigFrom(self::getRoot('config',"$key.php"),$key); }
    private function loadRoutes(){ foreach (self::$routeFiles as $file) $this->loadRoutesFrom(self::getRoot('routes',$file)); }

}
