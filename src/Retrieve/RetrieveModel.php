<?php

    namespace Firumon\Makhzun\Retrieve;

    use Firumon\Makhzun\Model\Model;
    use Illuminate\Support\Str;

    class RetrieveModel implements RetrieveInterface
    {
        public function retrieve($value, $model = null, $d1 = 'name', $d2 = null, $d3 = null, $d4 = null)
        {
            $class = Str::of(Model::class)->beforeLast('\\')->append('\\',$model)->__toString();
            $object = (new $class)->find($value);
            $field = $value;
            $value = $object ? $object->$d1 : null;
            return compact('value','object','field');
        }
    }
