<?php

    namespace Firumon\Makhzun\Seeder;

    use Firumon\Makhzun\Traits\SeederTrait;
    use Illuminate\Database\Seeder;

    class ApiSeeder extends Seeder implements SeederInterface
    {
        use SeederTrait;

        public function fields(): array
        {
            return ['code','script','controller','method','details'];
        }

        public function records(): array
        {
            return [
                ['PRDCOUNT','products','ProductController','getProductsCount','Get the count of products which are active'],
                ['PRDSTOCKVALUE','products','ProductController','getProductsStockValue','Get the total value of products which are in stock'],
                ['PRDNONSTOCKCOUNT','products','ProductController','getNonStockProductsCount','Get the count of products which have no or negative stocks'],
                ['CATEGORYMANAGE','category','','','Manage category details'],
                ['BRANDMANAGE','brand','','','Manage brand details'],
            ];
        }

    }
