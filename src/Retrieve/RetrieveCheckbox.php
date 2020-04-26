<?php

    namespace Firumon\Makhzun\Retrieve;

    use Firumon\Makhzun\Model\Option;
    use Illuminate\Support\Arr;

    class RetrieveCheckbox implements RetrieveInterface
    {
        private static $wrapBegin = '[', $wrapEnd = ']', $delimiter = ',';

        public function retrieve($value, $d0 = null, $d1 = null, $d2 = null, $d3 = null, $d4 = null)
        {
            $IDs = self::decodeOption($value);
            $object = Option::find($IDs);
            $field = $value;
            $value = $object ? $object->pluck('option')->implode(',') : null;
            return compact('value','object','field');
        }

        public static function encodeOptions($value){
            return self::$wrapBegin . implode(self::$delimiter,(array) $value) . self::$wrapEnd;
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
