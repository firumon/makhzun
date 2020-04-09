<?php

    use Illuminate\Support\Facades\Route;
    $namespace = '\\Firumon\\Makhzun\\Controller';

    Route::group([
        'namespace'     =>      $namespace,
        'prefix'        =>      'makhzun/api'
    ],function (){
        Route::get('/',function(){ return route('api_path'); })->name('api_path');
        Route::get('{code}','APIController@fetch');
        Route::get('model/{model}/fetch/{id}','APIController@modelFetch')->name('api_model_fetch');
        Route::get('options/{type}/{name}/{label?}','APIController@optionsFetch')->name('api_options_fetch');
    });
