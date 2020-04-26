<?php

    namespace Firumon\Makhzun\Seeder;

    use Firumon\Makhzun\Traits\SeederTrait;
    use Illuminate\Database\Seeder;

    class TaxSeeder extends Seeder implements SeederInterface
    {
        use SeederTrait;

        public function fields(): array
        {
            return ['code','group','name','formula'];
        }

        public function records(): array
        {
            return [
                ['TAXPERCENT05',0,'5%','[PRDPRICE]*5/100'],
                ['TAXPERCENT10',0,'10%','[PRDPRICE]*10/100'],
                ['TAXPERCENT12',0,'12.5%','[PRDPRICE]*12.5/100'],
                ['TAXPERCENT15',0,'15%','[PRDPRICE]*15/100'],
                ['TAXPERCENT20',0,'20%','[PRDPRICE]*20/100'],
                ['TAXPERCENT25',0,'25%','[PRDPRICE]*25/100'],
                ['TAXVAT05',0,'5%','[PRDPRICE]*5/100'],
                ['TAXVAT10',0,'10%','[PRDPRICE]*10/100'],
                ['TAXVAT12',0,'12.5%','[PRDPRICE]*12.5/100'],
                ['TAXVAT15',0,'15%','[PRDPRICE]*15/100'],
                ['TAXVAT20',0,'20%','[PRDPRICE]*20/100'],
                ['TAXVAT25',0,'25%','[PRDPRICE]*25/100'],
                ['TAXCGST25',0,'CGST 2.5%','[PRDPRICE]*2.5/100'],
                ['TAXCGST06',0,'CGST 6%','[PRDPRICE]*6/100'],
                ['TAXCGST09',0,'CGST 9%','[PRDPRICE]*9/100'],
                ['TAXCGST14',0,'CGST 14%','[PRDPRICE]*14/100'],
                ['TAXSGST25',0,'SGST 2.5%','[PRDPRICE]*2.5/100'],
                ['TAXSGST06',0,'SGST 6%','[PRDPRICE]*6/100'],
                ['TAXSGST09',0,'SGST 9%','[PRDPRICE]*9/100'],
                ['TAXSGST14',0,'SGST 14%','[PRDPRICE]*14/100'],
                ['TAXCESS01',0,'CESS 1%','[PRDPRICE]*1/100'],
                ['TAXSALES',1,'Sales Tax 12%','[TAXPERCENT12]'],
                ['TAXVAT',1,'VAT 5%','[TAXVAT05]'],
                ['TAXCESS',1,'CESS 1%','[TAXCESS01]'],
                ['TAXGST05',1,'GST 5%','[TAXCGST25]+[TAXSGST25]'],
                ['TAXGST12',1,'GST 12%','[TAXCGST06]+[TAXSGST06]'],
                ['TAXGST18',1,'GST 18%','[TAXCGST09]+[TAXSGST09]'],
                ['TAXGST28',1,'GST 28%','[TAXCGST04]+[TAXSGST04]'],
            ];
        }

    }
