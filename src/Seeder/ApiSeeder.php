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
                ['CONTCOUNT','contacts','ContactController','getContactsCount','Get the count of active contacts'],
                ['CONTSUPPLIERS','contacts','ContactController','getSuppliersCount','Get the count of active contacts'],
                ['CONTCUSTOMERS','contacts','ContactController','getCustomersCount','Get the count of active contacts'],
                ['CONTNEWCOUNT','contacts','ContactController','getNewContactsCount','Get the count of contacts that are created recently.'],
                ['CONTRECENTSUPP','contacts','ContactController','getRecentSuppliersCount','Get the count of contacts where recent purchase done.'],
                ['CONTRECENTCUST','contacts','ContactController','getRecentCustomersCount','Get the count of contacts where recent sales done.'],
            ];
        }

    }
