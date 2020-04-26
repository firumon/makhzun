<?php

    namespace Firumon\Makhzun\Retrieve;

    use Firumon\Makhzun\Model\Model;
    use Firumon\Makhzun\Option\Custom;
    use Illuminate\Support\Str;

    class RetrieveCustom implements RetrieveInterface
    {
        public function retrieve($value, $name = null, $d1 = 'name', $d2 = null, $d3 = null, $d4 = null)
        {
            $object = Custom::retrieve($name,$value);
            $field = $value;
            $value = $object ? $object->{Custom::label($name)} : null;
            return compact('value','object','field');
        }
    }
