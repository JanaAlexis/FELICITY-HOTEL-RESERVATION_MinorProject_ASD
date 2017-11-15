  <?php    
 include ('config/config.php');
 if(isset($_POST["reserve"])){  
      if(isset($_SESSION["cart"])){  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id)){  
                $count = count($_SESSION["cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>   $_POST["hidden_roomName"],  
                   	 'item_roomType'               =>   $_POST["hidden_roomType"],  
                     'item_bedType'          =>     $_POST["hidden_bedType"],
                     'item_bedType'               =>   $_POST["hidden_bedType"],  
                     'item_noOfperson'          =>     $_POST["hidden_noOfperson"],
                     'item_roomPrice'          =>     $_POST["hidden_roomPrice"],  
                );  
                $_SESSION["cart"][$count] = $item_array;  
           }  
           else{  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="mytest.php"</script>';  
           }  
      }  
      else{  
           $item_array = array(  
                 'item_id'               =>     $_GET["id"],  
                     'item_name'               =>   $_POST["hidden_roomName"],  
                   	 'item_roomType'               =>   $_POST["hidden_roomType"],  
                     'item_bedType'          =>     $_POST["hidden_bedType"],
                     'item_bedType'               =>   $_POST["hidden_bedType"],  
                     'item_noOfperson'          =>     $_POST["hidden_noOfperson"],
                     'item_roomPrice'          =>     $_POST["hidden_roomPrice"],   
           );  
           $_SESSION["cart"][0] = $item_array;  
      }  
 } 



 if(isset($_GET["action"])){  
      if($_GET["action"] == "delete"){  
           foreach($_SESSION["cart"] as $keys => $values){  
                if($values["item_id"] == $_GET["id"]){  
                     unset($_SESSION["cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="mytest.php"</script>';  
                }  
           }  
      }  
 }  
 ?>  

<?php
	include 'header.php';
	include 'navbar.php';

?>
           <div class="container" style="width:100%;">  
                <h1 align="center">List of Rooms</h1><br>
                <div class="deluxe col-md-12">

                <h3 align="center">Deluxe Rooms</h3>
                <?php
               	$query = "SELECT roomID,roomName, image, roomPrice, addPersonPrice, r.roomType, b.bedType, count(rd.bedID) as bedNum, noOfperson, status as roomStatus from room_details rd join room r on rd.roomTypeId = r.roomTypeId join beds b on rd.bedID = b.bedID WHERE r.roomType = 'deluxe' Group by rd.roomName, rd.bedID";
                $result = mysqli_query($conn, $query);  

                if(mysqli_num_rows($result) > 0){  
                     while($row = mysqli_fetch_array($result)){  
                ?>  
                <?php
                if($row['roomStatus']=='Available'){
                ?>
  				<div class="col-md-4">  
                    <form method="post" action="mytest.php?action=add&id=<?php echo $row["roomID"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="left">  
                               <img src="images/rooms/Deluxe.jpg" class="img-responsive" /><br />
                             
                               <h4>Room Type: <?php echo $row["roomType"]; ?></h4>
							   <h4>Number of beds: <?php echo $row["bedNum"]; ?></h4>
                               <h4>Single: <?php echo $row["bedType"]; ?></h4>
                               <h4>Double: <?php echo $row["bedType"]; ?></h4>
                               <h4>Maximum no of person: <?php echo $row["noOfperson"]; ?></h4>  
                               <h4>Rate: Php <?php echo $row["roomPrice"]; ?></h4>  

                               <input type="hidden" name="hidden_roomName" value="<?php echo $row["roomName"]; ?>" /> 
                               <input type="hidden" name="hidden_roomType" value="<?php echo $row["roomType"]; ?>" />  
                               <input type="hidden" name="hidden_bedType" value="<?php echo $row["bedType"]; ?>" /> 
                               <input type="hidden" name="hidden_bedType" value="<?php echo $row["bedType"]; ?>" />  
                               <input type="hidden" name="hidden_noOfperson" value="<?php echo $row["noOfperson"]; ?>" /> 
                               <input type="hidden" name="hidden_roomPrice" value="<?php echo $row["roomPrice"]; ?>" />
                              
                               <div align="right">
                            	<input type="submit" name="reserve" style="margin-top:5px;" class="btn btn-success" value="Reserve" />   	
                               </div>  
                              
                          </div>  
                     </form>  
                </div>  
				<?php
            	}//end of if status
                ?>
              
                <?php  
                }//end of while loop  
                }else{
              	?>
					<h5 align='center'><?php echo "No Rooms Available."?></h5>
                <?php
                }
                ?>
                </div><!--end of deluxe-->
			
                <div class="luxury  col-md-12">
                <h3 align="center">Luxury Rooms</h3>
                <?php  
               	$query = "SELECT roomID,roomName, image, roomPrice, addPersonPrice, r.roomType, b.bedType, count(rd.bedID) as bedNum, noOfperson, status as roomStatus from room_details rd join room r on rd.roomTypeId = r.roomTypeId join beds b on rd.bedID = b.bedID WHERE r.roomType = 'luxury' Group by rd.roomName, rd.bedID";
                $result = mysqli_query($conn, $query);  

                if(mysqli_num_rows($result) > 0){  
                     while($row = mysqli_fetch_array($result)){  
                ?>  
 				<?php
                if($row['roomStatus']=='Available'){
                ?>
  				<div class="col-md-4">  
                    <form method="post" action="mytest.php?action=add&id=<?php echo $row["roomID"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="left">  
                               <img src="images/rooms/Luxury.jpg" class="img-responsive" /><br />
                               <h4>Room Type: <?php echo $row["roomType"]; ?></h4>
							   <h4>Number of beds: <?php echo $row["bedNum"]; ?></h4>
                               <h4>Single: <?php echo $row["bedType"]; ?></h4>
                               <h4>Double: <?php echo $row["bedType"]; ?></h4>
                               <h4>Maximum no of person: <?php echo $row["noOfperson"]; ?></h4>  
                               <h4>Rate: Php <?php echo $row["roomPrice"]; ?></h4>    

                               <input type="hidden" name="hidden_roomName" value="<?php echo $row["roomName"]; ?>" /> 
                               <input type="hidden" name="hidden_roomType" value="<?php echo $row["roomType"]; ?>" />  
                               <input type="hidden" name="hidden_bedType" value="<?php echo $row["bedType"]; ?>" /> 
                               <input type="hidden" name="hidden_bedType" value="<?php echo $row["bedType"]; ?>" />  
                               <input type="hidden" name="hidden_noOfperson" value="<?php echo $row["noOfperson"]; ?>" /> 
                               <input type="hidden" name="hidden_roomPrice" value="<?php echo $row["roomPrice"]; ?>" />  
                               <div align="right">
                            	<input type="submit" name="reserve" style="margin-top:5px;" class="btn btn-success" value="Reserve" />   	
                               </div>    
                          </div>  
                     </form>  
                </div>  
				<?php
            	}//end of if status
                ?>
                <?php  
                     }//end of while loop  
                }else{
                ?>
					<h5 align='center'><?php echo "No Rooms Available."?></h5>
                <?php
                }
                ?>
                </div><!--end of luxury-->

                <div class="superior  col-md-12">
                <h3 align="center">Superior Rooms</h3>
                <?php  
               	$query = "SELECT roomID,roomName, image, roomPrice, addPersonPrice, r.roomType, b.bedType, count(rd.bedID) as bedNum, noOfperson, status as roomStatus from room_details rd join room r on rd.roomTypeId = r.roomTypeId join beds b on rd.bedID = b.bedID WHERE r.roomType = 'superior' Group by rd.roomName, rd.bedID";
                $result = mysqli_query($conn, $query);  

                if(mysqli_num_rows($result) > 0){  
                     while($row = mysqli_fetch_array($result)){  
                ?>  
 				<?php
                if($row['roomStatus']=='Available'){
                ?>
  				<div class="col-md-4">  
                    <form method="post" action="mytest.php?action=add&id=<?php echo $row["roomID"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="left">  
                               <img src="images/rooms/Superior.jpg" class="img-responsive" /><br /><h4 class="text-danger">Room Type: <?php echo $row["roomType"]; ?></h4>
							   <h4>Room Type: <?php echo $row["roomType"]; ?></h4>
							   <h4>Number of beds: <?php echo $row["bedNum"]; ?></h4>
                               <h4>Single: <?php echo $row["bedType"]; ?></h4>
                               <h4>Double: <?php echo $row["bedType"]; ?></h4>
                               <h4>Maximum no of person: <?php echo $row["noOfperson"]; ?></h4>  
                               <h4>Rate: Php <?php echo $row["roomPrice"]; ?></h4>  

                               <input type="hidden" name="hidden_roomName" value="<?php echo $row["roomName"]; ?>" /> 
                               <input type="hidden" name="hidden_roomType" value="<?php echo $row["roomType"]; ?>" />  
                               <input type="hidden" name="hidden_bedType" value="<?php echo $row["bedType"]; ?>" /> 
                               <input type="hidden" name="hidden_bedType" value="<?php echo $row["bedType"]; ?>" />  
                               <input type="hidden" name="hidden_noOfperson" value="<?php echo $row["noOfperson"]; ?>" /> 
                               <input type="hidden" name="hidden_roomPrice" value="<?php echo $row["roomPrice"]; ?>" />  
                               <div align="right">
                            	<input type="submit" name="reserve" style="margin-top:5px;" class="btn btn-success" value="Reserve" />   	
                               </div>    
                          </div>  
                     </form>  
                </div>  
				<?php
         		}//end of if status
                ?>
                <?php  
                     }//end of while loop  
                }else{
                ?>
					<h5 align='center'><?php echo "No Rooms Available."?></h5>
                <?php
                }
                ?>
                </div><!--end of superior-->

                <div class="suite  col-md-12">
                <h3 align="center">Suite Rooms</h3>
                <?php  
               	$query = "SELECT roomID,roomName, image, roomPrice, addPersonPrice, r.roomType, b.bedType, count(rd.bedID) as bedNum, noOfperson, status as roomStatus from room_details rd join room r on rd.roomTypeId = r.roomTypeId join beds b on rd.bedID = b.bedID WHERE r.roomType = 'suite' Group by rd.roomName, rd.bedID";
                $result = mysqli_query($conn, $query);  

                if(mysqli_num_rows($result) > 0){  
                     while($row = mysqli_fetch_array($result)){  
                ?>  
				<?php
                if($row['roomStatus']=='Available'){
                ?>
  				<div class="col-md-4">  
                    <form method="post" action="mytest.php?action=add&id=<?php echo $row["roomID"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="left">  
                               <img src="images/rooms/Suite.jpg" class="img-responsive" /><br />
                               <div align="left">
                               	  <h4>Room Type: <?php echo $row["roomType"]; ?></h4>
								  <h4>Number of beds: <?php echo $row["bedNum"]; ?></h4>
	                              <h4>Single: <?php echo $row["bedType"]; ?></h4>
	                              <h4>Double: <?php echo $row["bedType"]; ?></h4>
	                              <h4>Maximum no of person: <?php echo $row["noOfperson"]; ?></h4>  
	                              <h4>Rate: Php <?php echo $row["roomPrice"]; ?></h4>  

	                               <input type="hidden" name="hidden_roomName" value="<?php echo $row["roomName"]; ?>" /> 
	                               <input type="hidden" name="hidden_roomType" value="<?php echo $row["roomType"]; ?>" />  
	                               <input type="hidden" name="hidden_bedType" value="<?php echo $row["bedType"]; ?>" /> 
	                               <input type="hidden" name="hidden_bedType" value="<?php echo $row["bedType"]; ?>" />  
	                               <input type="hidden" name="hidden_noOfperson" value="<?php echo $row["noOfperson"]; ?>" /> 
	                               <input type="hidden" name="hidden_roomPrice" value="<?php echo $row["roomPrice"]; ?>" />  
                               </div>
                              
                               <div align="right">
                            	<input type="submit" name="reserve" style="margin-top:5px;" class="btn btn-success" value="Reserve" />   	
                               </div>   
                          </div>  
                     </form>  
                </div>  
				<?php
         		}//end of if status
                ?>
                <?php  
                     }//end of while loop  
                }else{
                ?>
					<h5 align='center'><?php echo "No Rooms Available."?></h5>
                <?php
                }
                ?>
                </div><!--end of sute-->
                  
                <div style="clear:both"></div>  
                <br />  
                <h3>Booked details</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th>Room Type</th>
                               <th>Bed Type</th>
                               <th>Maximum number of person</th>
                               <th>Price</th>  
           					   <th>Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values['item_roomType']; ?></td>
                               <td><?php echo $values["item_bedType"]; ?></td>
                               <td><?php echo $values["item_noOfperson"]; ?></td>
							   <td>$ <?php echo $values["item_roomPrice"]; ?></td>  
                             <!--  <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  -->
                               <td><a href="mytest.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                  //  $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
           <br />  
	</body>
</head>