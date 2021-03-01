<?php

require_once 'db.php';
  $data= array();

  $results= $db->query("select minutes,temp,time_stamp from minutes order by time_stamp desc limit 1");
  $data= array();

  while ($res= $results->fetchArray())
  {
    //print_r($res);
    $temp = array();
    $temp[]  = $res['minutes'];
    $temp[] = $res['temp'];
    $temp[] = $res['time_stamp'];

    array_push($data, $temp);    
  }

  $results= $db->query("select minutes,temp,time_stamp from minutes2 order by time_stamp desc limit 1");

  while ($res= $results->fetchArray())
  {
    //print_r($res);
    $temp = array();
    $temp[]  = $res['minutes'];
    $temp[] = $res['temp'];
    $temp[] = $res['time_stamp'];

    array_push($data, $temp);    
  }


echo json_encode($data);


   $db->close();
   unset($db);
  ?>