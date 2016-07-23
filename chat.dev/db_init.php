<?php
 $host="host=127.0.0.1";
 $port="port=5432";
 $dbname="dbname=database1";
 $cred="user=recon_qss password=recon_qss"; //pgsql pgsql
 echo "Connect\n"; 
 $db = pg_connect( "$host $port $dbname $cred" );
 echo "Postgres connected call</br>"; 
 if (!$db) {
  echo "Error: Unable to open database</br>";
 } else {
  echo "Opened database successfully</br>";
 }
 $sql =<<<EOF
  DROP TABLE IF EXISTS login;                    
  CREATE TABLE login (
   id SERIAL,
   username CHAR(30) NOT NULL,
   password CHAR(30) NOT NULL
  );
 
  DROP TABLE IF EXISTS login_sessions;
  CREATE TABLE login_sessions (
   id SERIAL,
   username CHAR(30) NOT NULL
  );

  DROP TABLE IF EXISTS msgs;
  CREATE TABLE msgs (
   id SERIAL,
   username CHAR(30) NOT NULL,
   msg CHAR(256) NOT NULL,
   modtime timestamp DEFAULT current_timestamp
  );
EOF;

 $ret = pg_query($db, $sql);
 if (!$ret){
  echo pg_last_error($db);
 } else {
  echo "Table created successfully</br>";
 }

 $sql =<<<EOF
  INSERT INTO login (username, password)
  VALUES ('erik', 'erik');
  INSERT INTO login (username, password)
  VALUES ('all1', 'all1');
  INSERT INTO login (username, password)
  VALUES ('nana', 'nana');
  INSERT INTO login (username, password)
  VALUES ('all', 'all');
EOF;

 $ret = pg_query($db, $sql);
 if (!$ret){
  echo pg_last_error($db);
 } else {
  echo "Record inserted successfully</br>";
 }

 $sql=<<<EOF
  UPDATE login set password='erik1' where username='erik';
EOF;
 
 $ret = pg_query($db, $sql);
 if (!$ret){
  echo pg_last_error($db);
 } else {
  echo "Record updated </br>";
 }

$sql=<<<EOF
 SELECT * from login;
EOF;

$ret = pg_query($db, $sql);
 if (!$ret){
  echo pg_last_error($db);
 } else {
  echo "Record selected </br>";
 }

 while($row = pg_fetch_row($ret)){
  echo "id = ".$row[0]. "</br>";
  echo "username = ".$row[1]. "</br>";
  echo "password = ".$row[2]. "</br>";
 }
 echo "operation done successfully</br>";

 $ret = pg_query($db, $sql);
 if (!$ret){
  echo pg_last_error($db);
 } else {
  echo "Record selected </br>";
 }


 while($row = pg_fetch_assoc($ret)){

  echo "id = ".$row['id']. "</br>";
  echo "username = ".$row['username']. "</br>";
  echo "password = ".$row['password']. "</br>";
 }
 echo "operation done successfully</br>";
 
 $sql =<<<EOF
  DELETE from login where id=2;
EOF;

 $ret = pg_query($db, $sql);
  if (!$ret){
   echo pg_last_error($db);
  } else {
   echo "Record deleted </br>";
  }

 pg_close($db);
  

?>
