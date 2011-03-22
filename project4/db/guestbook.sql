-- set up the Guestbook database and tables
drop database if exists guestbook;
create database guestbook;
use guestbook;
--
drop table if exists guestbook;
create table guestbook
( entry_id    integer      not null auto_increment
, name        varchar(40)  null
, location    varchar(40)  null
, email       varchar(100) not null
, url         varchar(100) null
, comments    text         null
, created     timestamp
, remote_addr varchar(20)  null
, primary key (entry_id)
, unique (email)
);
--
drop table if exists guestbook_admin;
create table guestbook_admin
( username varchar(20) not null
, password varchar(50) not null
, primary key (username)
);
--
insert into guestbook_admin (username, password)
  values ('admin',sha1('password'))
;

