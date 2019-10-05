<?php
    use DataBase as DB;

    class Hero
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

        private function setConnectDB(){
            return (new DB);
        }

        public function heroDetails($row, $id){
            $details = [
                'id' => $row["id"],
                'level' =>  $row["level"],
                'experience' => $row["experience"],
                'name' =>  $row["name"]
            ];
            $attributes =$this->getAttributes($id);
            return (object) array_merge($details, $attributes);
        }

        private function getAttributes($id){
            $attributes = [];
            $result = $this->setConnectDB()->queryRun("SELECT * FROM attributes_max_min where subject_type = 'hero' and subject_id=" . $id);
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
            $result = $this->setConnectDB()->queryRun("SELECT * FROM hero where id=" . $id);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    return $this->heroDetails($row, $id);
                }
            } else {
                return (object) [];
            }
        }

        public function all(){
            $resultArray = [];
            $result = $this->setConnectDB()->queryRun("SELECT * FROM hero");
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    array_push($resultArray, $this->heroDetails($row, $row["id"]));      
                }
            } else {
                return (object) $resultArray;
            }
            return (object) $resultArray;
        }

    }