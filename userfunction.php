<?php
	include_once('config/config.php');
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        switch($_GET["action"]){

		 case "update":
                    //Get records from edit record modal
		 			$bookingrefno = $_POST['bookingrefno'];
		 			$firstname = $_POST['firstName'];
                   	$lastname = $_POST['lastName'];
                   	$email  = $_POST['email'];
		 			$roomname = $_POST['roomName'];
                   	$roomtype = $_POST['roomType'];
                   	$roomprice  = $_POST['roomPrice'];
                    $addpersonprice  = $_POST['addPersonPrice'];
                    $numperson =  $_POST['numPersons'];
                    $checkin  = $_POST['checkIn'];
                    $checkout  = $_POST['checkOut'];
                    $expectedperson  = $_POST['expectedPerson'];
                    
                    
      				
                   $query = "SELECT checkOut, expectedPerson FROM bookingRefNo ;


                    $sql = mysqli_query($conn, $query);
                    $result = mysqli_fetch_array($sql);
                    print_r($result);
   					$updatequery = UPDATE `booking_details` SET  checkIn = '$checkin', checkOut = '$checkout' WHERE bookingRefNo ='$bookingrefno';

   					$sql = mysqli_query($conn, $query);
                     echo $updatequery;
        			             
                
            break;
        
    }

}
?>