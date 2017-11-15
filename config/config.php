<?php

 session_start();
 
 define("DBHOST","localhost");
 define("DBUSERNAME","root");
 define("DBPASSWORD","");
 define("DBNAME","db_hro");
 //define ("ROOT",$_SERVER['DOCUMENT_ROOT'].'/felicity/');
 
date_default_timezone_set("Asia/Manila");

 $conn = mysqli_connect(DBHOST,DBUSERNAME,DBPASSWORD); 
 //or die(mysql_error());
 mysqli_select_db($conn, DBNAME);

?>