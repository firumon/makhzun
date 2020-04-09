<?php

    namespace Firumon\Makhzun\Retrieve;

    use Firumon\Makhzun\Model\Option;

    class RetrieveOption implements RetrieveInterface
    {

        public function retrieve($value, $d0 = null, $d1 = null, $d2 = null, $d3 = null, $d4 = null)
        {
            if($value){
                $value1 = RetrieveCheckbox::decodeOption($value);
                $options = Option::find($value1)->pluck('option')->toArray();
            } else $options = [''];
//            if(!isset($options[0])) dd($value,$value1,$options,$d1);
            return ($d1) ? $options : $options[0] ?? '';
        }

    }
