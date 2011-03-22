<?php

require_once('include/displayfunc.inc.php');
require_once('include/replay.inc.php');

if($_POST['move'] == $_POST['maxMoves'] && $_POST['move'] <> '') {
    $_POST = array();
}

extract($_POST);

if(isset($gameName) && isset($gameID)) {
    if($gameName <> '' && $gameID == '') {
       $gameID = getGameID($gameName);
    } elseif($gameID <> '' && $gameName == '') {
       $gameName = getGameName($gameID);
    }  
}

if(isset($gameID) && $gameID != '') {
    
    if($move == '') {
        $button = 'Next Move';
        $move = 0;
        $maxMoves = getMaxMoves($gameID);
    }
    $move = $move + 1;
    $board = getBoard($gameID, $move);
    if($move == $maxMoves) {
        $button = getWinner($gameID);
    }
} else {
    $button = 'Load Game';
}

?>

<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
       <title>Tic-Tac-Toe Replay</title>
       <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

<form action="replay.php" method="post">
	<?php WriteTableHeader(); ?>
		<div align="center">
        <p>Game Name:
          <input type="text" name="gameName" value="<?php print $gameName; ?>">
          Game ID:
          <input name="gameID" value="<?php print $gameID; ?>">
        </p>
        <input type="hidden" name="move" value="<?php print $move; ?>">
        <input type="hidden" name="maxMoves" value="<?php print $maxMoves; ?>">
        <input type="submit" name="button" value="<?php print $button; ?>">

        <?php
            // Render the game
            drawBoard($board);
        ?>
	</div>
	<?php WriteTableFooter(); ?>
</form>
</body>
</html>