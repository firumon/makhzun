<?php

    namespace Firumon\Makhzun\Traits;

    use Illuminate\Support\Str;

    trait SeederTrait
    {
        public function common(): array
        {
            return ['created_at' => now()->toDateTimeString(),'updated_at' => now()->toDateTimeString()];
        }

        public function getPrepare(){
            $fields = $this->fields(); $common = $this->common(); $length = count($fields);
            return collect($this->records())->map(function($record)use($fields,$common,$length){
                return array_merge(array_combine($fields,array_pad($record,$length,null)),$common);
            })->toArray();
        }

        public function run()
        {
            $class = Str::of(__CLASS__)
                ->substr(0,-6)
                ->replace('Seeder','Model')
                ->__toString();
            $records = $this->getPrepare();
            if(count($records) <= 5000) return $class::insert($records);
            foreach(array_chunk($records,5000) as $rRecords) $class::insert($rRecords);
            return true;
        }
    }
