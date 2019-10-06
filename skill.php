<?php
    use MainModel as MainModel;

    class Skill extends MainModel
    {
        public $id;
        public $subject_id;
        public $subject_type;
        public $skill_type;
        public $name;
        public $skill_chance;
        public $number_strikes;

        public function __construct(Array $properties=array()) {
            foreach($properties as $key => $value){
                $this->{$key} = $value;
            }
        }
 
        public function playerDetails($row, $id){
            return (object) [
                'id' => $row["id"],
                'skill_type' =>  $row["skill_type"],
                'name' => $row["name"],
                'skill_chance' =>  $row["skill_chance"],
                'number_strikes' =>  $row["number_strikes"],
                'active' =>  $row["active"],
                'subject_type' =>  $row["subject_type"],
                'subject_id' =>  $row["subject_id"],
            ];
        }

        public function relation($id, $player){
            $results = [];
            foreach(parent::all() as $entry){
                if ($entry->subject_id == $id && $entry->subject_type == $player){
                    if($entry->active == 0){
                        continue;
                    }
                    array_push($results, $entry);
                }
            }
            return (object) $results;
        }

    }