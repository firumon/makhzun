<?php

    namespace Firumon\Makhzun\Seeder;


    interface SeederInterface
    {
        public function fields() : array;
        public function records() : array;
        public function common() : array;
        public function getPrepare();
        public function run();
    }
