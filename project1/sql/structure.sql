-- Database: `phplogin` 
-- Create tables in your database on the class server

CREATE TABLE sessions (
  session varchar(32) NOT NULL default '',
  user_id int(11) NOT NULL default '0',
  user_name varchar(15) NOT NULL default '',
  PRIMARY KEY  (session)
) TYPE=InnoDB;

CREATE TABLE users (
  user_id int(11) NOT NULL auto_increment,
  user_name varchar(15) NOT NULL default '',
  user_pass varchar(40) NOT NULL default '',
  PRIMARY KEY  (user_id)
) TYPE=InnoDB AUTO_INCREMENT=2 ;

ALTER TABLE sessions ADD FOREIGN KEY (user_id) REFERENCES users (user_id);

INSERT INTO users VALUES (1, 'test', SHA1('pass'));