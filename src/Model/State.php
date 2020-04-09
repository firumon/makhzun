<?php

namespace Firumon\Makhzun\Model;

class State extends Model
{
    public $headerModel = false;
    public function Country(){ return $this->belongsTo(Country::class,'country','id'); }
}
