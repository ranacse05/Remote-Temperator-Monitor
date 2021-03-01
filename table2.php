<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
require_once 'db.php';
if($_SESSION['login']!=1)
    header('Location: index.php');  
  $results= $db->query("select * from minutes2 order by time_stamp DESC");
  
?>
<table cellspacing="0" border="1" cellpadding="0">
  <thead>
    <tr>
      <td>Minute</td>
      <td>Temperautre</td>
      <td>Time</td>
    </tr>
<?php

  while ($res= $results->fetchArray())
  {
   echo "<tr>
      <td>".$res['minutes']."</td>
      <td>".$res['temp']."</td>
      <td>".date('Y-m-d h:i:s a',$res['time_stamp'])."</td>

    </tr>";
  }

 $db->close();
   unset($db);
?>

  </thead>
</table>