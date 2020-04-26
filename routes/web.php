<?php

    use Illuminate\Support\Facades\Route;
    use Firumon\Makhzun\Middleware\HandleRequestUpload;
    use Firumon\Makhzun\Middleware\HandleTopNavItems;

    Route::group([
        'middleware'    =>      ['web',HandleRequestUpload::class],
        'namespace'     =>      '\Firumon\Makhzun\Controller',
        'prefix'        =>      'makhzun'
    ],function (){
        Route::group([
            'middleware'    =>      [HandleTopNavItems::class],
            'prefix'        =>      'page'
        ],function(){
            foreach (config('makhzun.page_routes') as $prefix => $routes){
                Route::prefix($prefix)->group(function()use($routes){
                    foreach ($routes as $route){
                        $method = isset($route[3]) ? ($route[3] === 'any' ? 'match' : $route[3]) : 'get';
                        $name = isset($route[2]) ? $route[2] : '-';
                        $args = array_merge($method === 'match' ? [['get','post']] : [],[$route[0]],[$route[1]]);
                        Route::$method(...$args)->name($name);
                    }
                });
            }
        });
    });

    Route::any('/',function (){
        return view('Makhzun::adminlte');
    });

