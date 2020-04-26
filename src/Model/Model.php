<?php

namespace Firumon\Makhzun\Model;

use Firumon\Makhzun\Retrieve\RetrieveCheckbox;
use Firumon\Makhzun\Scope\SearchScope;
use Firumon\Makhzun\Traits\ModelCreate;
use Firumon\Makhzun\Traits\ModelRetrieve;
use Firumon\Makhzun\Traits\ModelUpdate;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Firumon\Makhzun\Traits\ModelSignatures;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class Model extends BaseModel
{
    use SoftDeletes;
    use ModelSignatures;
    use ModelCreate;
    use ModelUpdate;
    use ModelRetrieve;

    protected $guarded = [];
    public $headerModel = true;

//    protected $appends = ['header'];

    public function getHeaderAttribute(){
        if(!$this->headerModel) return []; $table = $this->getTable();
        return Cache::rememberForever('header_table_' . $table,function () use($table){
            return Header::where('table',$table)->get()->keyBy->code;
        });
    }

    protected static function booted()
    {
        parent::booted();
        if(request('search_text') && request()->filled('search_text')){ static::addGlobalScope(new SearchScope); }
    }

    public function requestToAttributes($filter = false)
    {
        $request = request()->all();
        $headers = $filter ? $this->getHeaderAttribute()->filter((function($item,$code){ return request()->hasAny([$code,$code . '_ID',$code . '_OLD']); })) : $this->getHeaderAttribute();
        return $headers
            ->mapWithKeys(function($item,$code) use ($request){
                $value = Arr::get($request,$code,null);
                if($item->type === 'checkbox' || ($item->type === 'option' && $item->d1)) $value = RetrieveCheckbox::encodeOptions($value);
                else if($item->type === 'file') {
                    $value = Arr::get($request,$code . '_ID',null);
                    if($value === null && isset($request[$code . '_OLD'])) File::destroy($request[$code . '_OLD']);
                }
                return [$item->field => $value];
            })
            ->toArray()
        ;
    }

}

