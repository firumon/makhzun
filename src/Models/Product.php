<?php

namespace Firumon\Makhzun\Models;

class Product extends Model
{

    public $defineRelations = ['Contacts' => ['hasMany',Contact::class]];

    public function Contacts(){
        return $this->hasMany(Contact::class,'belongs');
    }
}
