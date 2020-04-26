<?php

    namespace Firumon\Makhzun\Retrieve;

    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Str;

    class RetrieveTable implements RetrieveInterface
    {
        public function retrieve($value, $table = null, $d1 = 'name', $d2 = null, $d3 = null, $d4 = null)
        {
            $object = DB::table($table)->find($value);
            $field = $value;
            $value = $object ? $object->$d1 : null;
            return compact('value','object','field');
        }
    }
