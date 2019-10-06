<?php
use MainModel as MainModel;

class Hero extends MainModel
{
    public $id;
    public $level;
    public $experience;
    public $name;
    public $health;
    public $strength;
    public $defence;
    public $speed;
    public $luck;

    public function __construct(Array $properties=array()) {
        foreach($properties as $key => $value){
            $this->{$key} = $value;
        }
    }

}