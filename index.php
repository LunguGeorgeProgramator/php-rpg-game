<LINK REL=StyleSheet HREF="custom.css" TITLE="Contemporary">
<?php
session_start();
include 'mainModel.php';
include 'database.php';
include 'hero.php';
include 'monster.php';
include 'skill.php';
include 'fightingController.php';

use Hero as Player;
use Monster as Opponent;
use Fighting as Engine;

$player = new Player;
$opponent = new Opponent;
$engine = new Engine;
// echo $player->find(1)->name;
// var_dump($player->find(1));
// var_dump($opponent->all());
// var_dump($player->all());

// var_dump($skills->relation(1, 'hero'));

if(!isset($_POST['attack'])){
    $_SESSION['array_logs'] = [];
    $_SESSION['turn_to_attack'] = 1;
    $_SESSION['turns_remaining'] = 20;
    $playerOne = new Player($engine->setAtrributes($player->find(1)));
    $playerTwo = new Opponent($engine->setAtrributes($opponent->find(1)));
    $_SESSION['playerOne'] = serialize($playerOne);
    $_SESSION['playerTwo'] = serialize($playerTwo);
    if(!$engine->checkTurn($playerOne, $playerTwo)){
        $_SESSION['turn_to_attack'] = 0;
    }
}else{
    $playerOne = unserialize($_SESSION['playerOne']);
    $playerTwo = unserialize($_SESSION['playerTwo']);
    // var_dump(strtolower(get_class($playerOne)));
    $log = $engine->fight($playerOne, $playerTwo, $_SESSION['turn_to_attack'], $_SESSION['turns_remaining']);
    if ($log[0] != null){
        if($log[1])
            $_SESSION[($_SESSION['turn_to_attack'] == 0? 'playerOne' : 'playerTwo')] = serialize($log[1]);
        if($log[2])
            $_SESSION[($_SESSION['turn_to_attack'] == 0? 'playerTwo' : 'playerOne')] = serialize($log[2]);
        array_push($_SESSION['array_logs'], $log[0]);
    }
    $_SESSION['turn_to_attack'] = ($_SESSION['turn_to_attack'] == 0 ? 1 : 0);
}
echo "Truns remaining: ". $_SESSION['turns_remaining']. "<br>";
echo "<div id='wrapper'>";
echo "<div id='first'>";
echo "My hero <br>";
echo "name $playerOne->name <br>";
echo "level $playerOne->level <br>";
echo "health $playerOne->health <br>";
echo "strength $playerOne->strength <br>";
echo "defence $playerOne->defence <br>";
echo "speed $playerOne->speed <br>";
echo "luck $playerOne->luck% <br>";
echo "<br>";
echo "</div>";
echo "<div id='second'>";
echo "Monster <br>";
echo "name $playerTwo->name <br>";
echo "level $playerTwo->level <br>";
echo "health $playerTwo->health <br>";
echo "strength $playerTwo->strength <br>";
echo "defence $playerTwo->defence <br>";
echo "speed $playerTwo->speed <br>";
echo "luck $playerTwo->luck% <br>";
echo "<br>";
echo "</div>";
echo "</div>";
?>
<div style="clear:both"></div>
    <form method="POST" style="float: left">
        <input type="submit" name="attack" value="Next turn.">
    </form>
    <form method="GET" style="float: left">
        <input type="submit" value="New battle">
    </form>
<div style="clear:both"></div>
Click this button "Next Turn" to start the battle, click it until the battle is over or the turns reach 0.
Or click the button "New Battle" for a new match.
    <h2>Battle logs:</h2>
<?php

foreach($_SESSION['array_logs'] as $log){
    echo $log;
}

?>


