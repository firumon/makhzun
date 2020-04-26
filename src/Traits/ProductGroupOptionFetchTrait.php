<?php

    namespace Firumon\Makhzun\Traits;

    use Firumon\Makhzun\Model\Group;
    use Illuminate\Database\Eloquent\Model;

    trait ProductGroupOptionFetchTrait
    {

        public static function label(): string { return 'name'; }

        public static function key(): string { return  'id'; }

        private static $split = ' -> ';

        public static function getCollection($group){
            $name = config("makhzun.PRODUCT_GROUP_NAME.Group$group");
            $model = Group::whereNull('master')->where('name',$name)->first();
            if(!$model) return collect([]); $master = $model->id; $items = [];
            Group::where('master',$master)->get()->each(function($item)use(&$items){
                $prefix = ($item->parent) ? $items[$item->parent] . self::$split : '';
                $items[$item->id] = $prefix . $item->name;
            });
            return collect($items)->map(function($name,$id){ return collect(compact(self::key(),self::label())); });
        }

        public static function retrieve($value){ return Group::find($value); }

    }
