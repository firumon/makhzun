<?php


    namespace Firumon\Makhzun\Scope;


    use Firumon\Makhzun\Controller\Controller;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Scope;

    class SearchScope implements Scope
    {
        public function apply(Builder $builder, Model $model)
        {
            if($model->search){
                $search_text = '%' . request('search_text') . '%'; $fields = (array) $model->search;
                if(!empty($fields)){
                    $search = array_fill_keys($fields,$search_text);
                    if(!empty($model->headerModel)) $search = Controller::codeToField($search);
                    if(!empty($search)) foreach ($search as $field => $value) $builder->where($field,'like',$value);
                }
            }
        }

    }
