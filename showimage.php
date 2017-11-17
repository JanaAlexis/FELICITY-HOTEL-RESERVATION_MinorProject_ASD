<?php
include_once('config/config.php');

if(isset($_GET['msg'])){

	$id = $_GET['msg'];
		$sql = "SELECT imgType, imgData FROM room_details WHERE roomID = '$id'"; 
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

		$row = mysqli_fetch_assoc($result);
		header("Content-type: " . $row['imgType']);
		//header("Content-type: image/jpg");
		echo $row['imgData'];
		
}else{

	echo "Cannot load image.";
}

?>
