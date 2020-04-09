<?php

    namespace Firumon\Makhzun\Seeder;

    use Firumon\Makhzun\Traits\SeederTrait;
    use Illuminate\Database\Seeder;

    class FormSeeder extends Seeder implements SeederInterface
    {
        use SeederTrait;

        public function fields(): array
        {
            return ['code','title','fields','layout','success','model','action','method'];
        }

        public function records(): array
        {
            return [
                ['QUICKADDPRODUCT','Quick Add A Product','PRDNAME,PRDCODE,PRDUOM,PRDCATEGORY,PRDBRAND','12,12,12,12,12','Product added successfully!','Product','page.product.index','POST'],
            ];
        }

    }
