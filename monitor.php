<?php 
	 require_once 'db.php';
   date_default_timezone_set('Asia/Dhaka');
   if(!$file = fopen("sys.log","a+"))
   $file = fopen("sys.log","w");
  	

   
  //https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/23.830931%2C%2090.417709?unitGroup=metric&key=Z6SNVEG7JTYQU52LBQULPV3LJ&contentType=json

	$temp = number_format($_GET['temperature'],2);
	$minute =  intval(date('i'));
	$time = time();
   $server = $_GET['server'];


   if($minute==0)
   {
      $url = "https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/23.7740004%2C%2090.4276922?/2022-03-17T".date('H').":00:00&unitGroup=metric&key=Z6SNVEG7JTYQU52LBQULPV3LJ&contentType=json&include=current";
      $data = file_get_contents($url);
      
      $raw = json_decode($data);
      // echo 'DateTime:'.print_r($raw->days[0]->datetime);
      
      //echo '<pre>';
      //print_r($raw->currentConditions->temp);
      //echo '</pre>';
      $sql = 'UPDATE minutes set outdoor="'.$raw->currentConditions->temp.'"';
      $ret = $db->exec($sql);
      $sql = 'UPDATE minutes2 set outdoor="'.$raw->currentConditions->temp.'"';
      $ret = $db->exec($sql);

   }


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
