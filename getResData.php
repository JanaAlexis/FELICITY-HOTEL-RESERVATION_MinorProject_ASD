<?php
	require_once("config/config.php");

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$action = $_POST['action'];
		//$action = 'transferIds';
		switch($action){
			case 'transferIds': getReservationDetails(); break;
	  
		}

	}else{
		echo 'Not set';
	}


	function getReservationDetails(){

		$roomIds = $_POST['arrayId'];
		sort($roomIds);
	  	$_SESSION['resRoomIds'] = $roomIds;
	  	//echo json_encode($_SESSION['resRoomIds']);
	  	//echo json_encode($roomIds);
	  	$idCount = count($roomIds);
	  	$data = [];
	  	$counter = 0;
	  	$x = $roomIds[$counter];

	  	$conn = mysqli_connect("localhost","root","","db_hro");
 		while($counter < $idCount){
	 	
		 	$query = "SELECT roomID, roomName, r.roomType, bedCount, noOfperson, roomPrice, addPersonPrice from room_details rd join room r on rd.roomTypeId = r.roomTypeId WHERE roomName ='$roomIds[$counter]' Group by roomName";
		  	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		  	if(mysqli_num_rows($result) > 0){  
		        $row = mysqli_fetch_array($result);
		        $data[$counter] = $row;
      		}
	      	$counter++;
		}
		
		echo json_encode($data);
	}
	

?>