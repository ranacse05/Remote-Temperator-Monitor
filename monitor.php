<?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

	 require_once 'db.php';
   date_default_timezone_set('Asia/Dhaka');
   if(!$file = fopen("sys.log","a+"))
   $file = fopen("sys.log","w");
  	

   
  //https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/23.830931%2C%2090.417709?unitGroup=metric&key=Z6SNVEG7JTYQU52LBQULPV3LJ&contentType=json

	$temp = number_format($_GET['temperature']-1.5,2);
	$minute =  intval(date('i'));
	$time = time();
   $server = $_GET['server'];
   
   $select = "Select * from settings";
   $results1= $db->query($select); 
   $res1 = $results1->fetchArray();

   if($temp>=27 && $res1['status1']==1)
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
 

      $sql = "select * from minutes where minutes in (".$minute_range.") order by minutes";
      //echo $sql;
      $results= $db->query($sql);
      $data= array();
      $sms_text = '';

      while ($res= $results->fetchArray())
      {
      
         //print_r($res);
         if($sms_text==''){
            $sms_text .= 'Outdoor temp '.$res['outdoor']." Post-paid Room\n";
         }
         
         $sms_text .= $res['minutes'].'-'.$res['temp']."\n";    
      }
      //echo $sms_text;

      $sms_text = urlencode($sms_text);
      $number = $res1['number1'];
      $url = "http://bulksms1.teletalk.com.bd:8091/link_sms_send.php?op=SMS&charset=ASCII&user=datacenter&pass=aP1_dsc@Dc_D&mobile={$number}&sms={$sms_text}";
      $sms_response = file_get_contents($url);
      fwrite($file2,$sms_response);

         if($temp>=$res1['temp2'] && $res1['status2']==1){
            $number = $res1['number2'];
            $url = "http://bulksms1.teletalk.com.bd:8091/link_sms_send.php?op=SMS&charset=ASCII&user=datacenter&pass=aP1_dsc@Dc_D&mobile={$number}&sms={$sms_text}";
            $sms_response = file_get_contents($url);
            fwrite($file2,$sms_response);
         }
   }


   if($minute==0)
   {
      //$url = "https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/23.830866%2C%2090.417732?unitGroup=metric&key=Z6SNVEG7JTYQU52LBQULPV3LJ";
      
      $url = "http://dataservice.accuweather.com/currentconditions/v1/27905?apikey=XwdlbjEs0H6jIOn5A9BmJumqcvXVzkf1";
      $data = file_get_contents($url);
      $raw = json_decode($data);
      // echo 'DateTime:'.print_r($raw->days[0]->datetime);
      
      //echo '<pre>';
      //print_r($raw->currentConditions->temp);
      //echo '</pre>';
      $sql = 'UPDATE minutes set outdoor="'.$raw[0]->Temperature->Metric->Value.'"';
      $ret = $db->exec($sql);
      $sql = 'UPDATE minutes2 set outdoor="'.$raw[0]->Temperature->Metric->Value.'"';
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

        
           $outdoor_avg = 0.0 ; 
           $results= $db->query("select avg(outdoor) from minutes");
           while ($res= $results->fetchArray())
              {
               $outdoor_avg =number_format($res[0],2) ;
              }  

   $sql = 'INSERT into hours (`date`,`hour`,`temp`,`timestamp`,`outdoor`) values ("'.date('Y-m-d',$time).'","'.date('H',$time).'",'.$avg.',"'.$time.'","'.$outdoor_avg.'")';
      

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
