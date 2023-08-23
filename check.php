<?php
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

include 'functions.php';
echo 'Session Start Return:'.session_start();
//error_reporting(-1);
//ini_set('error_reporting', E_ALL);

// makes an array
$colors=array('red', 'yellow', 'blue');
// adds it to our session
$_SESSION['color']=$colors;
$_SESSION['size']='small';
$_SESSION['shape']='round';
print "Done";
print_r($_SESSION);


date_default_timezone_set('Asia/Dhaka');
if(!$file = fopen("sys.log","a+"))
$file = fopen("sys.log","w");



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

echo '<pre>';
print_r($data);
echo '</pre>';

fwrite($file,"Record for testing added\n");


?>