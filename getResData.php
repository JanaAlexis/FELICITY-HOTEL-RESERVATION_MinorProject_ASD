<?php
	require_once("config/config.php");

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$action = $_POST['action'];
		//$action = 'transferIds';
		switch($action){
			case 'reserveIds': getReservationDetails(); break;
			case 'checkAvailable': getAvailableRooms(); break;
			case 'confirmRes': reserveRooms(); break;
	  
		}

	}else{
		echo 'Not set';
	}

	function getAvailableRooms(){
		$checkDate = $_POST['checkIndate'];
		$data = [];
		$x = 0;

	  	$conn = mysqli_connect("localhost","root","","db_hro");
		$query = "SELECT roomName from room_details WHERE status = 'Available' UNION SELECT roomName from booking_details WHERE checkOut < '$checkDate'";

		  	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		  	while($row = mysqli_fetch_array($result)){

		  		$query1 = "SELECT roomID, roomName, r.roomType, rd.bedID, b.bedType, bedCount, noOfperson, roomPrice, addPersonPrice from room_details rd join room r on rd.roomTypeId = r.roomTypeId join beds b on rd.bedID = b.bedID WHERE roomName = '$row[0]'";
		  			$result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
		  			//$res = mysqli_fetch_array($result1);
		  		while($res = mysqli_fetch_array($result1)){
			  		$data[$x] = $res;
			  		$x++;
		  		}
		  	}
		echo json_encode($data);
	}

	function getReservationDetails(){

		$rname = $_POST['rName'];
		//sort($roomIds);
	  	//$_SESSION['resRoomIds'] = $roomIds;
	  	//$idCount = count($roomIds);
	  	$data = [];

	  	$conn = mysqli_connect("localhost","root","","db_hro");
 		
	 	
		 	$query = "SELECT roomID, roomName, r.roomType, SUM(bedCount) as bedCount, noOfperson, roomPrice, addPersonPrice from room_details rd join room r on rd.roomTypeId = r.roomTypeId WHERE roomName ='$rname' Group by roomName";
		  	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		  	if(mysqli_num_rows($result) > 0){  
		        $row = mysqli_fetch_array($result);
		        $data[0] = $row;
      		}
		
		echo json_encode($data);
	}

	function reserveRooms(){
		$resvRoom = $_POST['resvRoom'];
		$dates = $_POST['dateInfo'];
		
		$conn = mysqli_connect("localhost","root","","db_hro");

		$query = "SELECT roomPrice, noOfperson, addPersonPrice from room_details WHERE roomName ='$resvRoom' Group by roomName";
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		$totalRoomPrice = 0;
		$extraPersonCount = $row['noOfperson'] - $dates[0];
		
		if($extraPersonCount<0){
			$extraPersonCount = abs($extraPersonCount);
			$totalRoomPrice = $row['roomPrice'] + ($row['addPersonPrice'] * $extraPersonCount);
		}else{
			$totalRoomPrice = $row['roomPrice'];
		}
		
		
		$y = $_SESSION['userId'];
			$insertquery = "INSERT INTO reservation_details (customerID, roomName, checkIn, checkOut, expectedPerson, totalPrice, status) VALUES ('$y', '$resvRoom','$dates[1]','$dates[2]','$dates[0]','$totalRoomPrice','Pending')";
			$result = mysqli_query($conn, $insertquery) or die(mysqli_error($conn));

			$updatequery = "UPDATE room_details SET status ='Reserved' WHERE roomName ='$resvRoom'";
			$result = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));
		
			
		
		echo $totalRoomPrice;
	}
	

?>