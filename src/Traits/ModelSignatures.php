<?php

    namespace Firumon\Makhzun\Traits;

    use Firumon\Makhzun\Model\Model;
    use Illuminate\Support\Facades\Auth;

    trait ModelSignatures
    {

        protected static function bootModelSignatures()
        {
            if(Auth::id()){
                static::creating(function(Model $Model){ $Model->setAttribute('created_by',Auth::id()); });
                static::updating(function(Model $Model){ $Model->setAttribute('updated_by',Auth::id()); });
                static::deleting(function(Model $Model){ $Model->setAttribute('deleted_by',Auth::id()); });
            }
        }
    }
