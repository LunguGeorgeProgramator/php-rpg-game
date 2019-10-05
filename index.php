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

// echo $player->find(1)->name;
var_dump($player->find(1));

var_dump($opponent->find(1));

// var_dump($player->all());
// foreach($player->all() as $hero){
//     echo $hero->name;
// }

// echo (new Player(1))->id;

?>
