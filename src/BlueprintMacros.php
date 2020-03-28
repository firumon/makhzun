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
            Blueprint::macro('option',function($field = 'option'){ $this->foreignField($field,'options','set null'); });
        }
        private function extras(){
            $criteria = Table::$details_structure;
            Blueprint::macro('extras',function($length = 'normal')use($criteria){
                $pos = array_search($length,['min','normal']);
                foreach ($criteria as $field => $data){
                    for($i = 0; $i < $data[$pos]; $i++){
                        if(array_key_exists(4,$data) && $data[4] === true) call_user_func_array([$this,$data[2]],array_merge([$field.$i],explode(",",$data[3])))->nullable()->index();
                        else if($data[2] === 'foreignField') call_user_func_array([$this,$data[2]],array_merge([$field.$i],explode(",",$data[3])));
                        else call_user_func_array([$this,$data[2]],array_merge([$field.$i],explode(",",$data[3])))->nullable();
                    }
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
            Blueprint::macro('master',function($extras = 'normal'){
                $this->id();
                $this->name();
                $this->extras($extras);
                $this->status();
                $this->audit();
            });
        }
        private function detail(){
            Blueprint::macro('detail',function($extras,$belongs,$name = false){
                $this->id();
                if($name) $this->name();
                $this->foreignField('belongs',$belongs);
                $this->extras($extras);
                $this->status();
                $this->audit();
            });
        }

        public static function macro(){
            return new self();
        }
    }
