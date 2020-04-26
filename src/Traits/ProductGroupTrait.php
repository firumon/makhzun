<?php

    namespace Firumon\Makhzun\Traits;

    trait ProductGroupTrait
    {
        public static function getProductFieldGroup($group){
            return config()->has('makhzun.PRODUCT_GROUP_NAME.Group' . $group)
                ? ['products',config('makhzun.PRODUCT_GROUP_NAME.Group'.$group),'PRDGRP'.$group,'ref'.$group,'custom','ProductGroup0' . $group]
                : false;
        }

        public static function getProductGroupCodes(){
            $groups = config('makhzun.PRODUCT_GROUP_NAME'); $codes = [];
            for($i = 1; $i <= count($groups); $i++) $codes[] = 'PRDGRP' . $i;
            return $codes;
        }
    }
