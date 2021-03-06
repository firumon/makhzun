<?php

    namespace Firumon\Makhzun\Retrieve;

    class RetrieveState implements RetrieveInterface
    {
        public function retrieve($value, $table = null, $d1 = 'name', $d2 = null, $d3 = null, $d4 = null)
        {
            return (new RetrieveTable)->retrieve($value,'states','name');
        }
    }
