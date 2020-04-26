<?php

    if(!function_exists('mConfig')){
        function mConfig($key){ return config("makhzun.$key"); }
    }
    if(!function_exists('MRN')){
        function MRN($name){ return \Illuminate\Support\Arr::get(mConfig("resource_name"),$name,''); }
    }

    if(!function_exists('settings')){
        function settings($name){
            $settings = cache()->rememberForever('settings',function(){ return \Firumon\Makhzun\Model\Settings::pluck('value','code')->toArray(); });
            return \Illuminate\Support\Arr::get($settings,$name);
        }
    }

