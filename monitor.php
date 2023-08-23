<?php 
   include 'functions.php';

   //ini_set('display_errors', 1);
   //ini_set('display_startup_errors', 1);
   //error_reporting(E_ALL);

   date_default_timezone_set('Asia/Dhaka');
   if(!$file = fopen("sys.log","a+"))
   $file = fopen("sys.log","w");

	$temp = number_format($_GET['temperature'],2);
	$minute =  intval(date('i'));
	$time = time();
   $chipId = $_GET['chipId'];

   $server_no = 0;

   if($chipId == "2dcfab")
      $server_no = 1;

   //echo $server_no.'->'.$temp.'->'.$chipId;
   //exit();

   if($minute==0)
   {
      $url = "https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/23.7740004%2C%2090.4276922?/2022-03-17T".date('H').":00:00&unitGroup=metric&key=Z6SNVEG7JTYQU52LBQULPV3LJ&contentType=json&include=current";
      $data = file_get_contents($url);
      $raw = json_decode($data);
      $sql = 'UPDATE minutes set outdoor="'.$raw->currentConditions->temp.'"';
      $ret = $db->exec($sql);
      $sql = 'UPDATE minutes2 set outdoor="'.$raw->currentConditions->temp.'"';
      $ret = $db->exec($sql);
   }


   if($server_no)
      $sql = 'UPDATE minutes set time_stamp="'.$time.'", temp="'.$temp.'" where minutes="'.$minute.'"';
	else
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
      fwrite($file,"Record for {$minute} updated {$temp} successfully for {$server_no}\n");
   }

   if($minute==59)
   {
        $avg = 0.0 ; 

        if($server_no)
            $results = $db->query("select avg(temp) from minutes");
        else
            $results = $db->query("select avg(temp) from minutes2");

        while ($res= $results->fetchArray())
           {
            $avg =number_format($res[0],2) ;
           }

   if($server_no)        
      $sql = 'INSERT into hours (`date`,`hour`,`temp`,`timestamp`) values ("'.date('Y-m-d',$time).'","'.date('H',$time).'",'.$avg.',"'.$time.'")';
   else
      $sql = 'INSERT into hours2 (`date`,`hour`,`temp`,`timestamp`) values ("'.date('Y-m-d',$time).'","'.date('H',$time).'",'.$avg.',"'.$time.'")';

   $ret = $db->exec($sql);
      if(!$ret) {
         fwrite($file,$db->lastErrorMsg());
         if($db->lastErrorMsg()=='database is locked')
         $db->exec('PRAGMA journal_mode = wal;');

      } else {
         //echo ;
         fwrite($file,"Record for ".date('Y-m-d',$time).'/'.date('H',$time)." inserted successfully on {$server_no}\n");
      }

   }

   $select = "Select * from settings";
   $results1= $db->query($select); 
   $res1 = $results1->fetchArray();
   
   if($temp>=$res1['temp1'] && $res1['status1']==1)
   {
      if(!$file2 = fopen("sms.log","a+"))
      $file2 = fopen("sms.log","w");

      $minute_range = '';

      for($i=0;$i<5;$i++){
         if($minute_range!='')
         $minute_range.= ',';
         $mit_ran = ($minute-$i);
         if($mit_ran<0)
         $mit_ran = 60+$mit_ran; 
         $minute_range .= strval($mit_ran);
      }
 
      if($server_no)  
         $sql = "select * from minutes where minutes in (".$minute_range.") order by minutes";
      else
          $sql = "select * from minutes2 where minutes in (".$minute_range.") order by minutes";   
      //echo $sql;
      $results= $db->query($sql);
      $data= array();
      $sms_text = '';

      while ($res= $results->fetchArray())
      {
      
         //print_r($res);
         if($sms_text==''){
            $sms_text .= 'Outdoor temp '.$res['outdoor'];
            
            if($server_no)  
               $sms_text .= " Pre-paid Room\n";
            else
               $sms_text .= " Post-paid Room\n";
         }
         
         $sms_text .= $res['minutes'].'-'.$res['temp']."\n";    
      }
      //echo $sms_text;

      send_text( $res1['number1'],$sms_text);

         if($temp>=$res1['temp2'] && $res1['status2']==1){
            send_text( $res1['number2'],$sms_text);
         }
   }


   $db->close();
   unset($db);
   fclose($file);

  
?>
