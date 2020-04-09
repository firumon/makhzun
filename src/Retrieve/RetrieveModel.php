<?php

    namespace Firumon\Makhzun\Retrieve;

    use Firumon\Makhzun\Model\Model;
    use Illuminate\Support\Str;

    class RetrieveModel implements RetrieveInterface
    {
        public function retrieve($value, $model = null, $d1 = null, $d2 = null, $d3 = null, $d4 = null)
        {
            $class = Str::of(Model::class)->beforeLast('\\')->append('\\',$model)->__toString();
            return (new $class)->find($value);
        }
    }
