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

    public function calculateChance($luck){
        // if (rand(1,100) <= $luck)
        if (rand(0, $luck) >= rand(0, 100))
            return true; // echo "misss success";
        return false; // echo "no miss";
    }

    public function fight($playerOne, $playerTwo, $turn){

        $player1 = ($turn == 1? $playerTwo: $playerOne);
        $player2 = ($turn == 1? $playerOne: $playerTwo);

        $damage = (float) abs($player2->strength - $player1->defence);

        $log = "";

        if ($player1->health <= 0 || $player2->health <= 0){
            return null;
        }
        // while ($playerOne->health > 0 && $playerTwo->health > 0) {
        if(!$this->calculateChance($player1->luck)){
            $player1->health = $player1->health - $damage;
            $log = "$player2->name hit $player1->name, $damage damage. Health remaining ".($player1->health >= 0? $player1->health : 0)." <br>";
            if ($player1->health <= 0){
                $player1->health = 0;
                $log = $log."<br> $player1->name is dead!!";
            }
        }else{
            $log = "$player2->name miss to hit $player1->name, 0 damage. Health remaining $player1->health <br>";
        }

        return array($log, $player1, $player2);
    }
}