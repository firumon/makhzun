<?php

    namespace Firumon\Makhzun\Seeder;

    use Firumon\Makhzun\Traits\SeederTrait;
    use Illuminate\Database\Seeder;

    class OptionSeeder extends Seeder implements SeederInterface
    {
        use SeederTrait;

        public function fields(): array
        {
            return ['code','option','order'];
        }

        public function records(): array
        {
            return [
                ['OPTPRDUOM','Piece',1],
                ['OPTPRDUOM','Box',2],
                ['OPTCONTTYPE','Company',1],
                ['OPTCONTTYPE','Person',2],
                ['OPTCONTNAT',config('makhzun.resource_name.customer'),1],
                ['OPTCONTNAT',config('makhzun.resource_name.supplier'),2],
                ['OPTCONTNAT','Both',3],
                ['OPTVCHRTYPE','Purchase',1],
                ['OPTVCHRTYPE','Others',2],
                ['OPTVCHRPAYST','Pending',1],
                ['OPTVCHRPAYST','Partial',2],
                ['OPTVCHRPAYST','Completed',3],
                ['OPTPYMTMODE','Cash',1],
                ['OPTPYMTMODE','Cheque',2],
                ['OPTPYMTMODE','Cyber',3],
                ['OPTPYMTMODE','Others',4],
                ['OPTINVTYPE','Sales',1],
                ['OPTINVTYPE','Others',2],
                ['OPTINVPAYST','Pending',1],
                ['OPTINVPAYST','Partial',2],
                ['OPTINVPAYST','Completed',3],
            ];
        }

    }
