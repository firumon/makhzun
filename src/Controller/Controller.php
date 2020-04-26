<?php

namespace Firumon\Makhzun\Controller;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{

    public static function ProcessForm($class,$attributes = []){
        if(request()->getMethod() !== 'POST') return true;
        $method = (request()->has('_record_id') && request()->_record_id) ? 'update' : 'create';
        $attributes = empty($attributes) ? request()->all() : $attributes;
        $status = ($method === 'update') ? $class::find(request()->_record_id)->$method($attributes) : $class::$method($attributes);
        return ['status' => !!$status, 'result' => $status, 'type' => $method];
    }

    public static function FlashToastr($status,$item,$with = []){
        if(is_bool($status)) return;
        $toastr = ($status['status']) ? 'success' : 'error';
        $message = $status['type'] === 'update'
            ? ($status['status'] ? Str::ucfirst($item) . ' Updated Successfully!!' : 'Error in updating ' . Str::lower($item) . ' details. Please try again.!')
            : ($status['status'] ? Str::ucfirst($item) . ' Created Successfully!!' : 'Error in creating new ' . Str::lower($item) . '. Please try again.!');;
        request()->session()->flash('toastr', [$toastr => $message]);
        return redirect()->back()->with($with);
    }

}
