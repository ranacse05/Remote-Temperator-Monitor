<?php 
	 require_once 'db.php';
   date_default_timezone_set('Asia/Dhaka');
   if(!$file = fopen("sys.log","a+"))
   $file = fopen("sys.log","w");
  	
	
	$temp = number_format($_GET['temperature'],2)-2;
	$minute =  intval(date('i'));
	$time = time();
  $server = $_GET['server'];

    $sql = 'UPDATE minutes set time_stamp="'.$time.'", temp="'.$temp.'" where minutes="'.$minute.'"';
	
	//fwrite($file,$sql."\n");

   $ret = $db->exec($sql);
   if(!$ret) {
      //echo $db->lastErrorMsg();
      fwrite($file,$db->lastErrorMsg());
      if($db->lastErrorMsg()=='database is locked')
      $db->exec('PRAGMA journal_mode = wal;');

   } else {
      //echo ;
      fwrite($file,"Record for {$minute} updated {$temp} successfully\n");
   }

   if($minute==59)
   {
        $avg = 0.0 ; 
        $results= $db->query("select avg(temp) from minutes");
        while ($res= $results->fetchArray())
           {
            $avg =number_format($res[0],2) ;
           }

   $sql = 'INSERT into hours (`date`,`hour`,`temp`,`timestamp`) values ("'.date('Y-m-d',$time).'","'.date('H',$time).'",'.$avg.',"'.$time.'")';
      
   $ret = $db->exec($sql);
      if(!$ret) {
         
         fwrite($file,$db->lastErrorMsg());
         if($db->lastErrorMsg()=='database is locked')
         $db->exec('PRAGMA journal_mode = wal;');

      } else {
         //echo ;
         fwrite($file,"Record for ".date('Y-m-d',$time).'/'.date('H',$time)." inserted successfully\n");
      }

   }


   $db->close();
   unset($db);

   fclose($file);

  
?>
