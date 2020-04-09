<?php

namespace Firumon\Makhzun\View\Components;

use Firumon\Makhzun\Model\Header;
use Illuminate\View\Component;

class Form extends Component
{
    public $color,$action,$method,$form_fields,$fields,$layout,$title,$id;
    private static $args = ['color','action','method','form_fields','fields','layout','title','id'];

    public function __construct($code,$id = null,$color = 'primary')
    {
        $form = \Firumon\Makhzun\Model\Form::where('code',$code)->first();
        if(!$form) return; $form_fields = explode(",",$form->fields);
        $fields = Header::whereIn('code',$form_fields)->get()->keyBy->code;
        if($fields->isEmpty()) return;
        $layout = $form->layout ? explode(",",$form->layout) : array_fill(0,$fields->count(),12);
        $title = $form->title; $method = $form->method; $action = $form->action;
        foreach (self::$args as $arg) $this->$arg = $$arg;
    }

    public function render()
    {
        return view('Makhzun::components.form');
    }
}
