<?php

namespace Firumon\Makhzun\Controller;

use Firumon\Makhzun\Model\Header;
use Firumon\Makhzun\Model\Option;
use Firumon\Makhzun\Model\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        if(request()->getMethod() === 'POST'){
            $data = self::requestToDB(Product::class);
            request()->session()->flash('toastr', ($data['status']) ? ['success' => 'Product '.$data['type'].'d successfully!'] : ['error' => 'Product '.$data['type'].' error, Please try again!!']);
        }
        $products = Product::latest()->paginate(15);
        $links = $products->withQueryString()->links();
        return view('Makhzun::products.index',compact('products','links'));
    }

    public function category(){
        if(request()->getMethod() === 'POST'){
            $data = self::requestToDB(Option::class,request()->only(request('_record_id',null) ? ['option','order','status'] : ['code','option','order']));
            request()->session()->flash('toastr', ($data['status']) ? ['success' => 'Category '.$data['type'].'d successfully!'] : ['error' => 'Category '.$data['type'].' error, Please try again!!']);

//            $this->createOrUpdate(Option::class,request()->only(['option','order','status']));
            /*if(request()->_record_id){
                $Option = Option::where('id',request()->_record_id)->update(request()->only(['option','order','status']));
                if($Option) request()->session()->flash('toastr', ['success' => 'Category updated successfully!']);
                else request()->session()->flash('toastr', ['error' => 'Error in updating category, Please try again!']);
            } else {
                $Option = Option::create(request()->only(['code','option','order']));
                if($Option) request()->session()->flash('toastr', ['success' => 'Category added successfully!']);
                else request()->session()->flash('toastr', ['error' => 'Error in adding category, Please try again!']);
            }*/
        }
//        $categories = Option::where('code','OPTPRDCATGRY')->orderBy('order')->toSql(); dd($categories);
        $categories = Option::where('code','OPTPRDCATGRY')->orderBy('order')->get();
//        $categories = request('search_text') ? $categories->where('option','like','%'.request('search_text').'%')->get() : $categories->get();
        return view('Makhzun::products.category',compact('categories'));
    }

    public function brand(){
        if(request()->getMethod() === 'POST'){
            if(request()->_record_id){
                $Option = Option::where('id',request()->_record_id)->update(request()->only(['option','order','status']));
                if($Option) request()->session()->flash('toastr', ['success' => 'Brand updated successfully!']);
                else request()->session()->flash('toastr', ['error' => 'Error in updating brand, Please try again!']);
            } else {
                $Option = Option::create(request()->only(['code','option','order']));
                if($Option) request()->session()->flash('toastr', ['success' => 'Brand added successfully!']);
                else request()->session()->flash('toastr', ['error' => 'Error in adding brand, Please try again!']);
            }
        }
        $brands = Option::where('code','OPTPRDBRAND')->orderBy('order')->get();
//        $brands = request('search_text') ? $brands->where('option','like','%'.request('search_text').'%')->get() : $brands->get();
        return view('Makhzun::products.brand',compact('brands'));
    }

    public function create(){
        $headers = Header::where('table','products')->get();
        return view('Makhzun::products.create',compact('headers'));
    }

    public function getProductsCount(){ return [Product::where('status','Active')->count()]; }
    public function getProductsStockValue(){
        $header = Header::where(['table' => 'products'])->pluck('field','code')->toArray();
        $query = "SELECT SUM(`{$header['PRDPRICE01']}`*`{$header['PRDSTOCK']}`) AS 'value' FROM products GROUP BY `status` HAVING `status` = 'Active'";
        return DB::select($query);
    }
    public function getNonStockProductsCount(){
        $header = Header::where(['code' => 'PRDSTOCK'])->pluck('field','code')->toArray();
        $query = "SELECT COUNT(`id`) AS 'count' FROM products WHERE `{$header['PRDSTOCK']}` <= 0 AND `status` = 'Active'";
        return DB::select($query);
    }
}
