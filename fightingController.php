<?php
use Hero as Player;
use Monster as Opponent;

class Fighting {

    public function setAtrributes($atribute){
        $arrayAttr = [];
        foreach ($atribute as $key => $value) {
            if (is_object($value)) {
                $value = rand($value->min, $value->max);
            }
            $arrayAttr = array_merge($arrayAttr, [$key => $value]);
        }
        return $arrayAttr;
    } 

    
}