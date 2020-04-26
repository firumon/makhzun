<?php

namespace Firumon\Makhzun\Controller;

use Firumon\Makhzun\Model\City;
use Firumon\Makhzun\Model\Country;
use Firumon\Makhzun\Model\State;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function manage(){
        return (request()->has('country'))
            ? $this->fetchStates(request()->country)
            : (request()->has('state')
                ? $this->fetchCities(request()->state)
                : null);

    }

    private function fetchStates($country){ return State::where(compact('country'))->pluck('name','id'); }
    private function fetchCities($state){ return City::where(compact('state'))->pluck('name','id'); }

    public function states($country){ return State::where(compact('country'))->get(); }
    public function state($country){ return State::create(request()->all()); }
    public function cities($state){ return City::where(compact('state'))->get()->map(function($city){ return $city->withoutRelations(); }); }
    public function city($country,$state){ return City::create(request()->all()); }

    public function countryUpdate(Request $request){ return Country::where('id',$request->id)->update($request->all()); }
    public function stateUpdate(Request $request){ return State::where('id',$request->id)->update($request->all()); }
    public function cityUpdate(Request $request){ return City::where('id',$request->id)->update($request->all()); }
}
