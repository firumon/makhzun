<?php


    namespace Firumon\Makhzun;


    class Table
    {
        public function __construct()
        {
        }

        public static $tables = [
            'test_migration' => ['detail','normal','users',true],
            'products' => ['master','detail'],
            'companies' => ['master','normal'],
            'contacts' => ['detail','master','companies',true],
            'purchase_orders' => ['master','normal'],
            'purchase_order_details' => ['detail','number','purchase_orders'],
            'supplier_sales_orders' => ['master','normal'],
            'supplier_sales_order_details' => ['detail','number','supplier_sales_orders'],
            'purchases' => ['master','master'],
            'purchase_details' => ['detail','number','purchases'],
            'vouchers' => ['master','min'],
            'payments' => ['master','min'],
            'customer_purchase_orders' => ['master','normal'],
            'customer_purchase_order_details' => ['detail','min','customer_purchase_orders'],
            'sales_orders' => ['master','normal'],
            'sales_order_details' => ['detail','number','sales_orders'],
            'sales' => ['master','normal'],
            'sales_details' => ['detail','number','sales'],
            'invoices' => ['master','min'],
            'receipts' => ['master','min'],
        ];
        public static $main_tables = [
            'settings','codes','headers','options','files','apis','forms','validations'
        ];

        public static $detail_names = [
            'type','args','index','min','normal','more','number','detail','master'
        ];

        public static $details_structure = [
            'index' => ['string',64,true,2,3,5,2,3,3],
            'string' => ['string',256,false,2,5,9,3,9,5],
            'number' => ['decimal','30,10',false,2,7,9,9,3,7],
            'datetime' => ['datetime',null,false,1,2,4,1,2,1],
            'date' => ['date',null,false,1,2,4,2,2,2],
            'time' => ['time',null,false,1,2,4,1,1,1],
            'option' => ['bigInteger',false,false,3,4,6,2,5,3],
            'text' => ['string',2048,false,2,3,5,1,3,3],
            'file' => ['foreignField','files,set null',false,1,3,5,0,3,1],
        ];

        public static $header_types = [
            'text','number','datetime','date','time','option','textarea','file','checkbox','radio','table','model'
        ];

        public static function details_fields($extras = null){
            $pos = array_search($extras,self::$detail_names); $fields = [];
            foreach (self::$details_structure as $field => $data)
                for($i = 0; $i < ($pos !== false ? $data[$pos] : max(array_slice($data,3))); $i++)
                    $fields[] = $field.$i;
            return $fields;
        }

        public static function tables(){
            return array_keys(self::$tables);
        }

        public static function fields(){
            return array_merge(['name','code','belongs'],self::details_fields());
        }

    }
