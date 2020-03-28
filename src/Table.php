<?php


    namespace Firumon\Makhzun;


    class Table
    {
        public function __construct()
        {
        }

        public static $tables = [
            'test_migration' => ['detail','normal','users',true],
            'products' => ['master','normal'],
            'companies' => ['master','min'],
            'contacts' => ['detail','min','companies',true],
            'purchase_orders' => ['master','min'],
            'purchase_order_details' => ['detail','normal','purchase_orders'],
            'supplier_sales_orders' => ['master','normal'],
            'supplier_sales_order_details' => ['detail','normal','supplier_sales_orders'],
            'purchases' => ['master','min'],
            'purchase_details' => ['detail','normal','purchases'],
            'vouchers' => ['master','normal'],
            'payments' => ['master','normal'],
            'customer_purchase_orders' => ['master','normal'],
            'customer_purchase_order_details' => ['detail','min','customer_purchase_orders'],
            'sales_orders' => ['master','normal'],
            'sales_order_details' => ['detail','normal','sales_orders'],
            'sales' => ['master','normal'],
            'sales_details' => ['detail','normal','sales'],
            'invoices' => ['master','normal'],
            'receipts' => ['master','normal'],
        ];
        public static $main_tables = [
            'codes','headers','options','files'
        ];

        public static $details_structure = [
            'index' => [2,5,'string',64,true],
            'string' => [2,7,'string',256,false],
            'number' => [1,5,'decimal','30,10',false],
            'datetime' => [1,3,'datetime',null,false],
            'date' => [1,3,'date',null],
            'time' => [1,3,'time',null],
            'option' => [3,9,'bigInteger',false],
            'text' => [2,5,'string',2048],
            'file' => [1,5,'foreignField','files,set null'],
        ];

        public static $header_types = [
            'text','number','datetime','date','time','option','textarea','file','checkbox','radio','table'
        ];

        public static function details_fields($extras = 'normal'){
            $pos = array_search($extras,['min','normal']); $fields = [];
            foreach (self::$details_structure as $field => $data)
                for($i = 0; $i < $data[$pos]; $i++)
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
