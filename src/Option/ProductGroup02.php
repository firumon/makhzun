<?php


    namespace Firumon\Makhzun\Option;


    use Firumon\Makhzun\Traits\ProductGroupOptionFetchTrait;
    use Illuminate\Support\Collection;

    class ProductGroup02 implements CustomInterface
    {
        use ProductGroupOptionFetchTrait;

        public static function collection(): Collection {
            return self::getCollection(2);
        }
    }
