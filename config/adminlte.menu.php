<?php

    return [
        [
            'key'       =>  'page.product.dashboard',
            'text'      =>  'Products',
            'route'     =>  'page.product.dashboard',
            'icon'      =>  'fas fa-cart-plus mr-2',
            'active'    =>  ['makhzun/page/product*'],
            'submenu'   =>  array_merge(
                                [
                                    [
                                        'key'       =>  'page.product.dashboard',
                                        'text'      =>  'Dashboard',
                                        'route'     =>  'page.product.dashboard',
                                        'icon'      =>  'mr-2 fas fa-bezier-curve',
                                    ],
                                ],
                                productGroupsSubMenu(),
                                [
                                    [
                                        'key'       =>  'page.product.uom',
                                        'text'      =>  'UOM',
                                        'route'     =>  'page.product.uom',
                                        'icon'      =>  'mr-2 fas fa-balance-scale',
                                    ],
                                    [
                                        'key'       =>  'page.product.tax',
                                        'text'      =>  'TAX',
                                        'route'     =>  'page.product.tax',
                                        'icon'      =>  'mr-2 fas fa-money-bill-wave',
                                    ],
                                ]
                            ),
        ], [
            'key'       =>  'page.contact.index',
            'text'      =>  'Contacts',
            'route'     =>  'page.contact.index',
            'icon'      =>  'fas mr-2 fa-people-carry',
            //'active'    =>  ['makhzun/page/contact*'],
        ], [
            'header'    =>  'INVENTORY',
        ], [
            'key'       =>  'page.settings.option',
            'text'      =>  'Options',
            'url'       =>  '',
            'icon'      =>  'fas fa-code mr-2',
            'active'    =>  ['makhzun/page/settings/option/*'],
            'submenu'   =>  getSettingsOptionsSubMenu()
        ], [
            'header'    =>  'SETTINGS',
        ], [
            'key'       =>  'page.settings.option',
            'text'      =>  'Options',
            'url'       =>  '',
            'icon'      =>  'fas fa-code mr-2',
            'active'    =>  ['makhzun/page/settings/option/*'],
            'submenu'   =>  getSettingsOptionsSubMenu()
        ], [
            'key'       =>  'page.settings.global',
            'text'      =>  'Global',
            'route'     =>  'page.settings.global',
            'icon'      =>  'fas fa-cog mr-2',
            'active'    =>  ['makhzun/page/settings/global']
        ], [
            'key'       =>  'page.settings.tax',
            'text'      =>  'Tax',
            'route'     =>  'page.settings.tax',
            'icon'      =>  'fas fa-comments-dollar mr-2',
            'active'    =>  ['makhzun/page/settings/tax']
        ], [
            'key'       =>  'page.settings.country',
            'text'      =>  'Country',
            'route'     =>  'page.settings.country',
            'icon'      =>  'mr-2 fas fa-flag',
            'active'    =>  ['makhzun/page/settings/country']
        ]
    ];



    function productGroupsSubMenu(){
        $groups = config('makhzun.PRODUCT_GROUP_NAME'); if(empty($groups)) return [];
        $submenu = []; $icons = ['','box-open','boxes','box-tissue','box','calendar'];
        foreach ($groups as $group => $name) {
            $no = substr($group,-1); $pre = 'page.product.group'; $key = $pre . $no; $icon = $icons[$no];
            array_push($submenu,['key' => $key, 'text' => $name, 'route' => $key, 'icon' => 'fas mr-2 fa-' . $icon]);
        }
        return $submenu;
    }

    function getSettingsOptionsSubMenu(){
        $submenu = [];
        $options = cache()->rememberForever('header_options',function(){ return \Firumon\Makhzun\Model\Header::where('type','option')->where('code','<>','PRDUOM')->get()->mapWithKeys(function($item){ return [$item->d0 => ['table' => $item->table, 'label' => $item->label]]; })->toArray(); });
        foreach ($options as $code => $ary){
            $key = 'page.settings.option.' . $code; $text = $ary['label'] . " (".ucfirst($ary['table']).")";
            array_push($submenu,['key' => $key, 'text' => $text, 'route' => $key, 'icon' => 'fas mr-2 fa-coins']);
        }
        return $submenu;
    }
