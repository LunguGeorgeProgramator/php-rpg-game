<?php
include 'database.php';
include 'hero.php';
include 'monster.php';
include 'fightingController.php';

use Hero as Player;
use Monster as Opponent;
use Fighting as Engine;

$player = new Player;
$opponent = new Opponent;
$engine = new Engine;



$playerOne = new Player($engine->setAtrributes($player->find(1)));
// echo $player->find(1)->name;
// var_dump($player->find(1));
// var_dump($opponent->all());
$playerTwo = new Opponent($engine->setAtrributes($opponent->find(1)));

echo "My hero <br>";
echo "name $playerOne->name <br>";
echo "level $playerOne->level <br>";
echo "health $playerOne->health <br>";
echo "strength $playerOne->strength <br>";
echo "defence $playerOne->defence <br>";
echo "speed $playerOne->speed <br>";
echo "luck $playerOne->luck% <br>";
echo "<br>";
echo "Monster <br>";
echo "name $playerTwo->name <br>";
echo "level $playerTwo->level <br>";
echo "health $playerTwo->health <br>";
echo "strength $playerTwo->strength <br>";
echo "defence $playerTwo->defence <br>";
echo "speed $playerTwo->speed <br>";
echo "luck $playerTwo->luck% <br>";
echo "<br>";

echo (20 / 100) * 100;

$engine->fight($playerOne, $playerTwo);
// var_dump($player->all());



// var_dump($engine->calculateChance($playerOne->luck));
// var_dump($engine->calculateChance($playerTwo->luck));

// $rand1 = rand(0, 20);
// $rand2 = rand(0, 100);

// if ($rand1 >= $rand2){
//     echo "misss success $rand1 $rand2";
// }else{
//     echo "no miss $rand1 $rand2";
// }


