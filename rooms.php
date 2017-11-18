<?php
	include 'header.php';
	include 'navbar.php';
	//echo $_SESSION['userStatus'];
?>
 

<div class="container-fluid">
   <div class="col-md-12">
			<h3 id="roomtype1" align="left">Deluxe Rooms</h3>
<?php
				$query = "SELECT roomID from room_details WHERE roomTypeId = '1' Group by roomName";
				$result = mysqli_query($conn, $query);  
				if(mysqli_num_rows($result) > 0){  
					while($row = mysqli_fetch_array($result)){
						$roomId = $row['roomID'];
?>
            <div class="col-md-3 img-grid">  
                <div style="border:1px solid #333; background-color:#f1f1f1;" align="left">  
                    <img src="showimage.php?msg=<?php echo $roomId ?>" class="img-responsive" /><br />
                </div>
                <div align="right">
                	  <a href="roomdetails.php"><input type="submit" name="rd" style="margin-top:5px; border-radius: 15px 0 15px 0; background-color: black; color: yellow;" class="btn btn-success" value="Show Details" /></a>   	
                </div>    
            </div>
<?php  
	    	 }//end of while loop 
       }else{
?>
       	<script>$('#roomtype1').hide();</script>
<?php
       }
?>

	</div><!-- end deluxe -->
	<div class="col-md-12">
			<h3 id="roomtype2" align="left">Luxury Rooms</h3>
<?php
				$query = "SELECT roomID from room_details WHERE roomTypeId = '2' Group by roomName";
				$result = mysqli_query($conn, $query);  
				if(mysqli_num_rows($result) > 0){  
					while($row = mysqli_fetch_array($result)){
						$roomId = $row['roomID'];
?>
            <div class="col-md-3 img-grid">  
                <div style="border:1px solid #333; background-color:#f1f1f1;" align="left">  
                    <img src="showimage.php?msg=<?php echo $roomId ?>" class="img-responsive" /><br />
                </div>
                <div align="right">
                	  <a href="roomdetails.php"><input type="submit" name="rd" style="margin-top:5px; border-radius: 15px 0 15px 0; background-color: black; color: yellow;" class="btn btn-success" value="Show Details" /></a>   	
                </div>    
            </div>
<?php  
		    	}//end of while loop 
		    }else{
?>
       	<script>$('#roomtype2').hide();</script>
<?php
       }
?>
	</div><!-- end luxury -->
	<div class="col-md-12">
			<h3  id="roomtype3" align="left">Suite Rooms</h3>
<?php
				$query = "SELECT roomID from room_details WHERE roomTypeId = '3' Group by roomName";
				$result = mysqli_query($conn, $query);  
				if(mysqli_num_rows($result) > 0){  
					while($row = mysqli_fetch_array($result)){
						$roomId = $row['roomID'];
?>
            <div class="col-md-3 img-grid">  
                <div style="border:1px solid #333; background-color:#f1f1f1;" align="left">  
                    <img src="showimage.php?msg=<?php echo $roomId ?>" class="img-responsive" /><br />
                </div>
                <div align="right">
                	  <a href="roomdetails.php"><input type="submit" name="rd" style="margin-top:5px; border-radius: 15px 0 15px 0; background-color: black; color: yellow;" class="btn btn-success" value="Show Details" /></a>   	
                </div>    
            </div>
<?php  
		    	}//end of while loop 
		    }else{
?>
       	<script>$('#roomtype3').hide();</script>
<?php
       }
?>
	</div><!-- end suite -->
	<div class="col-md-12">
			<h3 id="roomtype4" align="left">Superior Rooms</h3>
<?php
				$query = "SELECT roomID from room_details WHERE roomTypeId = '4' Group by roomName";
				$result = mysqli_query($conn, $query);  
				if(mysqli_num_rows($result) > 0){  
					while($row = mysqli_fetch_array($result)){
						$roomId = $row['roomID'];
?>
            <div class="col-md-3 img-grid">  
                <div style="border:1px solid #333; background-color:#f1f1f1;" align="left">  
                    <img src="showimage.php?msg=<?php echo $roomId ?>" class="img-responsive" /><br />
                </div>
                <div align="right">
                	  <a href="roomdetails.php"><input type="submit" name="rd" style="margin-top:5px; border-radius: 15px 0 15px 0; background-color: black; color: yellow;" class="btn btn-success" value="Show Details" /></a>   	
                </div>    
            </div>
<?php  
		    	}//end of while loop 
		    }else{
?>
       	<script>$('#roomtype4').hide();</script>
<?php
       }
?>
		</div><!-- end luxury-->


</div>

<?php
	include_once 'footer.php';
?>