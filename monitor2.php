<?php 
	 require_once 'db.php';
   date_default_timezone_set('Asia/Dhaka');
   if(!$file = fopen("sys2.log","a+"))
   $file = fopen("sys2.log","w");
  	
	
	$temp = number_format($_GET['temperature'],2)+5.00;
	$minute =  intval(date('i'));
	$time = time();

  $sql = 'UPDATE minutes2 set time_stamp="'.$time.'", temp="'.$temp.'" where minutes="'.$minute.'"';

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
        $results= $db->query("select avg(temp) from minutes2");
        while ($res= $results->fetchArray())
           {
            $avg =number_format($res[0],2) ;
           }

   $sql = 'INSERT into hours2 (`date`,`hour`,`temp`,`timestamp`) values ("'.date('Y-m-d',$time).'","'.date('H',$time).'",'.$avg.',"'.$time.'")';
      
   $ret = $db->exec($sql);
      if(!$ret) {
         
         fwrite($file,$db->lastErrorMsg());
         if($db->lastErrorMsg()=='database is locked')
         $db->exec('PRAGMA journal_mode = wal;');

      } else {
         //echo ;
         //fwrite($file,"Record for ".date('Y-m-d',$time).'/'.date('H',$time)." inserted successfully\n");
      }

   }


   $db->close();
   unset($db);

   fclose($file);

  
?>
