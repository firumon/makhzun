<?php

    namespace Firumon\Makhzun\Traits;

    use Firumon\Makhzun\Model\Header;
    use Firumon\Makhzun\Model\Model;
    use Firumon\Makhzun\Retrieve\Retrieve;

    trait ModelRetrieve
    {

        protected static function bootModelRetrieve()
        {
            static::retrieved(function(Model $Model){
                if(!$Model->headerModel) return;
                $table = $Model->getTable();
                $fields = Header::select('code','field','type','d0','d1','d2','d3','d4')->where('table',$table)->get()->keyBy->field->toArray();
                $specialRetrieves = ['option','table','model','checkbox','file','country','state','city','custom'];
                foreach ($fields as $field => $data){
                    if(!in_array($data['type'],$specialRetrieves)) $Model->setAttribute($data['code'],$Model->$field);
                    else {
                        $retrieve = Retrieve::retrieve($data['type'],$Model->$field,$data['d0'],$data['d1'],$data['d2'],$data['d3'],$data['d4']);
                        $Model->setAttribute($data['code'],$retrieve['value']);
                        $Model->setAttribute($data['code'] . '_object',$retrieve['object']);
                        $Model->setAttribute($data['code'] . '_field',$retrieve['field']);
                    }
                }
            });
        }
    }
