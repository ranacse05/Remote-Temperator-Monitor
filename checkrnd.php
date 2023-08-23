<?php
date_default_timezone_set('Asia/Dhaka');
if(!$file = fopen("sysrnd.log","a+"))
$file = fopen("sysrnd.log","w");

$temp = number_format($_GET['temperature'],2);
$minute =  intval(date('i'));
$time = time();

fwrite($file,"Record for ".date('Y-m-d h:i:s A',$time)." ## ".$temp."  inserted successfully\n");


?>