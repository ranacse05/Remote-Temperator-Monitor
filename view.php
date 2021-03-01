<?php
   date_default_timezone_set('Asia/Dhaka');

     require_once 'db.php';
     
if($_SESSION['login']!=1)
    header('Location: index.php');  

   $results= $db->query("select minutes,temp,time_stamp from minutes order by minutes asc");

  //echo 'here';

  $data= array();
  $chart_data = array();
  $i=0;
  $start = $end = 0;
  
  while ($res= $results->fetchArray())
  {
    if($i==0)
      $end = $res['time_stamp'];

    $i++;

    if($i>=59)
      $start = $res['time_stamp'];

    $temp_array = array();
    $temp_array[]  = $res['minutes'];
    $temp_array[] = $res['temp'];
    
   array_push($data, $temp_array);
  }

   $db->close();
   unset($db);
  //print_r($data);
  //exit();
  //fwrite($file,json_encode($data));
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Last hour temperature data</title>
    <link href="layout.css" rel="stylesheet" type="text/css">
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="js/jquery.flot.js"></script>
    <script language="javascript" type="text/javascript" src="js/jquery.flot.threshold.js"></script>
    <script language="javascript" type="text/javascript" src="js/jquery.flot.axislabels.js"></script>
    <script type="text/javascript" src="js/curvedLines.js"></script>



 </head>
    <body>
      <h2>Showing temperature between <?php echo date("Y-m-d ha", $start);?> & <?php echo date('Y-m-d ha',$end)?></h2>

    <div id="placeholder" style="width:100%;height:300px;"></div>

<script type="text/javascript">

$(function () {
    var d1 = <?php echo json_encode($data)?>;
    var data = [];
    var threshold = 33.1;

    var options = {
    series: { curvedLines: { active: true },shadowSize: 0  },
    grid: { hoverable: false }  // <- generally activate hover
    };
    //plotting with per series adjustments
    var plot = $.plot($("#placeholder"), [
    { //series 1
        data: d1,
        color: "rgb(200, 20, 30)",
        threshold: { below: threshold, color: "rgb(30, 180, 20)" },
        lines: { show: true, lineWidth: 2 },
        hoverable: true, // <- overwrite hoverable with false               
        curvedLines: {
            apply: true  // <- set apply <- curve only this data series
        }
    }], options);

    function initData() {
    d1.forEach((number) => {data.push(number);
      //console.log('current data->'+number);
    });
}

function GetData() {
    $.ajaxSetup({ cache: false });

    $.ajax({
        url: "fetch.php",
        dataType: 'json',
        success: function(resp)
        {
            //console.log('response:'+resp);   
            var options = {
            series: { curvedLines: { active: true },shadowSize: 0  },
            grid: { hoverable: false }  // <- generally activate hover
            };
            //plotting with per series adjustments
            var plot = $.plot($("#placeholder"), [
            { //series 1
                data: resp,
                color: "rgb(200, 20, 30)",
                threshold: { below: threshold, color: "rgb(30, 180, 20)" },
                lines: { show: true, lineWidth: 2},
                hoverable: true, // <- overwrite hoverable with false               
                curvedLines: {
                    apply: true  // <- set apply <- curve only this data series
                }
            }], options);
            setTimeout(GetData, 1000*60);  
        },
        error: function () {
            setTimeout(GetData, 1000*60);
        }
    });
}

GetData();

var temp;
/*
function update(_data) {
    data.shift();
    console.log(_data);
    //temp = [_data, _data.cpu];
    data.push(temp);

    
}

    update();*/
});
</script>
 </body>
</html>
