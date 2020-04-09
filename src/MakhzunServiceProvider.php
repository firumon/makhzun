<?php

namespace Firumon\Makhzun;

use Firumon\Makhzun\View\Components\Api;
use Firumon\Makhzun\View\Components\Box;
use Firumon\Makhzun\View\Components\Card;
use Firumon\Makhzun\View\Components\Form;
use Firumon\Makhzun\View\Components\Input;
use Firumon\Makhzun\View\Components\Modal;
use Firumon\Makhzun\View\Components\Options;
use Firumon\Makhzun\View\Components\Table;
use Illuminate\Support\ServiceProvider;

class MakhzunServiceProvider extends ServiceProvider
{

    private static $root = __DIR__ . '\\..\\';
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

        $this->loadViewsFrom(self::getRoot('views'),'Makhzun');

        $this->loadRoutesFrom(self::getRoot('routes','web.php'));
        $this->loadRoutesFrom(self::getRoot('routes','api.php'));

        $this->mergeConfigFrom(self::getRoot('config','menu.php'),'adminlte.menu');
        $this->mergeConfigFrom(self::getRoot('config','plugins.php'),'adminlte.plugins');

        $this->loadViewComponentsAs('makhzun',[Card::class,Table::class,Input::class,Options::class,Box::class,Api::class,Form::class,Modal::class]);
    }


    private function registerMacros()
    {
        BlueprintMacros::macro();
    }

    private static function getRoot($folder = null,$file = null){
        $path = ($folder ? "$folder\\" : "") . ($file ? "$file" : '');
        return self::$root . $path;
    }

}
