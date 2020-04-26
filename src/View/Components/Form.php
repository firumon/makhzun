<?php

namespace Firumon\Makhzun\View\Components;

use Firumon\Makhzun\Model\Header;
use Illuminate\View\Component;

class Form extends Component
{
    public $code, $color, $action, $method, $form_fields, $fields, $layout, $title, $card, $form, $horizontal;
    private static $args = ['code','color','action','method','form_fields','fields','layout','title','form','card','form','horizontal'];

    public function __construct($code = null, $fields = null,$color = 'primary',$form = true,$card = true,$horizontal = false)
    {
        if(!$code && !$fields) return; $codeForm = null;
        if($fields){
            if(is_string($fields)) {
                $form_fields = explode(",",$fields);
                $fields = Header::whereIn('code',$form_fields)->get()->keyBy->code;
            } else $fields = collect($fields);
        } else {
            $codeForm = \Firumon\Makhzun\Model\Form::where('code',$code)->first();
            if(!$codeForm) return; $form_fields = explode(",",$codeForm->fields);
            $fields = Header::whereIn('code',$form_fields)->get()->keyBy->code;
        }
        if($fields->isEmpty()) return;
        if($codeForm){
            $layout = $codeForm->layout ? explode(",",$codeForm->layout) : array_fill(0,$fields->count(),12);
            $title = $codeForm->title; $method = $codeForm->method; $action = $codeForm->action;
        } else {
            $layout = array_fill(0,$fields->count(),12);
            $title = null; $method = null; $action = null;
        }
        foreach (self::$args as $arg) $this->$arg = $$arg;
    }

    public function render()
    {
        return view('Makhzun::components.form');
    }
}
