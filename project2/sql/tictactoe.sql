-- Tables for saving TicTacToe game results
--
CREATE DATABASE tictactoe;
USE tictactoe;
--
CREATE TABLE games
( id INT(12) NOT NULL AUTO_INCREMENT
, name VARCHAR(20) NOT NULL
, date_played DATETIME NOT NULL
, difficulty TINYINT
, result VARCHAR(20) NOT NULL
, PRIMARY KEY(id)
);
--
CREATE TABLE moves
( game_id INT(12) NOT NULL
, move_num TINYINT NOT NULL
, player CHAR(1) NOT NULL
, square TINYINT NOT NULL
, PRIMARY KEY(game_id, move_num)
);
--
grant all on tictactoe.* to djefferson@'%';
  
