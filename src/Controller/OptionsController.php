<?php


    namespace Firumon\Makhzun\Controller;


    use Firumon\Makhzun\Model\City;
    use Firumon\Makhzun\Model\Country;
    use Firumon\Makhzun\Model\Option;
    use Firumon\Makhzun\Model\State;
    use Firumon\Makhzun\Option\Custom;
    use Illuminate\Support\Facades\DB;

    class OptionsController extends Controller
    {

        public function getOption($code)
        {
            return Option::where('code', $code)->orderBy('order')->where('status','Active')->get()->mapWithKeys(function ($item) {
                return [':' . $item->id => $item->option];
            });
        }
        public function getCheckbox($code){ return $this->getOption($code); }
        public function getRadio($code){ return $this->getOption($code); }

        public function getModel($name, $label = 'name'){
            $class = "\\Firumon\\Makhzun\\Model\\" . $name;
            return $class::where('status','Active')->pluck($label,'id');
        }
        public function getTable($table, $label = 'name'){ return DB::table($table)->where('status','Active')->pluck($label,'id'); }
        public function getCountry($table, $label = 'name'){ return $this->getTable('countries'); }
        public function getState($country){ return State::where('country',$country)->pluck('name','id'); }
        public function getCity($state){ return City::where('state',$state)->pluck('name','id'); }
        public function getCustom($name){ return Custom::fetch($name); }

    }
