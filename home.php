<?php
	session_start();
	error_reporting(E_ALL);

	if($_SESSION['login']!=1)
		header('Location: index.php');    


	date_default_timezone_set('Asia/Dhaka');

     require_once 'db.php';

     $str = "select minutes,temp,outdoor from minutes order by time_stamp desc limit 1";
    // echo $str.'<br/>';	
   $results= $db->query($str);

  //echo 'here';

  $data1= array();
  $outdoor = 0 ;
  while ($res= $results->fetchArray())
  {
        //print_r($res);

    $temp_array = array();
    $temp_array[]  = $res['minutes'];
    $temp_array[] = $res['temp'];
    $outdoor = $res['outdoor'];
   array_push($data1, $temp_array);
  }
 // echo 'Data1<br/>';
  //print_r($data1);

  $str2 = "select minutes,temp from minutes2 order by time_stamp desc limit 1";
  //echo $str2.'<br/>';	
  $results2= $db->query($str2);

  //echo 'here';

  $data2= array();
  
  while ($res2= $results2->fetchArray())
  {
    //print_r($res2);
    $temp_array2 = array();
    $temp_array2[]  = $res2['minutes'];
    $temp_array2[] = $res2['temp'];
    
   array_push($data2, $temp_array2);
  }
    //echo 'Data2<br>';
	//print_r($data2);

	$str = "select * from settings";
    // echo $str.'<br/>';	
   $results= $db->query($str);

  //echo 'here';
  $res = $results->fetchArray();
  //echo '<pre>';
  //var_dump($res);
  //echo '</pre>';
  $sms_balance = $res['sms_balance'];


   $db->close();
   unset($db);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[tmons] Home</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script language="javascript" type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script src='js/dx.all.js'></script>
    <link rel='stylesheet' href='css/dx.common.css'>
	<link rel='stylesheet' href='css/dx.light.css'>
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<style type="text/css">
		.temp {width: 340px; text-align: center;height: 40px;float: left; font-size: 25px; color:#808080 }
	</style>
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
			
			<li class="active" class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Graph Data <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="prepaid.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Pre-paid
					</a></li>
					<li><a class="" href="postpaid.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Post-paid
					</a></li>
					<li class=""><a class="" href="settings.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Settings
					</a></li>
					<li class=""><a class="" href="smslog.php">
						<span class="fa fa-arrow-right">&nbsp;</span> SMS Log
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
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					
					<div class="panel-body">
						   <div class="dx-viewport demo-container">
						   <div style='width: 400px;float: left;' class='temp'>
						   SMS Balance : <?php echo $sms_balance;?>
							</div>

						   <div style='width: 400px;float: left;' class='temp'>
						     Outdoor Temperature 
							 : <?php echo $outdoor;?>&#8451;  </div>
						  

  
					        	<div style='width: 400px;float: left;'>
					        		<div id="gauge1" style="width: 340px;height: 100%;float: left; margin-right:50px "></div>
					        		<div id='temp1' class='temp'><?php echo $data1[0][1];?>&#8451;</div>
					        	</div>
					        	<div style='width: 400px;float: left;'>
					        		<div id="gauge2" style="width: 340px;height: 100%;float: left;"></div>
					        		<div id='temp2' class='temp'><?php echo $data2[0][1];?>&#8451;</div>
					        	</div>

							
					    	</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		
	</div>	<!--/.main-->
	
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">

	var  gauge1 = '';
	var  gauge2 = '';


		$(function(){

    gauge1 = $("#gauge1").dxCircularGauge({
        scale: {
            startValue: 15,
            endValue: 45,
    		tickInterval: 5,
            label: {
                customizeText: function (arg) {
                    return arg.valueText + " &#8451;";
                }
            }
        },
        rangeContainer: {
            ranges: [
                { startValue: 15, endValue: 25, color: "#228B22" },
                { startValue: 25, endValue: 35, color: "#FFD700" },
                { startValue: 35, endValue: 45, color: "#CE2029" }
            ]
        },
        "export": {
            enabled: false
        },
        tooltip: { enabled: true },

        title: {
            text: "Post-Paid Server Room",
            font: { size: 28 }
        },
        value: <?php echo $data1[0][1];?>
    }).dxCircularGauge("instance");;



    gauge2 = $("#gauge2").dxCircularGauge({
        scale: {
            startValue: 15,
            endValue: 45,
            tickInterval: 5,
            label: {
                customizeText: function (arg) {
                    return arg.valueText + " &#8451;";
                }
            }
        },
        rangeContainer: {
            ranges: [
                { startValue: 15, endValue: 25, color: "#228B22" },
                { startValue: 25, endValue: 35, color: "#FFD700" },
                { startValue: 35, endValue: 45, color: "#CE2029" }
            ]
        },
        "export": {
            enabled: false
        },
        tooltip: { enabled: true },

        title: {
            text: "Pre-Paid Server Room",
            font: { size: 28 }
        },
        value: <?php echo $data2[0][1];?>
    }).dxCircularGauge("instance");

    update();

    function update(){
    $.ajaxSetup({ cache: false });
    console.log('update called');
    //console.log(gauge1);
    $.ajax({
        url: "ajaxhome.php",
        dataType: 'json',
        success: function(resp)
        {
          console.log(resp[0][1]+'-'+resp[1][1]);
        	gauge1.option("value",resp[0][1]);
        	gauge2.option("value",resp[1][1]);
        	$('#temp1').html(resp[0][1]+'&#8451;');
        	$('#temp2').html(resp[1][1]+'&#8451;');
        	$("#temp1").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
			$("#temp2").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);

        	setTimeout(update, 1000*60);  
        },
        error: function () {
            setTimeout(update, 1000*60);
        }

     });   
	}
});

	</script>
		
</body>
</html>