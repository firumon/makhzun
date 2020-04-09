<?php

    namespace Firumon\Makhzun\Traits;

    trait ComponentBgsTrait
    {

        public $aBgs = ['primary','blue','secondary','success','green','info','cyan','warning','yellow','danger','red','black','gray','gray-dark','light','indigo','navy','purple','fuchsia','pink','maroon','orange','lime','olive','teal'];
        public $prefs = ['gradient'];

        public function bgs(){
            $bgs = [];
            foreach ($this->aBgs as $bg){
                $bgs[] = $bg;
                foreach ($this->prefs as $pref) $bgs[] = $pref . '-' . $bg;
            }
            return $bgs;
        }

    }
