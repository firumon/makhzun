<?php

    return [
            'product' => array_merge([
//                ['uri','action','name','get/post/any','topnav_name','topnav_icon','search'],
                ['dashboard','ProductController@index','page.product.dashboard','get','Products','arrow-left',true],
                ['create','ProductController@create','page.product.create','any','New Product','box-open'],
                ['uom','ProductController@uom','page.product.uom','any','UOM','balance-scale'],
//                ['{id}/details','ProductController@details','page.product.details'],
                ['group/form','ProductController@group','page.product.group.form','post'],
                ['tax','ProductController@tax','page.product.tax','any','Tax','money-bill-wave',true],
            ],productGroupSubMenuRoutes()),
            'contact' => array_merge([
//                ['uri','action','name','get/post/any','topnav_name','topnav_icon','search'],
                ['/','ContactController@index','page.contact.index','get','Contacts','arrow-left',true],
                ['form','ContactController@form','page.contact.form','any','Create','user-plus'],
            ],[]),
            'settings' => array_merge([
//                ['uri','action','name','get/post/any','topnav_name','topnav_icon','search'],
                ['options/form','SettingsController@form','page.settings.options.form','post'],
                ['global','SettingsController@global','page.settings.global','any','Global Settings','cog',true],
                ['tax','SettingsController@tax','page.settings.tax','any','Taxes','comments-dollar',true],
                ['country','SettingsController@country','page.settings.country','any','Countries','flag',false],
            ],settingsOptionsSubMenuRoutes())
    ];

    function productGroupSubMenuRoutes(){
        $routes = [];
        foreach (PRODUCT_GROUP_NAME as $group => $name){
            $no = substr($group,-1);
            $routes[] = ["group/$no",'ProductController@group',"page.product.group$no",'get'];
        }
        return $routes;
    }

    function settingsOptionsSubMenuRoutes(){
        $options = cache()->rememberForever('header_options',function(){ return \Firumon\Makhzun\Model\Header::where('type','option')->where('code','<>','PRDUOM')->get()->mapWithKeys(function($item){ return [$item->d0 => \Illuminate\Support\Str::of($item->table)->title()->append('-',$item->label)->__toString()]; })->toArray(); });
        $routes = [];
        foreach ($options as $code => $name) $routes[] = ["option/" . strtolower($code),'SettingsController@option',"page.settings.option.$code",'get'];
        return $routes;
    }
