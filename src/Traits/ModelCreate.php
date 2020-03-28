<?php

    namespace Firumon\Makhzun\Traits;

    use Firumon\Makhzun\Models\Header;
    use Illuminate\Support\Arr;

    trait ModelCreate
    {

        protected $useModelCreate = true;

        public static function create($requests = []){
            $model = new static; $table = $model->getTable();
            if(!$model->useModelCreate) return static::query()->create($requests);
            $attributes = Header::where(compact('table'))
                ->get()
                ->mapWithKeys(function ($data)use($requests){ return [$data->field => Arr::get($requests,$data->code,null)]; })
                ->toArray();
            return static::query()->create($attributes);
        }


    }
