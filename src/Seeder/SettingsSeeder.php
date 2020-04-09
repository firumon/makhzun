<?php

    namespace Firumon\Makhzun\Seeder;

    use Firumon\Makhzun\Traits\SeederTrait;
    use Illuminate\Database\Seeder;

    class SettingsSeeder extends Seeder implements SeederInterface
    {
        use SeederTrait;

        public function fields(): array
        {
            return ['code','value','description'];
        }

        public function records(): array
        {
            return [
                ['SETCURRENCY','INR',''],
                ['SETTAXONCODE','PRDCATEGORY','A tax is applied for products on the basis of category. The code using for product details table which is using as category'],
                ['SETPRDPRICE1','PRDPRICE01','The price of product is to be used for calculating tax. It should be mentioned here make ease of calculation'],
                ['SETPRDPRICE2','PRDPRICE02','The price of product is to be used for calculating tax. It should be mentioned here make ease of calculation'],
                ['SETPRIWTHTAX','NO','Some uses total price which will be included of tax, but for others it is mentioned separately.'],
            ];
        }

    }
