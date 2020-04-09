<?php

namespace Firumon\Makhzun\Model;

use Firumon\Makhzun\Scope\SearchScope;
use Firumon\Makhzun\Traits\ModelCreate;
use Firumon\Makhzun\Traits\ModelRetrieve;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Firumon\Makhzun\Traits\ModelSignatures;
use Illuminate\Support\Facades\Cache;

class Model extends BaseModel
{
    use SoftDeletes;
    use ModelSignatures;
    use ModelCreate;
    use ModelRetrieve;

    protected $guarded = [];
    public $headerModel = true;

    protected $appends = ['header'];

    public function getHeaderAttribute(){
        if(!$this->headerModel) return []; $table = $this->getTable();
        return Cache::rememberForever('header_table_' . $table,function () use($table){
            return Header::where('table',$table)->get()->keyBy->code;
        });
    }

    protected static function booted()
    {
        parent::booted();
        if(request('search_text')){ static::addGlobalScope(new SearchScope); }
    }

}

