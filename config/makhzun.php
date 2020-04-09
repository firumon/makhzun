<?php
/*
 * Changes to made in adminlte config file
 * Delete all items in menu
 * delete all items in plugins
 *
*/

    return [

        'FORM_STATUS_OPTIONS' => [['id' => 'Active', 'name' => 'Active'],['id' => 'Inactive', 'name' => 'Inactive']],

        'page_routes' => [
            'product' => [
//                ['uri','action','name','get/post/any','topnav_name','topnav_icon','search'],
                ['/','ProductController@index','page.product.index','any','Products','arrow-left',true],
                ['create','ProductController@create','page.product.create','get','New Product','box-open'],
                ['category','ProductController@category','page.product.category','any','Categories','archive',true],
                ['brand','ProductController@brand','page.product.brand','any','Brands','barcode',true],
                ['{id}/details','ProductController@details','page.product.details'],
            ]
        ],

    ];
