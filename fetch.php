<?php
 //ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

require_once 'db.php';

  $results= $db->query("select minutes,temp,time_stamp,outdoor from minutes order by minutes asc");

  //$results= $db->query("select avg(temp) from minutes");

  //print_r($results);
  //exit();
  $data= array();
  $outdoor = array(); 

  while ($res= $results->fetchArray())
  {
    //print_r($res);
    $temp = array();
    $temp[]  = $res['minutes'];
    $temp[] = $res['temp'];
    array_push($data, $temp);    
  }

  while ($res= $results->fetchArray())
  {
   // print_r($res);
    $temp = array();
    $temp[]  = $res['minutes'];
    $temp[] = $res['outdoor'];
    array_push($outdoor, $temp);    
  }

echo json_encode(array('indoor'=>$data,'outdoor'=>$outdoor));


   $db->close();
   unset($db);
  ?>