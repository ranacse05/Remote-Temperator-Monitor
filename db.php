<?php
class MyDB extends SQLite3 {
      function __construct() {
         //$this->open('database/tmons.sqlite3');
         $this->open('/var/www/html/tmons/database/tmons.sqlite3');
      }
   }

   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      //echo "Opened database successfully\n";
      //echo fwrite($file,"Opened database successfully\n");
   }


?>