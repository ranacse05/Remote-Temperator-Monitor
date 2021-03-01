<?php
	session_start();

	if($_SESSION['login']!=1)
		header('Location: index.php');    


	date_default_timezone_set('Asia/Dhaka');

     require_once 'db.php';


   $results= $db->query("select minutes,temp from minutes order by minutes asc");

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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[tmons] Pre-paid room</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script language="javascript" type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jquery.flot.js"></script>
    <script language="javascript" type="text/javascript" src="js/jquery.flot.threshold.js"></script>
    <script language="javascript" type="text/javascript" src="js/curvedLines.js"></script>
    <script src="js/jquery.flot.tooltip.min.js"></script>

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="index.php"><img src="images/logo.png" height='30' ></a>
		
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $_SESSION['name']?></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		
		<ul class="nav menu">
			
			<li class="active"  class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Graph Data  <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="prepaid.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Pre-paid
					</a></li>
					<li class="active"><a class="" href="postpaid.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Post-paid
					</a></li>
					
				</ul>
			</li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Post-Paid</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Post-Paid Room temperature</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					
					</div>
					<div class="panel-body">
						    <div id="placeholder" style="width:98%;height:300px;"></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		
	</div>	<!--/.main-->
	
	
	<script type="text/javascript">
$(function() {
      var threshold = 22;

      function GetData() {
    $.ajaxSetup({ cache: false });

    $.ajax({
        url: "fetch.php",
        dataType: 'json',
        success: function(resp)
        {
            console.log('response:'+resp);   
            var options = {
		      legend: { show: false },
		      series: {
		      curvedLines: {active: true}
		      },
		      grid: { hoverable: true }, //important! flot.tooltip requires this
		      tooltip: {
		      show: true,
		      content: "temperature is %y.1&#8451; at %x"
		      }
		      };
		      
		      //plotting
		      $.plot($("#placeholder"),[
		      {
		      data: resp,
		      lines: { show: true,  lineWidth: 2},
		      color: "rgb(200, 20, 30)",
		      threshold: { below: threshold, color: "rgb(30, 180, 20)" },
		      curvedLines: {
		      apply: true,
		      }
		      }
		      ], options);

            setTimeout(GetData, 1000*60);  
        },
        error: function () {
            setTimeout(GetData, 1000*60);
        }
    });
}

GetData();

      });
</script>

		
</body>
</html>