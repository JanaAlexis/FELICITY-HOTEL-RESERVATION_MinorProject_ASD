<?php
	require_once("config/config.php");

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$action = $_POST['action'];

		switch($action){
			case 'reserveId': getReservationId(); break;
			case 'removeId': removeReservation(); break;
			case 'recordPayment': recordPaymentData(); break;
			case 'cancel': cancelReservation(); break;
	  	}

	}else{
		echo 'Not set';
	}


	function getReservationId(){

		$reservationId = $_POST['reserveId'];

	  	 echo $reservationId;
	  

	  	$conn = mysqli_connect("localhost","root","","db_hro");
 		
		$query = "SELECT * FROM reservation_details WHERE reservationID = '$reservationId'";
		$sql = mysqli_query($conn, $query) or die(mysqli_error($conn));
		$rsvdata = mysqli_fetch_array($sql);

		$user = $_SESSION['userStatus'];
		$roomName = $rsvdata[2];

		$insertquery = "INSERT into booking_details (customerID, roomName, noOfperson, totalPrice, checkIn, checkOut, status, handledBy)VALUES('$rsvdata[1]','$rsvdata[2]','$rsvdata[5]','$rsvdata[6]','$rsvdata[3]','$rsvdata[4]','Check-in','$user')";
		$sql = mysqli_query($conn, $insertquery) or die(mysqli_error($conn));

		$deletequery = "UPDATE reservation_details SET status = 'Booked' where reservationID = '$reservationId'";
		$sql = mysqli_query($conn, $deletequery) or die(mysqli_error($conn));
	  	
		$updatequery = "UPDATE room_details SET status ='Unavailable' WHERE roomName = '$roomName'";
		$sql = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));
		
	  	echo $insertquery;

	  	//echo $sql;
	  	//echo json_encode($rsvdata);

	}

	function removeReservation(){
		$removeId = $_POST['removeId'];
		$conn = mysqli_connect("localhost","root","","db_hro");

		$query = "SELECT roomName FROM reservation_details WHERE reservationID = '$removeId'";
		$sql = mysqli_query($conn, $query) or die(mysqli_error($conn));
		$rsvdata = mysqli_fetch_array($sql);

		$roomName = $rsvdata['roomName'];

		$updatequery = "UPDATE room_details SET status ='Available' WHERE roomName = '$roomName'";
		$sql = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));

		$deletequery = "UPDATE reservation_details SET status = 'Archive' where reservationID = '$removeId'";
		$sql = mysqli_query($conn, $deletequery) or die(mysqli_error($conn));
	  	echo $deletequery;
	}
	
	function recordPaymentData(){

		$payment =$_POST['arrDetails'];
		$card =$_POST['cardDetails'];

		$conn = mysqli_connect("localhost","root","","db_hro");
		$insertquery = "INSERT INTO payment_details (paymentType, bookingRefNo, customerID, totalPrice, amountPaid)VALUES('$payment[4]','$payment[0]','$payment[1]','$payment[2]','$payment[5]')";
		$sql = mysqli_query($conn, $insertquery) or die(mysqli_error($conn));

		$updatequery = "UPDATE booking_details SET status = 'Check-out' where bookingRefNo = '$payment[0]'";
		$sql = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));

		$updatequery = "UPDATE room_details SET status = 'Available' where roomName = '$payment[3]'";
		$sql = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));

		if($payment[3]<>1){

			$query = "SELECT MAX(paymentNo) as maxNum FROM payment_details";
			$sql = mysqli_query($conn, $query) or die(mysqli_error($conn));
			$res = mysqli_fetch_array($sql);

			$insertquery = "INSERT INTO card_details (paymentNo, paymentType, cardHolderName, cardName, cardNo, refNo)VALUES('$res[0]','$payment[3]','$card[0]','$card[1]','$card[2]','$card[3]')";
			$sql = mysqli_query($conn, $insertquery) or die(mysqli_error($conn));
		}

		//echo json_encode($payment);
		echo $insertquery;
	}

	function cancelReservation(){
		$cancel = $_POST['cancel'];
		print_r($cancel);
		$conn = mysqli_connect("localhost","root","","db_hro");
		echo $cancel;

		$cancelquery = "UPDATE reservation_details SET status ='Cancelled' WHERE reservationID = '$cancel'";
		$sql = mysqli_query($conn, $cancelquery) or die(mysqli_error($conn));
		echo $cancelquery;
		
	}

	
?>