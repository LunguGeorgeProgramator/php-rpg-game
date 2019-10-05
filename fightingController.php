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

    public function attack($strength, $defence){
        return (float) abs($strength - $defence);
    }

    public function calculateChance($luck){
        if (rand(1,100) <= $luck)
        // if (rand(0, $luck) >= rand(0, 100))
            return true; // echo "misss success";
        return false; // echo "no miss";
    }

    public function damage(){
        
    }

    public function fight($playerOne, $playerTwo){
        $playerOnehealth = $playerOne->health;
        $playerTwohealth = $playerTwo->health;
        $atackPlayerOne = $this->attack($playerTwo->strength, $playerOne->defence);
        $atackPlayerTwo = $this->attack($playerTwo->strength, $playerOne->defence);

        while ($playerOnehealth > 0 && $playerTwohealth > 0) {
            if(!$this->calculateChance($playerOne->luck)){
                $damageHero = $playerOnehealth-$atackPlayerTwo;
                $playerOnehealth = $damageHero;
                echo "$playerTwo->name hit $playerOne->name, $damageHero damage <br>";
                if ($playerOnehealth <= 0){
                    echo "$playerOne->name is dead!!";
                    break;
                }
            }else{
                echo "$playerTwo->name miss to hit $playerOne->name, 0 damage <br>";
            }
            if(!$this->calculateChance($playerTwo->luck)){
                $damageMonster = $playerTwohealth-$atackPlayerOne;
                $playerTwohealth = $damageMonster;
                echo "$playerOne->name hit $playerTwo->name, $damageMonster damage <br>";
                if ($playerTwohealth <= 0){
                    echo "$playerTwo->name is dead!!";
                    break;
                }
            }else{
                echo "$playerOne->name miss to hit $playerOne->name, 0 damage <br>";
            }
            echo "hero health $playerOnehealth <br>";
            echo "monster health $playerTwohealth <br>";
        }

    }
}