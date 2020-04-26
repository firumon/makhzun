<?php

    namespace Firumon\Makhzun\Seeder;

    use Firumon\Makhzun\Traits\SeederTrait;
    use Illuminate\Database\Seeder;

    class SettingsSeeder extends Seeder implements SeederInterface
    {
        use SeederTrait;

        public function fields(): array
        {
            return ['code','value','label','type','description'];
        }

        public function records(): array
        {
            return [
                ['SETCURRENCY','INR','Currency','text','The currency to be used for this application'],
                ['SETTAXONCODE','PRDGRP1','Tax on Product Group','text','A tax is applied for products on the basis of category. The code using for product details table which is using as category'],
                ['SETPRDPRICE','PRDPRICE','Product Price Field','text','The price of product is to be used for calculating tax. It should be mentioned here make ease of calculation'],
                ['SETPRIWTHTAX','NO','Price Includes of Tax','yes/no','Some uses total price which will be included of tax, but for others it is mentioned separately.'],
            ];
        }

    }
