<?php


    namespace Firumon\Makhzun\Option;


    use Firumon\Makhzun\Traits\ProductGroupOptionFetchTrait;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Collection;

    class ProductGroup01 implements CustomInterface
    {
        use ProductGroupOptionFetchTrait;

        public static function collection(): Collection {
            return self::getCollection(1);
        }

    }
