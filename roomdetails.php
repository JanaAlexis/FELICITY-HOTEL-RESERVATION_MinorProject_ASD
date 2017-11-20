 <?php
  include ('config/config.php');
  include 'header.php';
  include 'navbar.php';

 ?>
<div class="container-fluid">

    <h1 align="center" style="letter-spacing: 15px;">ROOM LIST</h1><br>

    <div class="col-md-12">
<?php
      $typeCount = 1;
      while($typeCount<5){
          $query = "SELECT roomID, roomName, r.roomType, rd.bedID, b.bedType, bedCount, noOfperson, roomPrice, addPersonPrice from room_details rd join room r on rd.roomTypeId = r.roomTypeId join beds b on rd.bedID = b.bedID WHERE r.roomTypeId='$typeCount' AND status = 'Available' Group by rd.roomName, rd.bedID";
            $result = mysqli_query($conn, $query); 

            $row1 = mysqli_fetch_array($result);

         

           //$rowCount = mysqli_num_rows($result);
           if(mysqli_num_rows($result) > 0){  
            $data = [];
            $x = 0;
              while($row = mysqli_fetch_array($result)){  //fetch all rows at once
                $data[$x] = $row;
                $x++;
              }
            $x = 0;
            $y = count($data);
            $z = $y - 1;
            while($x < $y){
?>
                <div class="col-md-3 img-grid">  
                    
        					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; margin:30px;" align="left">  
        						<img src="showimage.php?msg=<?php echo $data[$x]['roomID'] ?>" class="img-responsive" /><br />
        						<div align="left">
        							<div align="center"><h4><?php echo strtoupper($data[$x]['roomType']) ?></h4>
        							</div></br>
        							<label class="lbl-roomdetails">Single bed/s : </label>
        							<label class="lbl-roomdetails"><?php echo $data[$x]['bedCount'] ?></label></br>
        							<label class="lbl-roomdetails">Double bed/s : </label>
<?php 
        					if($x!=$z){

?>
        							<label class="lbl-roomdetails"><?php echo $data[$x+1]['bedCount'] ?></label></br>
<?php
        					}else{
?>
        							<label class="lbl-roomdetails" align="left"><?php echo $data[$x]['bedCount'] ?></label></br>
<?php
        					}
?>
        							<label class="lbl-roomdetails">Pax : </label>
        							<label class="lbl-roomdetails"><?php echo $data[$x]['noOfperson'] ?></label></br>
        							<label class="lbl-roomdetails">Extra Person Rate : </label>
        							<label class="lbl-roomdetails"> Php <?php echo $data[$x]['addPersonPrice'] ?></label></br>
        							<label class="lbl-roomdetails">Rate : </label>
        							<label class="lbl-roomdetails"> Php <?php echo $data[$x]['roomPrice'] ?></label></br>
        						</div>

        						<div align="right">
        						   <input data-id="<?php echo $data[$x]['roomName'] ?>" type="button" name="reserve" align="center" style="margin-top:5px; border-radius: 15px 0 15px 0; background-color: black; color: yellow; width: 50%;" class="btn btn-success btnReserve" value="Reserve" />     
        						</div>  
        					</div>
                     
        				</div>
<?php
                        $x =$x + 2;
                      }
                    }
                $typeCount++;
              }

?>
    </div> <!-- End col-lg-12 -->




    <button id="btnBook" class="btn btn-primary fixed-btn" style="margin: 25px; padding:10px; align: center;">Complete Reservation >>> </button>
</div> <!-- End container-fluid -->


<?php
    include 'footer.php';
?>

  <script type="text/javascript"> //Javascript/jquery when opening document
  $(document).ready(function(){

      var arrId = [];

      $(".btnReserve").one({
          click: reserveRoom
      })

      $("#btnBook").on({
          click: bookRoom
      })


      

      function reserveRoom(){ //store selected rooms in array for query later
            
          var rName = $(this).attr('data-id');
          console.log("roomName: "+ rName);
          arrId.push(rName);
          //console.log("array: "+ arrId);
      }

      function bookRoom(){

        if(arrId==""){

          alert("Select a room first.");

        }else{

          $('#booking-modal').modal('toggle');
          //console.log(arrId);

          $.ajax({
            url: "getResData.php",
            method: "POST",
            data: {
              action: 'transferIds',
              arrayId: arrId
            },
            success: function(response){
              var data = response;
              //console.log(response);
              displayBookingModal(data);

            },
            error: function(response){
              console.log(response);
            }
           
          })

        }
      }

      function displayBookingModal(data){
          var resData = data;
          console.log(resData);

      }


  });

</script>