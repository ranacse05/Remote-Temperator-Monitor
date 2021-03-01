<?php

date_default_timezone_set('Asia/Dhaka');

require_once 'db.php';


  $results= $db->query("select * from hours order by timestamp DESC");
  
?>
<table cellspacing="0" border="1" cellpadding="0">
  <thead>
    <tr>
      <td>Date</td>
      <td>Hour</td>
      <td>Temperautre</td>
      <td>Time</td>
    </tr>
<?php

  while ($res= $results->fetchArray())
  {
   echo "<tr>
      <td>".$res['date']."</td>
      <td>".$res['hour']."</td>
      <td>".$res['temp']."</td>
      <td>".date('Y-m-d h:i:s a',$res['timestamp'])."</td>

    </tr>";
  }
 $db->close();
   unset($db);
?>

  </thead>
</table>