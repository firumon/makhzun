<?php

    namespace Firumon\Makhzun\Traits;

    use Firumon\Makhzun\Model\Header;
    use Firumon\Makhzun\Retrieve\RetrieveCheckbox;
    use Illuminate\Support\Arr;

    trait ModelCreate
    {

        public static function create($attributes = []){
            $model = new static;
            if(!$model->headerModel) return static::query()->create($attributes);
            $attributes = $model->requestToAttributes();
            return static::query()->create($attributes);
        }


    }
