<?php 
require_once 'db.php';

    $temp1 = $_POST['temp1'];
    $temp2 = $_POST['temp2'];
    $number1 = $_POST['number1'];
    $number2 = $_POST['number2'];

    //echo $no.'-value from server-'.$value;
    //print_r($_POST);

    $sql = 'UPDATE settings set temp1="'.$temp1.'",temp2="'.$temp2.'",number1="'.$number1.'",number2="'.$number2.'"';

       
   $ret = $db->exec($sql);

   if(!$ret) {
      //echo $db->lastErrorMsg();
      fwrite($file,$db->lastErrorMsg());
      if($db->lastErrorMsg()=='database is locked')
      $db->exec('PRAGMA journal_mode = wal;');

   } 
   $select = "Select * from settings";
   $results = $db->query($select);

   $data = array();
 
   $res = $results->fetchArray();
   $data['temp1'] = $res['temp1'];
   $data['temp2'] = $res['temp2'];
   $data['number1'] = $res['number1'];
   $data['number2'] = $res['number2'];
   echo json_encode($data);

   $db->close();
   unset($db);
  ?>