<?php

    namespace Firumon\Makhzun\Retrieve;

    use Firumon\Makhzun\Model\File;

    class RetrieveFile implements RetrieveInterface
    {
        public function retrieve($value, $d0 = null, $d1 = null, $d2 = null, $d3 = null, $d4 = null)
        {
            $object = File::find($value);
            $field = $value;
            $value = $object ? $object->name_client : null;
            return compact('value','object','field');
        }

    }
