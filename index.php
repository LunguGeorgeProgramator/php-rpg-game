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



$palyerOne = new Player($engine->setAtrributes($player->find(1)));
// echo $player->find(1)->name;
// var_dump($player->find(1));
// var_dump($opponent->all());
$palyerTwo = new Opponent($engine->setAtrributes($opponent->find(1)));

echo "My hero <br>";
echo "name $palyerOne->name <br>";
echo "level $palyerOne->level <br>";
echo "health $palyerOne->health <br>";
echo "strength $palyerOne->strength <br>";
echo "defence $palyerOne->defence <br>";
echo "speed $palyerOne->speed <br>";
echo "luck $palyerOne->luck% <br>";
echo "<br>";
echo "Monster <br>";
echo "name $palyerTwo->name <br>";
echo "level $palyerTwo->level <br>";
echo "health $palyerTwo->health <br>";
echo "strength $palyerTwo->strength <br>";
echo "defence $palyerTwo->defence <br>";
echo "speed $palyerTwo->speed <br>";
echo "luck $palyerTwo->luck% <br>";
echo "<br>";



