<?php
require_once 'db.php';

function send_text($number,$text){
   //echo "Inside the function";
   global $db;
    if(!$file2 = fopen("sms.log","a+"))
    $file2 = fopen("sms.log","w");
   
    $select = "Select timestamp from smslog where number='".$number."' order by timestamp desc limit 1";
    //echo $select;

    $results= $db->query($select); 
    $res1 = $results->fetchArray();
    $text .= date("Y/m/d h:i a");
    $time = time();
    $text = urlencode($text);
    //echo 'Last SMS  '.$res1['timestamp'].'---Timestamp'.$time;

    $diff = $time - $res1['timestamp'];

    //echo "<br> Difference".$diff;
    if($diff>=300){
    $url = "http://bulksms1.teletalk.com.bd:8091/link_sms_send.php?op=SMS&charset=ASCII&user=datacenter&pass=aP1_dsc@Dc_D&mobile={$number}&sms={$text}";
    $sms_response = file_get_contents($url);
    fwrite($file2,$sms_response);

    $res = explode(',',$sms_response);
    $response = strip_tags($res[0]);
    $sql = 'Insert into smslog (`number`,`text`,`status`,`timestamp`) values ("'.$number.'","'.$text.'","'.$response.'","'.time().'")';
    //echo $sql;
    $ret = $db->exec($sql);
       if(!$ret) {
          fwrite($file,$db->lastErrorMsg());
          if($db->lastErrorMsg()=='database is locked')
          $db->exec('PRAGMA journal_mode = wal;');
 
       }
   }     
}


?>