<?php

    namespace Firumon\Makhzun\Retrieve;

    class Retrieve
    {
        public $data;

        public function __construct($item,$attrs)
        {
            $class = __NAMESPACE__ . '\\Retrieve' . ucfirst($item);
            $method = 'retrieve';
            $this->data = call_user_func_array([new $class,$method],$attrs);
        }

        public static function retrieve($item,...$attrs){
            return (new self($item,$attrs))->data;
        }
    }
