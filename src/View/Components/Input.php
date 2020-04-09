<?php

namespace Firumon\Makhzun\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Input extends Component
{
    public $tags = ['input','textarea','select'];
    public $textTypes = ['text','number','email','hidden','password','date','time','datetime'];

    public $inputTypes = ['checkbox','radio','file'];
    public $selectTypes = ['select','option','table','model','multiple'];
    public $textareaTypes = ['textarea'];

    public $label = null, $type = 'text', $name = '', $value = '', $horizontal = false, $options = [], $multiple = false, $fetch = [];

    public $masks = [
        'number'    => ['regex' => '\\d*[\\.]{0,1}\\d*','placeholder' => ''],
        'email'     => ['mask' => "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]", 'greedy' => false, 'definition' => ['*' => ['validator' => "[0-9A-Za-z!#$%&\'*+/=?^_`{|}~\-]", 'casing' => 'lower']]],
    ];
    public $pickers = [
        'date'          => ['singleDatePicker' => true, 'showDropdowns' => true, 'locale' => ['format' => 'YYYY-MM-DD'], 'drops' => 'up'],
        'time'          => ['singleDatePicker' => true, 'timePicker' => true, 'timePicker24Hour' => true, 'timePickerSeconds' => true, 'locale' => ['format' => 'HH:mm:ss'], 'drops' => 'up'],
        'datetime'      => ['singleDatePicker' => true, 'showDropdowns' => true, 'timePicker' => true, 'timePicker24Hour' => true, 'timePickerSeconds' => true, 'locale' => ['format' => 'YYYY-MM-DD HH:mm:ss'], 'drops' => 'up'],
    ];

    public function __construct($name, $type = 'text', $label = null, $value = null, $horizontal = null, $options = [], $optionLabel = 'name', $multiple = false, $d0 = null, $d1 = null)
    {
        $this->name = $name; $this->type = $type; $this->label = $label; $this->multiple = $multiple;
        if($this->type === 'multiple') { $this->multiple = true; $this->type = 'checkbox'; }
        if($value) $this->value = $value;
        if($horizontal) $this->horizontal = is_bool($horizontal) ? 3 : intval($horizontal);
        if(in_array($type,$this->optionTypes())){
            if(!empty($options)){
                $options = ($options instanceof Collection) ? $options : collect($options);
                if($options->isNotEmpty()) $this->setOptions($options,$optionLabel);
            } elseif ($d0) {
                $this->fetch = [$type,$d0,$d1];
            }
        }
        if(count($this->options) > 5) $this->type = 'select';
    }

    public function tag(){
        $type = $this->type;
        foreach ($this->tags as $tag) if(in_array($type,$this->{$tag.'Types'})) return $tag;
        if(in_array($type,$this->textTypes)) return 'input';
        return 'input';
    }

    public function optionTypes(){
        return array_diff(array_merge($this->selectTypes,$this->inputTypes),['file']);
    }

    public function setOptions($options,$option_label){
        $this->options = $options->pluck($option_label,'id')->toArray();
        /*$this->options = $options->mapWithKeys(function($option)use($option_label){
            return [Arr::get($option,'id') => Arr::get($option,$option_label)];
        })->toArray();*/
    }

    public function mask(){
        $items = $this->masks; $type = $this->type;
        return (array_key_exists($type,$items) && $items[$type]) ? $items[$type] : false;
    }

    public function picker(){
        $items = $this->pickers; $type = $this->type;
        return (array_key_exists($type,$items) && $items[$type]) ? $items[$type] : false;
    }

    public function render()
    {
        return view('Makhzun::components.base.input');
    }
}
