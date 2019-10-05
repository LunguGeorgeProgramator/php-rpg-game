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

    public function fight($playerOne, $playerTwo, $turn, $turn_count){
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
        $_SESSION['turns_remaining']--;
        if( $turn_count <= 0 ){
            $log = "No more turns, reached the limit of 20";
            $player1->health = 0;
            $player2->health = 0;
        }
        return array($log, $player1, $player2);
    }

    public function checkTurn($playerOne, $playerTwo){
        $p1Chance = $this->calculateChance($playerOne->luck);
        $p2Chance =$this->calculateChance($playerTwo->luck);
        if ($playerOne->speed > $playerTwo->speed){
            return true;
        }else if($playerOne->speed == $playerTwo->speed){
            if($p1Chance && !$p2Chance){
                return true;
            }else if (!$p1Chance && $p2Chance){
                return false;
            }else if ($p1Chance == $p2Chance){
                return ($playerOne->luck > $playerTwo->luck? true : false);
            }
        }else {
            return false;
        }
    }
}