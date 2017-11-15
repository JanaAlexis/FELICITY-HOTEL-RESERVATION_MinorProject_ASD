<?php
	include 'header.php';
	include 'navbar.php';
?>
<?php
	echo $_SESSION['userStatus'];
	
?>
<body>
<div class="container" style="width:100%;">  
   <h1 align="center"></h1><br>
        <div class="deluxe col-md-12">
			<h3 align="center">Deluxe Rooms</h3>
            <?php
               	$query = "SELECT image, r.roomType from room_details rd join room r on rd.roomTypeId = r.roomTypeId WHERE r.roomType = 'deluxe' Group by rd.roomName;";
                $result = mysqli_query($conn, $query);  
				if(mysqli_num_rows($result) > 0){  
                     while($row = mysqli_fetch_array($result)){
            ?>
            <div class="col-md-4">  
                <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="left">  
                    <img src="images/rooms/Deluxe.jpg" class="img-responsive" /><br />
                </div>
                <div align="right">
                	<a href="roomdetails.php"><input type="submit" name="rd" style="margin-top:5px;" class="btn btn-success" value="Show Details" /></a>   	
                </div>    
            </div>
            <?php  
                	}//end of while loop 
                }
            ?>
		</div><!--deluxe-->
		<div class="luxury col-md-12">
			<h3 align="center">Luxury Rooms</h3>
            <?php
               	$query = "SELECT image, r.roomType from room_details rd join room r on rd.roomTypeId = r.roomTypeId WHERE r.roomType = 'luxury' Group by rd.roomName;";
                $result = mysqli_query($conn, $query);  
				if(mysqli_num_rows($result) > 0){  
                     while($row = mysqli_fetch_array($result)){
            ?>
            <div class="col-md-4">  
                <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="left">  
                    <img src="images/rooms/Luxury.jpg" class="img-responsive" /><br />
                </div>
                 <div align="right">
                	<a href="roomdetails.php"><input type="submit" name="rd" style="margin-top:5px;" class="btn btn-success" value="Show Details" /></a>   	
                </div>  
            </div>
            <?php  
                	}//end of while loop 
                }
            ?>
		</div><!--luxury-->
		<div class="superior col-md-12">
			<h3 align="center">Superior Rooms</h3>
            <?php
               	$query = "SELECT image, r.roomType from room_details rd join room r on rd.roomTypeId = r.roomTypeId WHERE r.roomType = 'superior' Group by rd.roomName;";
                $result = mysqli_query($conn, $query);  
				if(mysqli_num_rows($result) > 0){  
                     while($row = mysqli_fetch_array($result)){
            ?>
            <div class="col-md-4">  
                <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="left">  
                    <img src="images/rooms/Superior.jpg" class="img-responsive" /><br />
                </div>
                <div align="right">
                	<a href="roomdetails.php"><input type="submit" name="rd" style="margin-top:5px;" class="btn btn-success" value="Show Details" /></a>   	
                </div>     
            </div>
            <?php  
                	}//end of while loop 
                }
            ?>
		</div><!--superior-->
		<div class="suite col-md-12">
			<h3 align="center">Suite</h3>
            <?php
               	$query = "SELECT image, r.roomType from room_details rd join room r on rd.roomTypeId = r.roomTypeId WHERE r.roomType = 'suite' Group by rd.roomName;";
                $result = mysqli_query($conn, $query);  
				if(mysqli_num_rows($result) > 0){  
                     while($row = mysqli_fetch_array($result)){
            ?>
            <div class="col-md-4">  
                <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="left">  
                    <img src="images/rooms/Suite.jpg" class="img-responsive" /><br />
                </div>
               <div align="right">
                	<a href="roomdetails.php"><input type="submit" name="rd" style="margin-top:5px;" class="btn btn-success" value="Show Details" /></a>   	
                </div>  
            </div>
            <?php  
                	}//end of while loop 
                }
            ?>
		</div><!--suite-->

</div>
</body>