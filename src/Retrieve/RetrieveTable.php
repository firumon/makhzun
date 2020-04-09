<?php

    namespace Firumon\Makhzun\Retrieve;

    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Str;

    class RetrieveTable implements RetrieveInterface
    {
        public function retrieve($value, $table = null, $d1 = null, $d2 = null, $d3 = null, $d4 = null)
        {
            $model = Str::of($table)->singular()->studly()->__toString();
            return (new RetrieveModel)->retrieve($value,$model);
        }
    }
