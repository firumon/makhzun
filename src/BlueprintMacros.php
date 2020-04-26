<?php

    namespace Firumon\Makhzun;

    use Illuminate\Database\Schema\Blueprint;

    class BlueprintMacros
    {

        public function __construct(){
            $this->foreign();
            $this->fields();
            $this->extras();
            $this->audit();
            $this->master();
            $this->detail();
        }

        private function foreign(){
            Blueprint::macro('foreignField',function($field,$table,$onDelete = 'cascade'){
                $fieldObj = $this->unsignedBigInteger($field)->index();
                if($onDelete === 'set null') $fieldObj->nullable();
                $this->foreign($field)->references('id')->on($table)->onUpdate('cascade')->onDelete($onDelete);
                return $fieldObj;
            });
        }
        private function fields(){
            Blueprint::macro('name',function(){ $this->string('name',128)->index(); });
            Blueprint::macro('status',function(){ $this->enum('status',['Active','Inactive'])->default('Active'); });
            Blueprint::macro('code',function(){ $this->char('code',12)->index(); $this->foreign('code')->references('code')->on('codes')->onUpdate('cascade')->cascadeOnDelete(); });
            Blueprint::macro('code2',function(){ $this->char('code',16)->index(); });
            Blueprint::macro('option',function($field = 'option'){ $this->foreignField($field,'options','set null'); });
        }
        private function extras(){
            Blueprint::macro('pack',function($item,$count){
                $setup = Table::$details_structure[$item];
                $type = $setup[0]; $args1 = array_slice($setup,1); $index = in_array($item,Table::$index_fields);
                $func = [$this,$type];
                for($i = 0; $i < $count; $i++){
                    $name = $item . $i; $args = array_merge([$name],$args1);
                    $blueprint = call_user_func_array($func,$args)->nullable(); if($index) $blueprint->index();
                }
            });
        }
        private function audit(){
            Blueprint::macro('audit',function(){
                foreach (['created_by','updated_by','deleted_by'] as $field){
                    $this->unsignedBigInteger($field)->nullable();
                    $this->foreign($field)->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
                }
                $this->timestamps();
                $this->softDeletes();
            });
        }
        private function master(){
            Blueprint::macro('master',function($fields){
                $this->id();
                $this->name();
                foreach ($fields as $field => $count) $this->pack($field,$count);
                $this->status();
                $this->audit();
            });
        }
        private function detail(){
            Blueprint::macro('detail',function($belongs,$fields,$name = false){
                $this->id();
                if($name) $this->name();
                $this->foreignField('belongs',$belongs);
                foreach ($fields as $field => $count) $this->pack($field,$count);
                $this->status();
                $this->audit();
            });
        }

        public static function macro(){
            return new self();
        }
    }
