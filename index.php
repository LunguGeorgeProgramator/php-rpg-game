<?php
include 'database.php';
include 'hero.php';
include 'monster.php';
use Hero as Player;
use Monster as Opponent;



$player = new Player;
$opponent = new Opponent;

echo $player->find(1)->name;
foreach($player->all() as $hero){
    echo $hero->name;
}

// echo (new Player(1))->id;

?>
