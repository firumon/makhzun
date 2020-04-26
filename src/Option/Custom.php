<?php

    namespace Firumon\Makhzun\Option;

    use Illuminate\Support\Str;

    class Custom
    {
        public $class;

        public function __construct($name)
        {
            $class = Str::of(__CLASS__)->replaceLast('Custom',$name)->__toString();
            $this->class = new $class;
        }

        public function get(){ return $this->class::collection()->pluck($this->class::label(),$this->class::key()); }
        public function getData($value){ return $this->class::retrieve($value); }
        public function getLabel(){ return $this->class::label(); }

        public static function fetch($name){ return (new static($name))->get(); }
        public static function retrieve($name,$value){ return (new static($name))->getData($value); }
        public static function label($name){ return (new static($name))->getLabel(); }
    }
