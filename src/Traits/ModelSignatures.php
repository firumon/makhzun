<?php

    namespace Firumon\Makhzun\Traits;

    use Illuminate\Support\Facades\Auth;

    trait ModelSignatures
    {

        protected static function boot()
        {
            parent::boot();
            static::creating(function($Model){ $Model->setAttribute('created_by',Auth::id()); });
            static::updating(function($Model){ $Model->setAttribute('updated_by',Auth::id()); });
            static::deleting(function($Model){ $Model->setAttribute('deleted_by',Auth::id()); });
        }
    }
