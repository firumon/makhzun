<?php

    namespace Firumon\Makhzun\Seeder;

    use Firumon\Makhzun\Traits\SeederTrait;
    use Illuminate\Database\Seeder;

    class GroupSeeder extends Seeder implements SeederInterface
    {
        use SeederTrait;

        public function fields(): array
        {
            return ['id','name','order'];
        }

        public function records(): array
        {
            $groups = mConfig('PRODUCT_GROUP_NAME'); if(empty($groups)) return [];
            $records = [];
            foreach ($groups as $group => $name){
                $no = substr($group,-1);
                $records[] = ['GRPPRDGROUP' . $no,$name,$no];
            }
            return $records;
        }

    }
