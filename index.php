<?php
session_start();
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
// $_SESSION['array_name'] = [];
// echo $player->find(1)->name;
// var_dump($player->find(1));
// var_dump($opponent->all());
if(!isset($_POST['attack'])){
    $_SESSION['array_logs'] = [];
    $_SESSION['turn_to_attack'] = null;
    $playerOne = new Player($engine->setAtrributes($player->find(1)));
    $playerTwo = new Opponent($engine->setAtrributes($opponent->find(1)));
    $_SESSION['playerOne'] = serialize($playerOne);
    $_SESSION['playerTwo'] = serialize($playerTwo);
}else{
    
    $postAttrPlayerOne = [];
    $postAttrPlayerTwo = [];
  

    $_SESSION['turn_to_attack'] = ($_SESSION['turn_to_attack'] == 0? 1 : 0);
    
    $playerOne = unserialize($_SESSION['playerOne']);
    $playerTwo = unserialize($_SESSION['playerTwo']);
    $log = $engine->fight($playerOne, $playerTwo, $_SESSION['turn_to_attack']);
    if ($log[0])
        if($log[1])
            $_SESSION[($_SESSION['turn_to_attack'] == 0? 'playerOne' : 'playerTwo')] = serialize($log[1]);
        if($log[2])
            $_SESSION[($_SESSION['turn_to_attack'] == 0? 'playerTwo' : 'playerOne')] = serialize($log[2]);
        array_push($_SESSION['array_logs'], $log[0]);
    // $_SESSION['array_name'] = $arrayLogs;
    var_dump($_SESSION['array_logs']);
    var_dump($_SESSION['turn_to_attack']);
}

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

// $engine->fight($playerOne, $playerTwo);
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
?>

<form method="POST">
    <input type="submit" name="attack" value="Next turn.">
</form>
<form method="GET">
    <input type="submit" value="New battle">
</form>

