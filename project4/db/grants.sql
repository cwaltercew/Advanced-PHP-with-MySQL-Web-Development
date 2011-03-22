-- grant just the privileges needed to web DB user
grant delete, insert, select, update
  on guestbook.*
  to dbuser@localhost identified by 'password'
;

