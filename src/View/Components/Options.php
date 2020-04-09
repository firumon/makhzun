<?php

namespace Firumon\Makhzun\View\Components;

use Illuminate\View\Component;

class Options extends Component
{

    public $name, $type, $d0, $d1, $value;
    private static $args = ['name','type','d0','d1','value'];

    public function __construct($name = '',$type = 'model',$d0 = 'Product',$d1 = 'name',$value = null)
    {
        foreach (self::$args as $arg) $this->$arg = $$arg;
    }

    public function render()
    {
        return view('Makhzun::components.base.options');
    }
}
