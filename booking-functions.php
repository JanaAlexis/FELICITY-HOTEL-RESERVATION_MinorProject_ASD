<?php
require_once("config/config.php");

if($_SERVER['REQUEST_METHOD']=='POST'){
	$action = $_GET['action'];
	//$action = 'transferIds';

	switch($action){
		case 'checkout': checkOut(); break;
  	}

}else{
	echo 'Not set';
}

function checkOut(){
	$bookingrefno = $_POST['bookingrefno'];
	$custid = $_POST['customerID'];
	$firstname = $_POST['fname1'];
	$lastname = $_POST['lname1'];

	$amount = $_POST['amount'];
	$chname = $_POST['chName'];
	$cname = $_POST['cName'];
	$cnum = $_POST['cNum'];
	$refnum = $_POST['refNum'];
	$payDate = $_POST['paymentDate'];

	echo $payDate;

}


?>