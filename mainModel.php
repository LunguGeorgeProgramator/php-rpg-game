<?php
use DataBase as DB;

class MainModel {

    protected function setConnectDB(){
        return (new DB);
    }

    public function playerDetails($row, $id){
        return (object) array_merge([
            'id' => $row["id"],
            'level' =>  $row["level"],
            'experience' => $row["experience"],
            'name' =>  $row["name"]
        ], $this->getAttributes($id));
    }

    public function find($id){
        $result = $this->setConnectDB()->queryRun("SELECT * FROM " . strtolower(get_class($this)) . " where id=" . $id);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $this->playerDetails($row, $id);
            }
        } else {
            return (object) [];
        }
    }

    public function all(){
        $resultArray = [];
        $result = $this->setConnectDB()->queryRun("SELECT * FROM " . strtolower(get_class($this)));
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($resultArray, $this->playerDetails($row, $row["id"]));      
            }
        } else {
            return (object) $resultArray;
        }
        return (object) $resultArray;
    }

    protected function getAttributes($id){
        $attributes = [];
        $result = self::setConnectDB()->queryRun("SELECT * FROM attributes_max_min where subject_type = '" . strtolower(get_class($this)) . "' and subject_id=" . $id);
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
    
}