<?php

namespace Firumon\Makhzun\Model;

class Group extends Model
{
    public $headerModel = false;
    protected static function boot()
    {
        parent::boot();
        static::created(function($model){
            $idParent = Group::pluck('parent','id')->toArray(); $parent = $model->parent; $id = null;//$model->id;
            while($parent) {
                $id = $parent; $parent = $idParent[$id];
            }
            $model->grand = $id; $model->save();
        });
    }
}
