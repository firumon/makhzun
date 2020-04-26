<?php


    namespace Firumon\Makhzun\Scope;


    use Firumon\Makhzun\Controller\Controller;
    use Firumon\Makhzun\Model\Header;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Scope;

    class SearchScope implements Scope
    {
        public function apply(Builder $builder, Model $model)
        {
            $text = request('search_text'); $search = $model->headerModel
                ? self::SearchCondition($model,$text)
                : array_fill_keys((array) $model->search,"%$text%");
            if(!empty($search)) $builder->where(function($builder) use($search) {
                foreach ($search as $field => $value) $builder->orWhere($field,'like',$value);
            });
        }

        private static function SearchCondition($model,$text){
            if(!$text || !$model->search) return [];
            $text = "%$text%"; $search = (array) $model->search;
            return $model->getHeaderAttribute()->mapWithKeys(function($item,$code)use($text,$search){ return in_array($code,$search) ? [$item->field => $text] : []; })->toArray();
        }

    }
