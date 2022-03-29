<?php
	session_start();
	ini_set('display_errors', 0); //ini_set('display_startup_errors', 1); error_reporting(E_ALL);

	if($_SESSION['login']!=1)
		header('Location: index.php');    


	date_default_timezone_set('Asia/Dhaka');

     require_once 'db.php';


   $results= $db->query("select * from smslog order by timestamp desc");

  //echo 'here';

  $data= array();
  $chart_data = array();
  $i=0;
  $start = $end = 0;
  
  while ($res= $results->fetchArray())
  {
	$log_data = array();

      $log_data['number'] = $res['number'];
      $log_data['text'] = $res['text'];
      $log_data['timestamp'] = $res['timestamp'];
      $log_data['status'] = $res['status'];
     array_push($data,$log_data);
  }

   $db->close();
   unset($db);

   //echo '<pre>';
  //	print_r($data);
  // echo '</pre>';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[tmons] SMS log</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script language="javascript" type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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
					<li class=""><a class="" href="postpaid.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Post-paid
					</a></li>
                    <li class=""><a class="" href="settings.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Settings
					</a></li>
                    <li class="active"><a class="" href="smslog.php">
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
				<li class="active">Post-Paid</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Settings</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					
					</div>
					<div class="panel-body">
						    <div id="placeholder" style="width:98%;height:300px;">
                            
                            <table cellborder='1' cellspace='1'>
                                <tr>
                                    <td width='150'><b>Number</b></td>
                                    <td width='500'><b>SMS Containt</b></td>
                                    <td width='100'><b>Status</b></td>
                                    <td width='200'><b>Time</b></td>
                                </tr>
                               <?php foreach($data as $d) {
								 	//print_r($d);  
									 $time  = (int) $d['timestamp'];
								   ?>
                                <tr>
                                    <td width='150'><?php echo $d['number']?></td>
                                    <td><?php echo urldecode($d['text']) ?></td>
                                    <td><?php echo $d['status']?></td>
                                    <td><?php echo date('Y-m-d H:i:s a',$time)?></td>
                                </tr>
                                
                                <?php } ?>
                            </table>

                            </div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		
	</div>	<!--/.main-->
	<style>
		.hidden {display:none}
		.show {display:block}
		#temp1,#temp2,#number1,#number2,#edit {display:none}
		table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
	</style>
	
	<script type="text/javascript">

    </script>

		
</body>
</html>