<?php
    use DataBase as DB;

    class Monster
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

        public function __construct($id = null, $level = null, $experience = null, $name = null, $health = null, $strength = null, $defence = null, $speed = null, $luck = null) {
            $this->dbClass = new DB;
            $this->id = $id;
            $this->level =  $level;
            $this->experience = $experience;
            $this->name =  $name;
            $this->health = $health;
            $this->strength =  $strength;
            $this->defence = $defence;
            $this->speed = $speed;
            $this->luck = $luck;   
        }

        public function heroDetails($id, $level, $experience, $name, $health, $strength, $defence, $speed, $luck){
            return [
                'id' => $id,
                'level' =>  $level,
                'experience' => $experience,
                'name' =>  $name,
                'health' => $health,
                'strength' =>  $strength,
                'defence' => $defence,
                'speed' => $speed,
                'luck' => $luck,
            ];
        }

        private function getAttributes($id){
            $attributes = [];
            $result = $this->dbClass->queryRun("SELECT * FROM attributes_max_min where subject_type = 'monster' and subject_id=" . $id);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $attributes[$row["subject_attribute"]]  = (object) [
                        'min' => $row["min"],
                        'max' => $row["max"],
                    ];
                }
            } else {
                return [];
            }
            return $attributes;
        }

        public function find($id){
            $result = $this->dbClass->queryRun("SELECT * FROM monsters where id=" . $id);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $details = $this->heroDetails(
                        $row["id"], 
                        $row["level"], 
                        $row["experience"],
                        $row["name"], 
                        $row["health"], 
                        $row["strength"], 
                        $row["defence"],  
                        $row["speed"], 
                        $row["luck"]
                    );
                    $attributes =$this->getAttributes($id);
                    return (object) array_merge($details, $attributes);
                }
            } else {
                return (object) [];
            }
        }

        public function all(){
            $resultArray = [];
            $result = $this->dbClass->queryRun("SELECT * FROM monsters");
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $details = $this->heroDetails(
                        $row["id"], 
                        $row["level"], 
                        $row["experience"],
                        $row["name"], 
                        $row["health"], 
                        $row["strength"], 
                        $row["defence"],  
                        $row["speed"], 
                        $row["luck"]
                    );
                    $attributes =$this->getAttributes($row["id"]);
                    $heroAttributes = array_merge($details, $attributes);
                    array_push( $resultArray, (object) $heroAttributes );      
                }
            } else {
                return (object) $resultArray;
            }
            return (object) $resultArray;
        }

    }