<?php
/*
 * Changes to made in adminlte config file
 * Delete all items in menu
 * add nav-child-indent nav-legacy to classes_sidebar_nav
 * add text-sm to classes_body
 *
 * Changes to other config & env files
 * env
 *      <DB Details>
 *      QUEUE_CONNECTION=database
*/

const PRODUCT_GROUP_NAME = [
    'PRDGRP1' => 'Category',
    'PRDGRP2' => 'Brand',
];

    return [

        'FORM_STATUS_OPTIONS'                       =>  [['id' => 'Active', 'name' => 'Active'],['id' => 'Inactive', 'name' => 'Inactive']],
        'FORM_YESNO_OPTIONS'                        =>  [['id' => 'YES', 'name' => 'YES'],['id' => 'NO', 'name' => 'NO']],

        'PRODUCT_GROUP_NAME'                        =>  PRODUCT_GROUP_NAME,

        'page_routes'                               =>  [],

        'resource_name'                             =>  [
            'product'                               =>  'Item',
            'contact'                               =>  'Contact',
            'supplier'                              =>  'Supplier',
            'customer'                              =>  'Customer',


            'request_for_quotation'                 =>  'Request For Quotation',
            'customer_request_for_quotation'        =>  'Customer RFQ',
            'sales_quotation'                       =>  'Sales Quotation',
            'supplier_quotation'                    =>  'Supplier Quotation',
            'purchase_order'                        =>  'Purchase Order',
            'customer_purchase_order'               =>  'Customer PO',
            'sale'                                  =>  'Sales',
            'delivery_note'                         =>  'Delivery Note',
            'purchase'                              =>  'Purchase',
            'goods_receipt_note'                    =>  'Goods Receipt Note',

            'sales_invoice'                         =>  'Sales Invoice',
            'supplier_invoice'                      =>  'Supplier Invoice',

            'voucher'                               =>  'Voucher',
            'payment'                               =>  'Payment',
            'payment_slip'                          =>  'Payment Slip',
            'receipt'                               =>  'Receipt',
            'payment_receipt'                       =>  'Payment Receipt',
        ],

    ];
