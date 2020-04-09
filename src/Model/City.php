<?php

namespace Firumon\Makhzun\Model;

class City extends Model
{
    public $headerModel = false;
    protected $with = ['State','Country'];

    public function State(){ return $this->belongsTo(State::class,'state','id'); }
    public function Country(){ return $this->belongsTo(Country::class,'country','id'); }
}
