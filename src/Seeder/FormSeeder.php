<?php

    namespace Firumon\Makhzun\Seeder;

    use Firumon\Makhzun\Model\Header;
    use Firumon\Makhzun\Traits\ProductGroupTrait;
    use Firumon\Makhzun\Traits\SeederTrait;
    use Illuminate\Database\Seeder;

    class FormSeeder extends Seeder implements SeederInterface
    {
        use SeederTrait;
        use ProductGroupTrait;

        public function fields(): array
        {
            return ['code','title','fields','layout','success','model','action','method'];
        }

        public function records(): array
        {
            return [
                ['QUICKADDPRODUCT','Quick add Product','PRDNAME,PRDCODE,PRDUOM','12,12,12','Product added successfully!','Product','page.product.create','POST'],
                ['ADDNEWPRODUCT','Add new Product',self::allFields('products'),'','Product added successfully!','Product','page.product.create','POST'],
                ['UPDATEPRODUCT','Update Product',self::allFields('products'),'','Product updated successfully!','Product','page.product.create','POST'],
                ['ADDNEWCONTACT','New ' . MRN('contact'),self::allFields('contacts'),'',MRN('contact') . ' added successfully!','Contact','page.contact.form','POST'],
                ['QUICKADDCONTACT','Quick create a ' . MRN('contact'),'CONTNAME,CONTNATURE,CONTPHONE,CONTADDR','',MRN('contact') . ' added successfully!','Contact','page.contact.form','POST'],
            ];
        }

        public static function allFields($table){
            return Header::where('table',$table)->get()->map->code->implode(',');
        }

    }
