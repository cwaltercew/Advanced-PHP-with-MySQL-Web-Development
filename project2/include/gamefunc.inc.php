<?php
//---------------------------------------------------------
// Game Related Processing Functions
//---------------------------------------------------------
require_once('include/gamesave.inc.php');

$gameSave = new gameSave;
    
    function StartGame($gameSave)
    {
    
	// use $_SESSION to test for game in progress
	if ((! isset($_SESSION['gGameState'])) ||
	    ($_SESSION['gGameState'] == GAME_START))
	{
	    $moveNum = 1;
	    $_SESSION['moveNum'] = $moveNum;
	    
	    $gBoard = array("","","","","","","","","");
	    $_SESSION['gBoard'] = $gBoard;
	    
	    $gameName = $_SESSION['gameName'];
	    $gDifficulty = $_SESSION['gDifficulty'];
	    $gameResult = 'Incomplete';
	    
	    // add code to save start of game here
	    $gameID = $gameSave->newGame($gameName, $gDifficulty);
	    
	    $_SESSION['gameID'] = $gameID;
	    $_SESSION['gameResult'] = $gameResult;
	}
	$_SESSION['gGameState'] = GAME_PLAY;
    }
    
    function EndGame($gameSave)
    {
	// add code to save result of game here
	if (($_SESSION['gGameState'] == GAME_WIN) ||
	    ($_SESSION['gGameState'] == GAME_OVER))
	{
	  $gameID = $_SESSION['gameID'];
	  $gameName = $_SESSION['gameName'];
	  $gDifficulty = $_SESSION['gDifficulty'];
	  $gameResult = $_SESSION['gameResult'];
	  
	  // add code to save result of game here
	  $gameSave->endGame($gameID, $gameResult);    
	  
	  $_SESSION = array();
	}
    }
    
    function CheckFull()
    {
	$gBoard = $_SESSION['gBoard'];
	
	$_SESSION['gGameState'] = GAME_OVER;
	for($iLoop = 0; $iLoop < count($gBoard); $iLoop++)
	{
	    if($gBoard[$iLoop] == "")
	    {
		$_SESSION['gGameState'] = GAME_PLAY;
		return 0;
	    }
	}
	$_SESSION['gameResult'] = 'Nobody won';
	return 1;
    }
    
    function CheckWin()
    {
	$gBoard = $_SESSION['gBoard'];
    
	    $player = 1;
	    while($player <= 2)
	    {
		    if ($player == 1)
			    $tile = "o";
		    else
			    $tile = "x";
		    if (
		    # horizontal
		    ($gBoard[0] == $tile && $gBoard[1] == $tile && $gBoard[2] == $tile) ||
		    ($gBoard[3] == $tile && $gBoard[4] == $tile && $gBoard[5] == $tile) ||
		    ($gBoard[6] == $tile && $gBoard[7] == $tile && $gBoard[8] == $tile) ||
		    # vertical
		    ($gBoard[0] == $tile && $gBoard[3] == $tile && $gBoard[6] == $tile) ||
		    ($gBoard[1] == $tile && $gBoard[4] == $tile && $gBoard[7] == $tile) ||
		    ($gBoard[2] == $tile && $gBoard[5] == $tile && $gBoard[8] == $tile) ||
		    # diagonal
		    ($gBoard[0] == $tile && $gBoard[4] == $tile && $gBoard[8] == $tile) ||
		    ($gBoard[2] == $tile && $gBoard[4] == $tile && $gBoard[6] == $tile))
		    {
			    return strtoupper($tile);
		    }
		    $player++;
	    }
	return ' ';
    }
    
    function ComputerRandomMove()
    {
	$computerMove = -1;
	$gBoard = $_SESSION['gBoard'];
	
	    srand((double) microtime() * 1000000);
	    while($computerMove == -1)
	    {
		    $test = rand(0, 8);
		    if($gBoard[$test] == "")
			    $computerMove = $test;
	    }
	if (_DEBUGGING)
	  echo 'In ComputerRandomMove() $computerMove='.$computerMove .'<br />';
      
	return $computerMove;
    }
    
    function ComputerMove()
    {
	$computerMove = -1;
	$gBoard = $_SESSION['gBoard'];
    
	    for($player = 0; $player <= 1; $player++)
	    {
		    if($player == 0)
		    {
			    $tile = "o";
		    }
		    else
		    {	
			    $tile = "x";
		    }
	    
		    if ($gBoard[0] == $tile && $gBoard[1] == $tile && $gBoard[2] == '')
			    $computerMove = 2;
	    if ($gBoard[0] == $tile && $gBoard[1] == '' && $gBoard[2] == $tile)
			    $computerMove = 1;
		    if($gBoard[0] == '' && $gBoard[1] == $tile && $gBoard[2] == $tile)
			    $computerMove = 0;
		    if($gBoard[3] == $tile && $gBoard[4] == $tile && $gBoard[5] == '')
			    $computerMove = 5;
		    if($gBoard[3] == $tile && $gBoard[4] == '' && $gBoard[5] == $tile)
			    $computerMove = 4;
		    if($gBoard[3] == '' && $gBoard[4] == $tile && $gBoard[5] == $tile)
			    $computerMove = 3;
    
		    if($gBoard[6] == $tile && $gBoard[7] == $tile && $gBoard[8] == '')
			    $computerMove = 8;
		    if($gBoard[6] == $tile && $gBoard[7] == '' && $gBoard[8] == $tile)
			    $computerMove = 7;
		    if($gBoard[6] == '' && $gBoard[7] == $tile && $gBoard[8] == $tile)
			    $computerMove = 6;
    
		    if($gBoard[0] == $tile && $gBoard[3] == $tile && $gBoard[6] == '')
			    $computerMove = 6;
		    if($gBoard[0] == $tile && $gBoard[3] == '' && $gBoard[6] == $tile)
			    $computerMove = 3;
		    if($gBoard[0] == '' && $gBoard[3] == $tile && $gBoard[6] == $tile)
			    $computerMove = 0;
    
		    if($gBoard[1] == $tile && $gBoard[4] == $tile && $gBoard[7] == '')
			    $computerMove = 7;
		    if($gBoard[1] == $tile && $gBoard[4] == '' && $gBoard[7] == $tile)
			    $computerMove = 4;
		    if($gBoard[1] == '' && $gBoard[4] == $tile && $gBoard[7] == $tile)
			    $computerMove = 1;
		    if($gBoard[2] == $tile && $gBoard[5] == $tile && $gBoard[8] == '')
			    $computerMove = 8;
		    if($gBoard[2] == $tile && $gBoard[5] == '' && $gBoard[8] == $tile)
			    $computerMove = 5;
		    if($gBoard[2] == '' && $gBoard[5] == $tile && $gBoard[8] == $tile)
			    $computerMove = 2;
    
    
		    if($gBoard[0] == $tile && $gBoard[4] == $tile && $gBoard[8] == '')
			    $computerMove = 8;
		    if($gBoard[0] == $tile && $gBoard[4] == '' && $gBoard[8] == $tile)
			    $computerMove = 4;
		    if($gBoard[0] == '' && $gBoard[4] == $tile && $gBoard[8] == $tile)
			    $computerMove = 0;
    
		    if($gBoard[2] == $tile && $gBoard[4] == $tile && $gBoard[6] == '')
			    $computerMove = 6;
		    if($gBoard[2] == $tile && $gBoard[4] == '' && $gBoard[6] == $tile)
			    $computerMove = 4;
		    if($gBoard[2] == '' && $gBoard[4] == $tile && $gBoard[6] == $tile)
			    $computerMove = 2;
       
		    if ($computerMove != -1)
			    break;
	    }
	if (_DEBUGGING)
	  echo 'In ComputerMove() $computerMove='.$computerMove .'<br />';
      
	return $computerMove;
    }
    
    function DrawBoard()
    {
	$gBoard = $_SESSION['gBoard'];
    
	// Start the table
	print '<table border=0 cellpadding=0 cellspacing=0>';
    
	$iLoop = 0;
	for($iRow = 0; $iRow < 5; $iRow++)
	{
	    print "<tr>\n";
	    for($iCol = 0; $iCol < 5; $iCol++)
	    {
		if($iRow == 1 || $iRow == 3)
		{
		    print "<td width=\"12\" height=\"5\" align=\"center\" valign=\"middle\" bgcolor=\"#000000\">&nbsp;</td>\n";
		}
		else
		{
		    if($iCol == 1 || $iCol == 3)
		    {
			print "<td width=\"12\" height=\"115\" align=\"center\" valign=\"middle\" bgcolor=\"#000000\">&nbsp;</td>\n";
		    }
		    else
		    {
			print "<td width=\"115\" height=\"115\" align=\"center\" valign=\"middle\">";
    
			if($gBoard[$iLoop] == "x")
			{
			    print '<img src="'. X_IMAGE .'">';
			}
			elseif($gBoard[$iLoop] == "o")
			{
			    print '<img src="'. O_IMAGE .'">';
			}
			else
			{
			    print '<input type="submit" name="btnMove" value="'. $iLoop .'">';
			}
			print "</td>\n";
			$iLoop++;
		    }
		}
		
	    }
	    print "</tr>\n";
	}
    
	// End the table
	print "</table>";
    }
    
    function Render($gameSave)
    {
	$gBoard = $_SESSION['gBoard'];
	$gGameState = $_SESSION['gGameState'];
	$gDifficulty = $_SESSION['gDifficulty'];
	$gameID = $_SESSION['gameID'];
	$moveNum = $_SESSION['moveNum'];
	
	if (_DEBUGGING)
	  print 'In Render() GameState='. $gGameState .'<br />';
	
	switch($gGameState)
	{
	    case GAME_PLAY:
	    {
		// Get the move if the user made one
		if (isset($_POST['btnMove']))
		{
		   $loc = (int) $_POST['btnMove'];
		   $gBoard[$loc] = "x";
		   $_SESSION['gBoard'] = $gBoard;
		   if (_DEBUGGING){
		     print 'In Render() X move ';
		     print_r($gBoard);
		     echo '<br />';
		   }
    
		   // add code to save Your move here
		   $gameSave->setMove($gameID, $moveNum, 'X', $loc);
    
		   
		   $_SESSION['moveNum'] = ++$moveNum;
		}
    
		// Check for a win
		if(CheckWin() == "X")
		{
		    $_SESSION['gGameState'] = GAME_WIN;
		    $_SESSION['gameResult'] = 'X won';
		    Render($gameSave);
		    return;
		}
    
		// Check to see if the board is full
		if(CheckFull() == 1)
		{
		    $_SESSION['gGameState'] = GAME_OVER;
		    $_SESSION['gameResult'] = 'Nobody won';
		    Render($gameSave);
		    return;
		}
		// Compute the computers move if we can still move
		if ($gGameState == GAME_PLAY && isset($_POST['btnMove']))
		{
		    if ($gDifficulty == 1)
		    {
			$computerMove = ComputerRandomMove();
		    }
		    elseif ($gDifficulty == 2)
		    {
			$computerMove = ComputerMove();
			if ($computerMove == -1)
			{
			    $computerMove = ComputerRandomMove();
			}
		    }
		    elseif ($gDifficulty == 3)
		    {
			$computerMove = ComputerMove();
			    if ($computerMove == -1)
			    {
				    if($gBoard[4] == '')
					$computerMove = 4;
				    elseif($gBoard[0] == '')
					    $computerMove = 0;
				    elseif($gBoard[2] == '')
					    $computerMove = 2;
				    elseif($gBoard[6] == '')
					    $computerMove = 6;
				    elseif($gBoard[8] == '')
					    $computerMove = 8;
		      
				    if ($computerMove == -1)
				$computerMove = ComputerRandomMove();
			    }
		    }
		    else
		    {
			$computerMove = ComputerRandomMove();
		    }
		    if (_DEBUGGING)
		      echo 'In Render() $computerMove='.$computerMove .'<br />';
		    
		    $gBoard[$computerMove] = "o";
		    $_SESSION['gBoard'] = $gBoard;
		    if (_DEBUGGING) {
		      print 'In Render() O move ';
		      print_r($gBoard);
		      echo '<br />';
		    }
		    $moveNum = $_SESSION['moveNum'];
		    
		    // add code to save Computer move here
		    $gameSave->setMove($gameID, $moveNum, 'O', $computerMove);
		    
		    $_SESSION['moveNum'] = ++$moveNum;
		}
		// Check for a win
		if(CheckWin() == "O")
		{
		    $_SESSION['gGameState'] = GAME_OVER;
		    $_SESSION['gameResult'] = 'O won';
		    Render($gameSave);
		    return;
		}
    
		// Check to see if the board is full
		if(CheckFull() == 1)
		{
		    $_SESSION['gGameState'] = GAME_OVER;
		    $_SESSION['gameResult'] = 'Nobody won';
		    Render();
		    return;
		}
    
		// Draw the board
		DrawBoard();
	       break;
	    }
	    case GAME_WIN:
	    {
		EndGame($gameSave);
		print '<br><br><br><img src="images/youWin.jpg" border="0">';
		break;
	    }
	    case GAME_OVER:
	    {
		EndGame($gameSave);
		print '<br><br><br><img src="images/gameOver.jpg" border="0">';
		break;
	    }
	}
    }
?>
