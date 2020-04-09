<?php

namespace Firumon\Makhzun\View\Components;

use Firumon\Makhzun\Traits\ComponentBgsTrait;
use Illuminate\View\Component;

class Modal extends Component
{
    use ComponentBgsTrait;

    public $title, $close, $actions = [], $centered = false, $id;
    private static $args = ['title','close','id','actions','centered'];

    public function __construct($title = '', $close = true, $actions = [], $id = null, $centered = false)
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
