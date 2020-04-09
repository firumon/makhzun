<?php

namespace Firumon\Makhzun\View\Components;

use Firumon\Makhzun\Traits\ComponentBgsTrait;
use Illuminate\View\Component;

class Box extends Component
{
    use ComponentBgsTrait;

    public $text, $number, $icon, $link, $progress, $detail, $bg;

    public function __construct($text = '', $number = 0, $icon =  'award', $link = null, $progress = null, $detail = ' ')
    {
        $args = ['text','number','icon','link','progress','detail'];
        foreach ($args as $arg) $this->$arg = $$arg;
    }

    public function render()
    {
        return view('Makhzun::components.base.box');
    }
}
