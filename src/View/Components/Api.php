<?php

namespace Firumon\Makhzun\View\Components;

use Illuminate\View\Component;

class Api extends Component
{
    public $code, $file, $fetch = true;

    public function __construct($code)
    {
        $api = \Firumon\Makhzun\Model\Api::where('code',$code)->first();
        if($api){
            $this->code = $api->code; $script = $api->script;
            $this->file = (stripos(".",$script) === false) ? $script . ".js" : $script;
            if(!$api->controller || !$api->method) $this->fetch = false;
        }
    }

    public function render()
    {
        return view('Makhzun::components.base.api');
    }
}
