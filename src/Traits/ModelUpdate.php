<?php

    namespace Firumon\Makhzun\Traits;

    use Illuminate\Database\Eloquent\Model;

    trait ModelUpdate
    {

        protected static function bootModelUpdate(){
            static::updating(function (Model $model){
                if($model->headerModel){
                    foreach (array_diff(array_keys($model->toArray()),array_keys($model->getOriginal())) as $attribute) $model->offsetUnset($attribute);
                }
            });
        }

        public function update(array $attributes = [], array $options = [])
        {
            if($this->headerModel) $attributes = $this->requestToAttributes(true);
            return parent::update($attributes, $options);
        }



    }
