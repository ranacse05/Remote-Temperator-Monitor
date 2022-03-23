<?php
 //ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

require_once 'db.php';

   
    $no = $_REQUEST['no'];
    $value = $_REQUEST['value'];

    //echo $no.'-value from server-'.$value;
    //print_r($_POST);

    if($no==1)
       { 
           $sql = 'UPDATE settings set status1="'.$value.'"';
           $select = "Select status1 from settings";
        }   
	else
        {
            $sql = 'UPDATE settings set status2="'.$value.'"';
            $select = "Select status2 from settings";
        }

   $ret = $db->exec($sql);

   if(!$ret) {
      //echo $db->lastErrorMsg();
      fwrite($file,$db->lastErrorMsg());
      if($db->lastErrorMsg()=='database is locked')
      $db->exec('PRAGMA journal_mode = wal;');

   } 

   $results= $db->query($select);

   $data= array();
 
   $res= $results->fetchArray();
   if($no==1)
    $data = $res['status1'];
    else
    $data = $res['status2'];

   echo json_encode($data);

   $db->close();
   unset($db);
  ?>