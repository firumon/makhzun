<?php

namespace Firumon\Makhzun\Controller;

use App\Http\Controllers\Controller as BaseController;
use Firumon\Makhzun\Model\Header;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Controller extends BaseController
{

    public static function codeToField($request){
        return Header::whereIn('code',array_keys($request))->get()
            ->mapWithKeys(function($item)use($request){
                return [$item->field => $request[$item->code]];
            })
            ->toArray();
    }

    public static function requestToDB($model,$fields = []){
        $record_id = request('_record_id',null);
        $fields = empty($fields) ? request()->all() : $fields; $type = 'create';
        $model = (stripos($model,"\\") !== false) ? $model : Str::of(__NAMESPACE__)->replace('Controller','Model')->append("\\",$model)->__toString();
        if($record_id){
            $type = 'update';
            $Model = new $model;
            $key = $Model->getKeyName();
            $sModel = $model::where($key,$record_id)
                ->update(
                    ($Model->useModelCreate)
                        ? self::codeToField($fields)
                        : $fields
                );
        }
        else $sModel = $model::create($fields);
        return ['type' => $type,'model' => $sModel, 'status' => !!$sModel];
    }


}
