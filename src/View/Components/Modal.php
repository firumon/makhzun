<?php

namespace Firumon\Makhzun\View\Components;

use Firumon\Makhzun\Traits\ComponentBgsTrait;
use Illuminate\View\Component;

class Modal extends Component
{
    use ComponentBgsTrait;

    public $title, $close, $id, $actions = [], $centered = false, $scrollable = false;
    private static $args = ['title','close','id','actions','centered','scrollable'];

    public function __construct($title = '', $close = true, $actions = [], $id = null, $centered = false, $scrollable = false)
    {
        if(!empty($actions)){ if(empty($actions[0])) $actions = [$actions]; }
        if(!$id) $id = 'modal-' . time();
        foreach (self::$args as $arg) $this->$arg = $$arg;
    }

    public function render()
    {
        return view('Makhzun::components.modal');
    }
}
