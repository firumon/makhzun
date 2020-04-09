<?php

    namespace Firumon\Makhzun;

    use Illuminate\Support\Str;

    class Seeder
    {

        public static function seed($table){
            $seeder = Str::of($table)->singular()->studly()->append('Seeder')->prepend(__NAMESPACE__ . '\\Seeder\\')->__toString();
            (new $seeder)->run();
        }

    }
