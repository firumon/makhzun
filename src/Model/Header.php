<?php

namespace Firumon\Makhzun\Model;

use Illuminate\Support\Facades\Cache;

class Header extends Model
{
    public $headerModel = false;

    protected static function boot()
    {
        parent::boot();
        static::saved(function($model){ Cache::forget('header_file'); Cache::forget('header_options'); Cache::forget('header_table_' . $model->table); });
    }
}
