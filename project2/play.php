<?php
  session_start();
//---------------------------------------------------------
// Tic Tac Toe
// Written by Matt Rutledge
// Revised by D.W. Jefferson - Feb 2009
// Revised by Nathan Stier - Oct 2009
//---------------------------------------------------------

//---------------------------------------------------------
// Defines
//---------------------------------------------------------

// Game States
define("GAME_START", 0);
define("GAME_PLAY", 1);
define("GAME_WIN", 2);
define("GAME_OVER", 3);

// Images
define("X_IMAGE", "images/X.gif");
define("O_IMAGE", "images/O.gif");

//---------------------------------------------------------
// "Global" variables
//---------------------------------------------------------

//---------------------------------------------------------
// Includes
//---------------------------------------------------------
require_once('include/displayfunc.inc.php');
require_once('include/gamefunc.inc.php');

// Check to see if the user is starting a new game
if(isset($_POST['btnNewGame']))
{
    EndGame($gameSave);
    if (isset($_POST['dlDifficulty']) && ($_POST['dlDifficulty'] > 0))
      $_SESSION['gDifficulty'] = $_POST['dlDifficulty'];
    else
        $_SESSION['gDifficulty'] = 2;

    if ($_POST['gameName'] != "")
        $_SESSION['gameName'] = $_POST['gameName'];
    else
        $_SESSION['gameName'] = 'Dummy';
    $_SESSION['gGameState'] = GAME_START;
    StartGame($gameSave);
}
elseif($_POST['gGameState'] == '')
{
    if ((! isset($_SESSION['gDifficulty'])) || ($_SESSION['gDifficulty'] <= 0))
        $_SESSION['gDifficulty'] = 2;
    if ($_POST['gameName'] != "")
        $_SESSION['gameName'] = $_POST['gameName'];
    else
        $_SESSION['gameName'] = 'Dummy';
    $_SESSION['gGameState'] = GAME_START;
    StartGame($gameSave);
}

?>
<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
       <title>Tic-Tac-Toe</title>
       <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

<form action="play.php" method="post">
<input type="hidden" name="gGameState" value="<?php print $_SESSION['gGameState']; ?>">
	<?php WriteTableHeader(); ?>
		<div align="center">
        <p>Name the Game:
          <input type="text" name="gameName" value="<?php print $_SESSION['gameName']; ?>">
        </p>
               <input type="submit" name="btnNewGame" value="New Game">&nbsp;&nbsp;&nbsp;
               <b>Difficulty Level</b>
               <select name="dlDifficulty">
                   <option value="1">Easy</option>
                   <option value="2" SELECTED>Normal</option>
                   <option value="3">Not-Likely</option>
               </select><br><br>

        <?php
            // Render the game
            Render($gameSave);
        ?>
	</div>
	<?php WriteTableFooter(); ?>
</form>

</body>
</html>
