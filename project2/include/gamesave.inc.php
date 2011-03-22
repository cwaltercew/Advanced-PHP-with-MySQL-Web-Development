<?php

class gameSave {
    
    private $db;
    
    public function __construct() {
        require_once('db.conf.inc.php');
        $this->db = new mysqli($dbHost, $dbUser, $dbPass, $use);
    }
    
    public function __destruct() {
        $this->db->close();
    }
    
    public function newGame($name, $difficulty) {
        
        $gameStatus = 'incomplete';
        $sql = "INSERT INTO games(name, date_played, difficulty, result) VALUES(?,NOW(),?,?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sis", $name, $difficulty, $gameStatus);
        $stmt->execute();
        
        $gameID = $stmt->insert_id;
        
        $stmt->close();
        
        return $gameID;
        
    }
    
    public function endGame($game, $result) {
                
        $sql = "UPDATE games SET result = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $result, $game);
        $stmt->execute();
        $stmt->close();
    }
    
    public function setMove($game, $move, $player, $square) {
        
        $sql = "INSERT INTO moves(game_id, move_num, player, square) VALUES(?,?,?,?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iisi", $game, $move, $player, $square);
        $stmt->execute();
        $stmt->close();
    }
     
}

?>