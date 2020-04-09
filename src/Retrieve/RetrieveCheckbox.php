<?php

    namespace Firumon\Makhzun\Retrieve;

    use Firumon\Makhzun\Model\Option;
    use Illuminate\Support\Arr;

    class RetrieveCheckbox implements RetrieveInterface
    {
        private static $wrapBegin = '[', $wrapEnd = ']', $delimiter = '|';

        public function retrieve($value, $d0 = null, $d1 = null, $d2 = null, $d3 = null, $d4 = null)
        {
            $IDs = self::decodeOption($value);
            return Option::find($IDs)->pluck('option')->toArray();
        }

        public static function encodeOptions(array $value){
            return self::$wrapBegin . implode(self::$delimiter,$value) . self::$wrapEnd;
        }

        public static function decodeOption($value){
            $value = $value ?: self::$wrapBegin . self::$wrapEnd;
            return (
                substr($value,0,1) === self::$wrapBegin
                && substr($value,-1) === self::$wrapEnd
            )
                ? explode(self::$delimiter,substr($value,1,-1))
                : (array) $value;
        }
    }
