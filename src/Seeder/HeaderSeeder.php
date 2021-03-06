<?php

    namespace Firumon\Makhzun\Seeder;

    use Firumon\Makhzun\Traits\ProductGroupTrait;
    use Firumon\Makhzun\Traits\SeederTrait;
    use Illuminate\Database\Seeder;

    class HeaderSeeder extends Seeder implements SeederInterface
    {
        use SeederTrait;
        use ProductGroupTrait;

        public function fields(): array
        {
            return ['table','label','code','field','type','d0','d1'];
        }

        public function records(): array
        {
            return array_filter([
                ['products','Product Name','PRDNAME','name','text'],
                ['products','Product Code','PRDCODE','index0','text'],
                ['products','Description','PRDDESC','text0','textarea'],
                ['products','UOM','PRDUOM','option0','option','OPTPRDUOM'],
                self::getProductFieldGroup(1),
                self::getProductFieldGroup(2),
                self::getProductFieldGroup(3),
                self::getProductFieldGroup(4),
                self::getProductFieldGroup(5),
                ['products','Price','PRDPRICE','number0','number'],
                ['products','Stock','PRDSTOCK','number1','number'],
                ['products','Status','PRDSTATUS','status'],
                ['products','Image 01','PRDIMAGE01','file0','file','product','image'],
                ['products','Image 02','PRDIMAGE02','file1','file','product','image'],

                ['contacts','Name','CONTNAME','name','text'],
                ['contacts','Company/Person','CONTTYPE','option0','option','OPTCONTTYPE'],
                ['contacts','Contact Nature','CONTNATURE','option1','option','OPTCONTNAT'],
                ['contacts','Phone','CONTPHONE','index0','text'],
                ['contacts','Email','CONTEMAIL','index1','text'],
                ['contacts','Note','CONTNOTE','text0','text'],
                ['contacts','Designation','CONTDESIGNAT','string0','text'],
                ['contacts','Country','CONTCOUNTRY','ref0','country'],
                ['contacts','State','CONTSTATE','ref1','state'],
                ['contacts','City','CONTCITY','ref2','city'],
                ['contacts','Address','CONTADDR','text1','textarea'],
                ['contacts','Bank','CONTBANK','string1','text'],
                ['contacts','Bank Branch','CONTBNKBRNCH','string2','text'],
                ['contacts','Account Number','CONTACCNO','string3','text'],
                ['contacts','IFSC','CONTISFC','string4','text'],
                ['contacts','Parent Contact','CONTPARENT','ref3','model','Contact'],
                ['contacts','Shipping Address','CONTSHPADDR','text2','textarea'],
                ['contacts','Billing Address','CONTBILLADDR','text3','textarea'],
                ['contacts','Image 01','CONTIMG01','file0','file'],
                ['contacts','Image 02','CONTIMG02','file1','file'],

                ['purchase_orders','Purchase Order','PONAME','name','text'],
                ['purchase_orders','PO Number','PONO','index0','text'],
                ['purchase_orders','Company','POCMP','ref0','model','Contact'],
                ['purchase_orders','Prepared Date','POPREPDATE','date0','date'],
                ['purchase_orders','Expiry Date','POEXPIRYDATE','date1','date'],
                ['purchase_orders','Prepared By','POPREPBY','ref1','model','User'],
                ['purchase_orders','Note','PONOTE','text0','textarea'],

                ['purchase_order_details','Product','PODPRD','ref0','model','Product'],
                ['purchase_order_details','Quantity','PODQTY','number0','text'],

                ['supplier_sales_orders','Sales Order','SSONAME','name','text'],
                ['supplier_sales_orders','SO Number','SSONO','index0','text'],
                ['supplier_sales_orders','Company','SSOCMP','ref0','model','Contact'],
                ['supplier_sales_orders','Prepared Date','SSODATE','date0','date'],
                ['supplier_sales_orders','Expiry Date','SSOEXPIRY','date1','date'],
                ['supplier_sales_orders','Prepared By','SSOPREPARED','string0','text'],
                ['supplier_sales_orders','Ref: PO','SSOREFPO','ref1','model','PurchaseOrder',''],
                ['supplier_sales_orders','Total Amount','SSOTTLAMNT','number0','text'],
                ['supplier_sales_orders','Additional Tax','SSOTAX','number1','text'],
                ['supplier_sales_orders','Delivery Expense','SSODELIEXP','number2','text'],
                ['supplier_sales_orders','Discount','SSODISCOUNT','number3','text'],
                ['supplier_sales_orders','Net Amount Payable','SSONETPAY','number4','text'],
                ['supplier_sales_orders','Document','SSOATTACH','file0','file','partner','sales_orders'],

                ['supplier_sales_order_details','Product','SSODPRD','ref0','model','Product'],
                ['supplier_sales_order_details','Rate','SSODRATE','number0','text'],
                ['supplier_sales_order_details','Quantity','SSODQTY','number1','text'],
                ['supplier_sales_order_details','Amount','SSODAMNT','number2','text'],
                ['supplier_sales_order_details','Tax','SSODTAX','number3','text'],
                ['supplier_sales_order_details','Discount','SSODDISCOUNT','number4','text'],
                ['supplier_sales_order_details','Total','SSODTOTAL','number5','text'],

                ['purchases','Purchase','PURNAME','name','text'],
                ['purchases','Purchase Number','PURNO','index0','text'],
                ['purchases','Company','PURCMP','ref0','model','Contact'],
                ['purchases','Date','PURDATE','date0','text'],
                ['purchases','Shipping Address','PURSHPADDR','text0','text'],
                ['purchases','Billing Address','PURBILLADDR','text1','text'],
                ['purchases','Amount','PURAMOUNT','number0','text'],
                ['purchases','Additional Tax','PURTAX','number1','text'],
                ['purchases','Shipping Charge','PURSHPEXP','number2','text'],
                ['purchases','Discount','PURDISC','number3','text'],
                ['purchases','Round Off','PURRNDOFF','number4','text'],
                ['purchases','Net Payable','PURNETPAY','number5','text'],
                ['purchases','Ref: PO','PURREFPO','ref1','model','PurchaseOrder'],
                ['purchases','Ref: SSO','PURREFSSO','ref2','model','SupplierSalesOrder'],
                ['purchases','Notes','PURNOTES','text0','textarea'],
                ['purchases','Invoice Attachment','PURINVATTACH','file0','file','partner','invoices'],

                ['purchase_details','Product','PURDPRD','ref0','model','Product'],
                ['purchase_details','Rate','PURDRATE','number0','text'],
                ['purchase_details','Quantity','PURDQTY','number1','text'],
                ['purchase_details','Total','PURDTOTAL','number2','text'],
                ['purchase_details','Tax','PURDTAX','number3','text'],
                ['purchase_details','Discount','PURDDISCOUNT','number4','text'],
                ['purchase_details','Net Payable','PURDNETPAY','number5','text'],

                ['vouchers','Voucher Number','VCHRNO','name','text'],
                ['vouchers','Date','VCHRDATE','datetime0','text'],
                ['vouchers','Type','VCHRTYPE','option0','option','OPTVCHRTYPE'],
                ['vouchers','Amount','VCHRAMOUNT','number0','text'],
                ['vouchers','Ref: Purchase','VCHRREFPUR','ref1','model','Purchase'],
                ['vouchers','Note','VCHRNOTE','text0','text'],
                ['vouchers','Payment Status','VCHRPAYSTAT','option1','option','OPTVCHRPAYST'],

                ['payments','Payment No','PYMTNO','name','text'],
                ['payments','Date','PYMTDATE','datetime0','date'],
                ['payments','Ref: Voucher','PYMTREFVCHR','ref0','model','Voucher'],
                ['payments','Payment Mode','PYMTMODE','option0','option','OPTPYMTMODE'],
                ['payments','Amount','PYMTAMOUNT','number0','text'],
                ['payments','Cheque Number','PYMTCHQNO','string0','text'],
                ['payments','Cheque Date','PYMTCHQDATE','date0','date'],
                ['payments','Bank','PYMTCHQBANK','string1','text'],
                ['payments','Note','PYMTNOTE','text0','textarea'],
                ['payments','Receipt Attachment','PYMTRECATTCH','file0','file','partner','receipts'],
                ['payments','Other Voucher','PYMTVCHRATTH','text1','file','document','vouchers'],

                ['customer_purchase_orders','Customer PO','CPONAME','name','text'],
                ['customer_purchase_orders','PO Number','CPONO','index0','text'],
                ['customer_purchase_orders','Company','CPOCMP','ref0','model','Contact'],
                ['customer_purchase_orders','Date','CPODATE','date0','date'],
                ['customer_purchase_orders','Expire Date','CPOEXPIRY','date1','date'],
                ['customer_purchase_orders','Prepared By','CPOPREPBY','string0','text'],
                ['customer_purchase_orders','Delivery Address','CPODELIADDR','text0','textarea'],
                ['customer_purchase_orders','Billing Address','CPOBILLADDR','text1','textarea'],
                ['customer_purchase_orders','Customer Remarks','CPOCUSTRMKRS','string1','textarea'],
                ['customer_purchase_orders','Note','CPONOTE','string2','textarea'],
                ['customer_purchase_orders','Document Attachment','CPODOCATTACH','file0','file','partner','purchase_orders'],

                ['customer_purchase_order_details','Product','CPODPRD','ref0','model','Product'],
                ['customer_purchase_order_details','Quantity','CPODQTY','number0','text'],

                ['sales_orders','Sales Order','SONAME','name','text'],
                ['sales_orders','SO Number','SONO','index0','text'],
                ['sales_orders','Company','SOCMP','ref0','model','Contact'],
                ['sales_orders','Date','SODATE','datetime0','datetime'],
                ['sales_orders','Expire','SOEXPIRY','date1','date'],
                ['sales_orders','Prepared By','SOPREPBY','index2','model','User'],
                ['sales_orders','Delivery Address','SODELIADDR','text0','textarea'],
                ['sales_orders','Billing Address','SOBILLADDR','text1','textarea'],
                ['sales_orders','Total','SOTOTAL','number0','text'],
                ['sales_orders','Additional Tax','SOTAX','number1','text'],
                ['sales_orders','Delivery Charge','SODELICHRGE','number2','text'],
                ['sales_orders','Discount','SODSCOUNT','number3','text'],
                ['sales_orders','Round Off','SORNDOFF','number4','text'],
                ['sales_orders','Other Charges','SOOTHCHRGE','number5','text'],
                ['sales_orders','Net Payable','SONETPAY','number6','text'],

                ['sales_order_details','Product','SODPRD','ref0','model','Product'],
                ['sales_order_details','Rate','SODRATE','number0','text'],
                ['sales_order_details','Quantity','SODQTY','number1','text'],
                ['sales_order_details','Amount','SODAMOUNT','number2','text'],
                ['sales_order_details','Tax','SODTAX','number3','text'],
                ['sales_order_details','Discount','SODDISCOUNT','number4','text'],
                ['sales_order_details','Total','SODTOTAL','number5','text'],

                ['sales','Name','SLSNAME','name','text'],
                ['sales','Sales No','SLSNO','index0','text'],
                ['sales','Company','SLSCMP','ref0','model','Contact'],
                ['sales','Date','SLSDATE','datetime0','date'],
                ['sales','Ref: SO','SLSREFSO','ref1','model','SalesOrder'],
                ['sales','Ref: CPO','SLSREFCPO','ref2','model','CustomerPurchaseOrder'],
                ['sales','Delivery Address','SLSDELIADDR','text0','textarea'],
                ['sales','Billing Address','SLSBILLADDR','text1','textarea'],
                ['sales','Total','SLSTOTAL','number0','text'],
                ['sales','Additional Tax','SLSTAX','number1','text'],
                ['sales','Delivery Charge','SLSDELICHRGE','number2','text'],
                ['sales','Discount','SLSDISCOUNT','number3','text'],
                ['sales','Round Off','SLSRNDOFF','number4','text'],
                ['sales','Other Charges','SLSOTHCHRGE','number5','text'],
                ['sales','Net Payable','SLSNETPAY','number6','text'],

                ['sales_details','Product','SLSDPRD','ref0','model','Product'],
                ['sales_details','Rate','SLSDRATE','number0','text'],
                ['sales_details','Quantity','SLSDQTY','number1','text'],
                ['sales_details','Amount','SLSDAMOUNT','number2','text'],
                ['sales_details','Tax','SLSDTAX','number3','text'],
                ['sales_details','Discount','SLSDDISCOUNT','number4','text'],
                ['sales_details','Total','SLSDTOTAL','number5','text'],

                ['invoices','Invoice Number','INVNO','name','text'],
                ['invoices','Date','INVDATE','datetime0','text'],
                ['invoices','Type','INVTYPE','option0','option','OPTINVTYPE'],
                ['invoices','Amount','INVAMOUNT','number0','text'],
                ['invoices','Ref: Sales','INVREFSLS','ref1','model','Sales'],
                ['invoices','Note','INVNOTE','text0','text'],
                ['invoices','Payment Status','INVPAYSTAT','option1','option','OPTINVPAYST'],

                ['receipts','Receipt No','RCPTNO','name','text'],
                ['receipts','Date','RCPTDATE','datetime0','date'],
                ['receipts','Ref: Invoice','RCPTREFVCHR','ref0','model','Invoice'],
                ['receipts','Payment Mode','RCPTMODE','option0','option','OPTPYMTMODE'],
                ['receipts','Amount','RCPTAMOUNT','number0','text'],
                ['receipts','Cheque Number','RCPTCHQNO','string0','text'],
                ['receipts','Cheque Date','RCPTCHQDATE','date0','date'],
                ['receipts','Bank','RCPTCHQBANK','string1','text'],
                ['receipts','Note','RCPTNOTE','text0','textarea'],

            ]);
        }

    }
