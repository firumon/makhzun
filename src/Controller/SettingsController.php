<?php

namespace Firumon\Makhzun\Controller;

use Firumon\Makhzun\Model\Code;
use Firumon\Makhzun\Model\Option;
use Firumon\Makhzun\Model\Settings;
use Firumon\Makhzun\Model\Tax;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function option(){
        $headers = cache('header_options'); $code = last(request()->segments()); $option_detail = $headers[strtoupper($code)];
        $options = Option::where('code',$code)->orderBy('order')->get();
        return view('Makhzun::settings.option',compact('code','option_detail','options'));
    }

    public function global(){
        if(request()->getMethod() === 'POST'){
            foreach(request()->except(['_token','_form_type']) as $id => $value)
                Settings::where('id',$id)->update(['value' => $value]);
            self::FlashToastr(['type' => 'update', 'status' => true],'Settings');
            return redirect()->back();
        }
        $settings = Settings::all();
        return view('Makhzun::settings.global',compact('settings'));
    }

    public function tax(){
        if(request()->getMethod() === 'POST'){
            $request = request()->except('_token');
            if(isset($request['_form_type']) && $request['_form_type'] === 'Update'){
                foreach ($request['_record_id'] as $ID) Tax::where('id',$ID)->update($request[$ID]);
                return redirect()->back()->with('toastr', ['success' => 'Tax updated successfully!']);
            } elseif (isset($request['_record_id']) && !empty($request['_record_id'])) {
                Tax::where('id',$request['_record_id'])->update(request()->only(['code','name','formula','status']));
                return redirect()->back()->with('toastr', ['success' => 'Tax item updated successfully!']);
            } else {
                if(Code::where('code',$request['code'])->exists()) return redirect()->back()->with('toastr', ['error' => 'Error while adding code. May be code is not unique or exceeds 12 character!']);
                Code::create(['code' => $request['code'], 'item' => 'taxes']);
                $taxStatus = Tax::create($request); if(!$taxStatus) return redirect()->back()->with('toastr', ['error' => 'Error while adding tax details. Please try again!']);
                return redirect()->back()->with('toastr', ['success' => 'Tax added successfully!']);
            }
        }
        $taxes = Tax::all()->keyBy->code;
        return view('Makhzun::settings.tax',compact('taxes'));
    }

    public function country(){
        return view('Makhzun::settings.country');
    }

    public function form(){
        $code = Str::of(url()->previous())->afterLast("/")->__toString(); $item = cache('header_options')[strtoupper($code)]['label'];
        $form_fields = ['code','option','order','status'];
        self::FlashToastr(self::ProcessForm(Option::class,request()->merge(['code' => $code])->only($form_fields)),$item);
        return redirect()->back();
    }
}
