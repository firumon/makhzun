<?php

namespace Firumon\Makhzun;

use Firumon\Makhzun\Models\Product;
use Illuminate\Support\ServiceProvider;

class MakhzunServiceProvider extends ServiceProvider
{
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
        //
    }


    private function registerMacros()
    {
        BlueprintMacros::macro();
    }

}
