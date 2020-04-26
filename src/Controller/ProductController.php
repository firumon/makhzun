<?php

namespace Firumon\Makhzun\Controller;

use Firumon\Makhzun\Model\Group;
use Firumon\Makhzun\Model\Header;
use Firumon\Makhzun\Model\Option;
use Firumon\Makhzun\Model\Product;
use Firumon\Makhzun\Model\Tax;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->paginate(15);
        $links = $products->withQueryString()->links();
        return view('Makhzun::products.index',compact('products','links'));
    }

    public function create(){
        if(request()->getMethod() === 'POST') {
            self::FlashToastr(self::ProcessForm(Product::class), 'product');
            return redirect()->back();
        }
        return view('Makhzun::products.create');
    }
    public function group(){
        $master = request()->segment(5); $item = mConfig('PRODUCT_GROUP_NAME.PRDGRP' . request()->segment(5));
        if(request()->getMethod() === 'POST'){
            $form_fields = ['master','name','parent','grand','order','status'];
            self::FlashToastr(self::ProcessForm(Group::class,request()->only($form_fields)),$item);
            return redirect()->back();
        }
        return view('Makhzun::products.group',['item' => $item, 'master' => $master]);
    }
    public function uom(){
        if(request()->getMethod() === 'POST'){
            $form_fields = ['code','option','order','status'];
            self::FlashToastr(self::ProcessForm(Option::class,request()->merge(['code' => 'OPTPRDUOM'])->only($form_fields)),'UOM');
        }
        return view('Makhzun::products.uom',['records' => Option::where('code','OPTPRDUOM')->get()]);
    }
    public function tax(){
        $taxoncode = settings('SETTAXONCODE'); $on = mConfig('PRODUCT_GROUP_NAME.' . $taxoncode); $no = substr($taxoncode,-1);
        if(request()->getMethod() === 'POST'){
            foreach (request()->tax as $id => $update)
                Group::where(function($Q)use($no,$id){ $Q->whereNull('parent')->where(['master' => $no, 'id' => $id]); })
                    ->orWhere(function($Q)use($no,$id){ $Q->whereNotNull('parent')->where(['master' => $no, 'grand' => $id]); })
                    ->update($update);
            self::FlashToastr(['status' => 'success','type' => 'update'],'Tax Details');
        }
        return view('Makhzun::products.tax',['taxes' => Tax::whereGroup(1)->whereStatus('Active')->get(),'groups' => Group::whereNull('parent')->whereMaster($no)->get(), 'on' => $on]);
    }

    public function getProductsCount(){
        return [Product::where('status','Active')->count()];
    }
    public function getProductsStockValue(){
        $header = Header::where(['table' => 'products'])->pluck('field','code')->toArray();
        $query = "SELECT SUM(`{$header['PRDPRICE']}`*`{$header['PRDSTOCK']}`) AS 'value' FROM products GROUP BY `status` HAVING `status` = 'Active'";
        return DB::select($query);
    }
    public function getNonStockProductsCount(){
        $header = Header::where(['code' => 'PRDSTOCK'])->pluck('field','code')->toArray();
        $query = "SELECT COUNT(`id`) AS 'count' FROM products WHERE `{$header['PRDSTOCK']}` <= 0 AND `status` = 'Active'";
        return DB::select($query);
    }
}
