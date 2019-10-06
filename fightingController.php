<?php
use Hero as Player;
use Monster as Opponent;

class Fighting {

    public $skills;

    public function __construct(Array $properties=array()) {
        $this->skills = new Skill;
    }

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

    public function setArraySkill($value){
        return (object) [
            'skill_chance' => $this->calculateChance($value->skill_chance),
            'skill_name' => $value->name,
            'skill_multiplier' => $value->number_strikes
        ];
    }

    public function skillsStrike($skills){
        
        $strikes = null;
        $defence = null;
        $strikesMax = [];
        $defenceMax = [];
        foreach(['attack', 'defence'] as $setType){
            foreach($skills as $value){
                if($value->skill_type == $setType && $value->active == 1){
                    if($setType == 'attack'){
                        $newchance = rand(0, $value->skill_chance);
                        array_push($strikesMax, $newchance);
                        if($strikesMax && max($strikesMax) <= $newchance){
                            $strikes = $this->setArraySkill($value); 
                        }
                    }else {
                        $newchance = rand(0, $value->skill_chance);
                        array_push($defenceMax, $newchance);
                        if($defenceMax && max($defenceMax) <= $newchance){
                            $defence = $this->setArraySkill($value); 
                        }
                    } 
                }
            }
        }
        return [$defence, $strikes];
    }

    public function fight($playerOne, $playerTwo, $turn, $turn_count){


        $player1 = ($turn == 1? $playerTwo: $playerOne);
        $player2 = ($turn == 1? $playerOne: $playerTwo);

        $skillsListP2 = $this->skills->relation($player2->id, strtolower(get_class($player2)));
        $skillsListP1 = $this->skills->relation($player2->id, strtolower(get_class($player2)));

        var_dump(strtolower(get_class($player1)));
        // var_dump($skillsList);

        $skillsSetP1 = $this->skillsStrike($skillsListP2);
        $skillsSetP2 = $this->skillsStrike($skillsListP1);

        $defenceSkillP2 = $skillsSetP1[0];
        $attackSkillP1 = $skillsSetP2[1];

        $damage = (float) abs($player2->strength - $player1->defence);
        $log = "";
        if ($player1->health <= 0 || $player2->health <= 0){
            return null;
        }
        var_dump($attackSkillP1->skill_chance);
        // while ($playerOne->health > 0 && $playerTwo->health > 0) {
        if(!$this->calculateChance($player1->luck)){
            if($attackSkillP1->skill_chance){
                $newDamage = ($damage * $attackSkillP1->skill_multiplier);
                $player1->health = $player1->health - $newDamage;
                $log = "$player2->name used skill $attackSkillP1->skill_name on $player1->name, $newDamage  damage. Health remaining ".($player1->health >= 0? $player1->health : 0)." <br>";    
            }else{
                $player1->health = $player1->health - $damage;
                $log = "$player2->name hit $player1->name, $damage damage. Health remaining ".($player1->health >= 0? $player1->health : 0)." <br>";
            }
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