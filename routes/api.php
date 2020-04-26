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
        Route::get('options/{type}/{name?}/{label?}','APIController@optionsFetch')->name('api_options_fetch');
        Route::get('country/update','CountryController@countryUpdate');
        Route::get('country/{country}/states','CountryController@states');
        Route::get('country/{country}/state','CountryController@state');
        Route::get('state/{state}/cities','CountryController@cities');
        Route::get('state/update','CountryController@stateUpdate');
        Route::get('country/{country}/state/{state}/city','CountryController@city');
        Route::get('city/update','CountryController@cityUpdate');
    });
