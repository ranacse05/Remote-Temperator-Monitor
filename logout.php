<?php

session_start();
$_SESSION["name"] = '';
$_SESSION["login"] = 0;

header('Location: index.php');   

?>