<?php


    namespace Firumon\Makhzun\Controller;


    use Firumon\Makhzun\Model\Option;
    use Illuminate\Support\Facades\DB;

    class OptionsController extends Controller
    {

        public function getOption($code)
        {
            return Option::where('code', $code)->orderBy('order')->get()->mapWithKeys(function ($item) {
                return [':' . $item->id => $item->option];
            });
        }
        public function getCheckbox($code){ return $this->getOption($code); }
        public function getRadio($code){ return $this->getOption($code); }

        public function getModel($name, $label = 'name'){
            $class = "\\Firumon\\Makhzun\\Model\\" . $name;
            return $class::pluck($label,'id');
        }
        public function getTable($table, $label = 'name'){
            return DB::table($table)->pluck($label,'id');
        }

    }
