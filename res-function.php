<?php
	require_once("config/config.php");

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$action = $_POST['action'];
		//$action = 'transferIds';

		switch($action){
			case 'reserveId': getReservationId(); break;
			case 'removeId': removeReservation(); break;
	  	}

	}else{
		echo 'Not set';
	}


	function getReservationId(){

		$reservationId = $_POST['reserveId'];

	  	//echo json_encode($_SESSION['resIds']);

		//$counter = 0;
	  	//$data = [];
	  
	  	$conn = mysqli_connect("localhost","root","","db_hro");
 		
		$query = "SELECT * FROM reservation_details WHERE reservationID = '$reservationId'";
		$sql = mysqli_query($conn, $query) or die(mysqli_error($conn));
		$rsvdata = mysqli_fetch_array($sql);
		$user = $_SESSION['userStatus'];
		$insertquery = "INSERT into booking_details (customerID, roomID, checkIn, checkOut, noOfperson, status, handledBy)VALUES('$rsvdata[1]','$rsvdata[2]','$rsvdata[3]','$rsvdata[4]','$rsvdata[5]','In','$user')";
		$sql = mysqli_query($conn, $insertquery) or die(mysqli_error($conn));

		$deletequery = "DELETE from reservation_details where reservationID = '$reservationId'";
		$sql = mysqli_query($conn, $deletequery) or die(mysqli_error($conn));
	  	echo $deletequery;
	  	//echo $query;

	}

	function removeReservation(){
		$removeId = $_POST['removeId'];
		$conn = mysqli_connect("localhost","root","","db_hro");
		$deletequery = "DELETE from reservation_details where reservationID = '$removeId'";
		$sql = mysqli_query($conn, $deletequery) or die(mysqli_error($conn));
	  	echo $deletequery;
	}
	

?>