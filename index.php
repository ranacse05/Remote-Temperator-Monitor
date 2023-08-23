<?php
session_start();
require_once 'db.php';
//echo '<pre>';


if($_SESSION['login']==1)
	 header('Location: home.php');   

if(isset($_POST['email'])){
	//print_r($_POST);
	$error = 0;
	$email = $_POST['email'];
    $password = hash('sha512', $_POST['password']);
	$sql ='SELECT * from users where email="'.$_POST["email"].'";';

	//echo $sql;

   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
   	//print_r($row);
      $id=$row['id'];
      $username=$row["name"];
      $pass=$row['password'];
  }
    if ($id!=""){
        if ($password==$pass){
           $_SESSION["name"] = $username;
           $_SESSION["login"] = 1;

           header('Location: home.php');    
        }else{
          $error = 1;
          $str = "Wrong Email address or Password";
        }
      }else{
      	$error = 1;
       $str =  "User not exist, please register to continue!";
      }

}

//echo '</pre>';

$db->close();
unset($db);


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[tmons] - Login</title>
	<link rel="shortcut icon" href="/favicon.ico?v=1" type="image/x-icon">
	<link rel="icon" href="/favicon.ico?v=1" type="image/x-icon">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	
	<div class="row">
		<?php if($error==1){ ?>
		<div class="row">
			<div class="col-lg-4 col-md-offset-4">
				<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> <?php echo $str;?><a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a></div>
				</div>
			</div><!--/.row-->	
		<?php } ?>
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<img src="images/logo.png?v=1" width='380' style='padding:10px 40px'>
				<div class="panel-heading">Temperature Monitoring System 
					
				</div>
				<div class="panel-body" style="font-family: courier" align="center">
					<form role="form" id="form" action="index.php" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<input type='submit' id='login' value="Login" class="btn btn-primary" /></fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
