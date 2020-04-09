<?php

namespace Firumon\Makhzun\Controller;

use Firumon\Makhzun\Model\Api;
use Illuminate\Support\Str;

class APIController extends Controller
{
    public function fetch($code){
        $api = Api::where('code',$code)->first();
        if($api){
            if(!$api->controller || !$api->method) return true;
            $class = __NAMESPACE__ . '\\' . $api->controller;
            $method = $api->method;
            return call_user_func([new $class,$method]);
        }
        return false;
    }

    public function modelFetch($model,$id){
        $class = Str::of(__CLASS__)->replace('APIController',$model)->replace('Controller','Model')->__toString();
        return $class::find($id);
    }

    public function optionsFetch($type,$name,$label = 'name'){
        $method = 'get' . ucfirst($type);
        $options = call_user_func_array([new OptionsController,$method],[$name,$label]);
        return array_merge(compact('options','type','name','label'),['count' => count($options), 'status' => !!$options]);
    }
}
