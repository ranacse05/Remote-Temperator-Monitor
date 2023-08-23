<?php
	session_start();
	//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

	if($_SESSION['login']!=1)
		header('Location: index.php');    


	date_default_timezone_set('Asia/Dhaka');

     require_once 'db.php';


   $results= $db->query("select * from settings");

  //echo 'here';

  $data= array();
  $chart_data = array();
  $i=0;
  $start = $end = 0;
  
  while ($res= $results->fetchArray())
  {
      $data['temp1'] = $res['temp1'];
      $data['temp2'] = $res['temp2'];
      $data['number1'] = $res['number1'];
      $data['number2'] = $res['number2'];
      $data['status1'] = $res['status1'];
      $data['status2'] = $res['status2'];
  }


   $db->close();
   unset($db);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[tmons] Settings</title>
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
                    <li class="active"><a class="" href="settings.php">
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
                            
                            <table cellborder='0' cellspace='0'>
                                <tr>
                                    <td width='150'><div id="temp1val"><?php echo $data['temp1'];?></div>
  									<input type="text"  id="temp1" name="temp1" value="<?php echo $data['temp1'];?>" />
								</td>
                                    <td><div id="temp2val"><?php echo $data['temp2'];?></div>
									<input type="text"  id="temp2" name="temp2" value="<?php echo $data['temp2'];?>" />
								</td>
                                </tr>
                                <tr>
                                    <td><div id="number1val"><?php echo $data['number1'];?></div>
									<input type="text" id="number1" name="number1" value="<?php echo $data['number1'];?>" />
								</td>
                                    <td><div id="number2val"><?php echo $data['number2'];?></div>
									<input type="text" id="number2" name="number2" value="<?php echo $data['number2'];?>" />

								</td>
                                </tr>
                                <tr>
                                    <td><div id='sta1'><?php if($data['status1']==1) echo 'On'; else echo 'Off';?></div></td>
                                    <td><div id='sta2'><?php if($data['status2']==1) echo 'On'; else echo 'Off';?></div></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" id='switch1' onClick="update(1)" <?php if($data['status1']==1) echo 'checked';?> ></td>
                                    <td><input type="checkbox" id='switch2' onClick="update(2)" <?php if($data['status2']==1) echo 'checked';?> ></td>
                                </tr>
								<tr>
                                    <td><input type="button" onClick="show()" Value="Edit" ></td>
                                    <td><input type="button" id="edit" onClick="edit()" Value="Save" ></td>
                                </tr>
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
	</style>
	
	<script type="text/javascript">

  	function edit(){
	
	   var temp1 = $("#temp1").val();
	   var temp2 = $("#temp2").val();
	   var number1 = $("#number1").val();
	   var number2 = $("#number2").val(); 
	   //console.log(temp1+'-'+temp2+' '+number1+' '+number2);

	   
			$("#temp1").removeClass('show');
			$("#temp2").removeClass('show');
			$("#number1").removeClass('show');
			$("#number2").removeClass('show');
			$("#edit").removeClass('show');

	   $.ajaxSetup({ cache: false });

       $.ajax({
        url: "update.php",
        dataType: 'JSON',
		method: "POST",
        data: { temp1: temp1,temp2:temp2, number1: number1, number2:number2 },
        success: function(resp)
        {
            
			$("#temp1val").html(resp.temp1);
			$("#temp2val").html(resp.temp2);
			$("#number1val").html(resp.number1);
			$("#number2val").html(resp.number2);
            console.log(resp.temp1);

        },
        error: function () {
            
        }
    });
	  }

	function show(){
		console.log("Show clicked");
		$("#temp1").addClass('show');
		$("#temp2").addClass('show');
		$("#number1").addClass('show');
		$("#number2").addClass('show');
		$("#edit").addClass('show');
	}  

    function update(no) {
        var id = 'switch'+no;
        value = document.getElementById(id).checked;
        
        if(value)
         value=1;
        else
         value=0;
         console.log(no+'--'+value);

    $.ajaxSetup({ cache: false });
    $.ajax({
        url: "switch.php",
        dataType: 'json',
        data: { no: no, value: value },
        success: function(resp)
        {
            if(resp==1)
            $('#sta'+no).html("On");
            else if(resp==0)
            $('#sta'+no).html("Off");
            
            console.log(no+'--response--'+resp);
           
        },
        error: function () {
            
        }
    });
}
    </script>

		
</body>
</html>