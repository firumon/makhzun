<?php

    namespace Firumon\Makhzun\Traits;

    use Firumon\Makhzun\Model\Header;
    use Firumon\Makhzun\Retrieve\RetrieveCheckbox;
    use Illuminate\Support\Arr;

    trait ModelCreate
    {

        public static function create($requests = []){
            $model = new static; $table = $model->getTable();
            if(!$model->headerModel) return static::query()->create($requests);
            $attributes = Header::select('code','field','type','d1')->where(compact('table'))
                ->get()
                ->mapWithKeys(function ($data)use($requests){
                    $value = Arr::get($requests,$data->code,null);
                    if($data->type === 'checkbox' || ($data->type === 'option' && $data->d1)) $value = RetrieveCheckbox::encodeOptions($value);
                    return [$data->field => $value];
                })
                ->toArray();
            return static::query()->create($attributes);
        }


    }
