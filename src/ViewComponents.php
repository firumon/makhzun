<?php


    namespace Firumon\Makhzun;


    use Illuminate\Support\Facades\Blade;
    use Illuminate\Support\Str;

    class ViewComponents
    {
        static private $components = [
            'Card','Table','Input','Options','Box','Api','Form','Modal'
        ];

        static public function register(){

            foreach (self::$components as $component){
                $path = Str::of($component)->kebab()->prepend('makhzun-')->__toString();
                $class = Str::of(__NAMESPACE__)->prepend('\\')->append('\\View\\Components\\',$component)->__toString();
                Blade::component($path,$class);
            }
        }

    }
