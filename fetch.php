<?php

require_once 'db.php';

  $results= $db->query("select minutes,temp,time_stamp from minutes order by minutes asc");

  //$results= $db->query("select avg(temp) from minutes");

  //print_r($results);
  //exit();
  $data= array();


  while ($res= $results->fetchArray())
  {
    //print_r($res);
    $temp = array();
    $temp[]  = $res['minutes'];
    $temp[] = $res['temp'];
   
    array_push($data, $temp);    
  }
echo json_encode($data);


   $db->close();
   unset($db);
  ?>