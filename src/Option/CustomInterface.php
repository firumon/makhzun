<?php


    namespace Firumon\Makhzun\Option;


    use Illuminate\Support\Collection;

    interface CustomInterface
    {

        /*
         * The field from the collection to be fetched and use as value in html
         * */
        public static function key():string ;
        /*
         * The field from the collection to be fetched while preparing options, this will be used as option text
         * */
        public static function label():string ;
        /*
         * The collection prepared from model after applying required conditions
         * */
        public static function collection(): Collection ;
        /*
         * The method to retrieve model from value
         * */
        public static function retrieve($value);
    }
