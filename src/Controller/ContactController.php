<?php

namespace Firumon\Makhzun\Controller;

use Firumon\Makhzun\Model\Contact;
use Firumon\Makhzun\Model\Header;
use Firumon\Makhzun\Model\Option;

class ContactController extends Controller
{
    public static $recentDaysCount = 30;

    public function index(){
        $contacts = Contact::latest()->paginate(15);
        $links = $contacts->withQueryString()->links();
        return view('Makhzun::contacts.index',compact('contacts','links'));
    }


    public function form(){
        if(request()->getMethod() === 'POST') return self::FlashToastr(self::ProcessForm(Contact::class),config('makhzun.resource_name.contact'));
        return view('Makhzun::contacts.form');
    }

    public function getContactsCount(){ return [Contact::where('status','Active')->count()]; }
    public function getSuppliersCount(){
        $header = Header::where(['table' => 'contacts'])->pluck('field','code')->toArray(); $options = Option::where('code','OPTCONTNAT')->pluck('id','option')->toArray();
        return [Contact::whereIn($header['CONTNATURE'],[$options['Both'],$options[MRN('supplier')]])->where('status','Active')->count()];
    }
    public function getCustomersCount(){
        $header = Header::where(['table' => 'contacts'])->pluck('field','code')->toArray(); $options = Option::where('code','OPTCONTNAT')->pluck('id','option')->toArray();
        return [Contact::whereIn($header['CONTNATURE'],[$options['Both'],$options[MRN('customer')]])->where('status','Active')->count()];
    }
    public function getNewContactsCount(){
        return [Contact::where('status','Active')->where('created_at','>',self::recentDate())->count()];
    }
    public function getRecentSuppliersCount(){
        return [11];
    }
    public function getRecentCustomersCount(){
        return [14];
    }

    private function recentDate(){
        return now()->subDays(self::$recentDaysCount)->format('Y-m-d H:i:s');
    }
}
