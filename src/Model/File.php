<?php

namespace Firumon\Makhzun\Model;

use Illuminate\Support\Facades\Storage;

class File extends Model
{
    public $headerModel = false;

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($model){
            Storage::disk($model->disk)->delete($model->file);
        });
    }
}
