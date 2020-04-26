<?php

    namespace Firumon\Makhzun\Retrieve;

    use Firumon\Makhzun\Model\Option;

    class RetrieveOption implements RetrieveInterface
    {

        public function retrieve($value, $d0 = null, $d1 = null, $d2 = null, $d3 = null, $d4 = null)
        {
            $object = null; $field = $value;
            if($value){
                $value = RetrieveCheckbox::decodeOption($value);
                $object = Option::find($value);
                $value = $object ? $object->pluck('option')->implode(',') : null;
            }
            return compact('value','object','field');
        }

    }
