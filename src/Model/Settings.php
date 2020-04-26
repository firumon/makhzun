<?php

namespace Firumon\Makhzun\Model;

use Illuminate\Support\Facades\Cache;

class Settings extends Model
{
    public $headerModel = false;
    public $search = ['code','value','description'];
    protected static function boot()
    {
        parent::boot();
        static::saved(function($model){ Cache::forget('settings'); });
    }
}
