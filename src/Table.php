<?php


    namespace Firumon\Makhzun;


    class Table
    {
        public function __construct()
        {
        }

        public static $tables = [
            'test_migration' => ['master',['name' => 6, 'index' => 6, 'text' => 6, 'string' => 6, 'option' => 7, 'number' => 8, 'file' => 7]],
            'products' => ['master',['index' => 5, 'text' => 5, 'string' => 5, 'option' => 5, 'ref' => 10, 'number' => 5, 'file' => 5]],
            'contacts' => ['master',['index' => 5, 'string' => 10, 'text' => 5, 'option' => 5, 'ref' => 5, 'file' => 3, 'number' => 3, 'datetime' => 2]],
            'purchase_orders' => ['master',['index' => 5, 'option' => 5, 'ref' => 3, 'date' => 5, 'text' => 5]],
            'purchase_order_details' => ['detail','purchase_orders',['option' => 3, 'ref' => 3, 'number' => 8, 'string' => 2]],
            'supplier_sales_orders' => ['master',['index' => 5, 'option' => 3, 'ref' => 3, 'date' => 3, 'string' => 5, 'number' => 8, 'file' => 3]],
            'supplier_sales_order_details' => ['detail','supplier_sales_orders',['option' => 3, 'ref' => 3, 'number' => 8, 'string' => 2]],
            'purchases' => ['master',['index' => 5, 'option' => 5, 'ref' => 3, 'date' => 3, 'text' => 3, 'number' => 8, 'file' => 3]],
            'purchase_details' => ['detail','purchases',['option' => 3, 'ref' => 3, 'number' => 8, 'string' => 2]],
            'vouchers' => ['master',['datetime' => 3, 'option' => 3, 'ref' => 3, 'number' => 5, 'text' => 3]],
            'payments' => ['master',['datetime' => 3, 'option' => 3, 'ref' => 3, 'number' => 5, 'text' => 3]],
            'customer_purchase_orders' => ['master',['index' => 5, 'option' => 5, 'ref' => 3, 'date' => 3, 'string' => 5, 'text' => 5, 'file' => 3]],
            'customer_purchase_order_details' => ['detail','customer_purchase_orders',['option' => 3, 'ref' => 3, 'number' => 8, 'string' => 2]],
            'sales_orders' => ['master',['index' => 5, 'option' => 5, 'ref' => 3, 'datetime' => 3, 'date' => 3, 'text' => 5, 'number' => 8]],
            'sales_order_details' => ['detail','sales_orders',['option' => 3, 'ref' => 3, 'number' => 8, 'string' => 2]],
            'sales' => ['master',['index' => 5, 'option' => 5, 'ref' => 3, 'datetime' => 3, 'text' => 5, 'number' => 8]],
            'sales_details' => ['detail','sales',['option' => 3, 'ref' => 3, 'number' => 8, 'string' => 2]],
            'invoices' => ['master',['datetime' => 2, 'date' => 2, 'option' => 3, 'ref' => 3, 'number' => 3, 'text' => 2, 'string' => 2]],
            'receipts' => ['master',['datetime' => 2, 'date' => 2, 'option' => 3, 'ref' => 3, 'number' => 3, 'text' => 2, 'string' => 2]],
        ];

        public static $main_tables = [
            'settings','codes','headers','options','files','apis','forms','validations','groups','taxes'
        ];

        public static $details_structure = [
            'index' => ['string',64],
            'string' => ['string',256],
            'number' => ['decimal',30,10],
            'datetime' => ['datetime'],
            'date' => ['date'],
            'time' => ['time'],
            'option' => ['string',512],
            'ref' => ['unsignedBigInteger'],
            'text' => ['string',2048],
            'file' => ['foreignField','files','set null'],
        ];

        public static $index_fields = ['index','option','file','ref'];

        public static $header_types = [
            'text','number','datetime','date','time','option','textarea','file','checkbox','radio','table','model','country','state','city','status','custom'
        ];

    }
