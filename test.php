<?php
  include 'header.php';
  include 'navbar.php';

 ?>

<div class="col-md-12">

      <h3 id="rtype2" align="left" style="letter-spacing: 10px;">LUXURY</h3>
<?php
        $query = "SELECT roomID, roomName, r.roomType, rd.bedID, b.bedType, bedCount, noOfperson, roomPrice, addPersonPrice from room_details rd join room r on rd.roomTypeId = r.roomTypeId join beds b on rd.bedID = b.bedID WHERE r.roomTypeId='2' AND status = 'Available' Group by rd.roomName, rd.bedID";
        $result = mysqli_query($conn, $query); 

        if(mysqli_num_rows($result) > 0){  
          $data = [];
          $x = 0;
          while($row = mysqli_fetch_array($result)){ 
            $data[$x] = $row;
            $x++;
          }
          $x = 0;
          $y = count($data);
          $z = $y - 1;
          while($x < $y){

          
            
?>
        <div class="col-md-3 img-grid">  
            
          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="left">  
             <img src="showimage.php?msg=<?php echo $data[$x]['roomID'] ?>" class="img-responsive" /><br />
            <div>
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
                <label class="lbl-roomdetails"><?php echo $data[$x]['bedCount'] ?></label></br>
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
               <input id ="" data-id="<?php echo $data[$x]['roomName'] ?>" type="button" name="reserve" align="center" style="margin-top:5px; border-radius: 15px 0 15px 0; background-color: black; color: yellow; width: 50%;" class="btn btn-success btnReserve" value="Reserve" />     
             </div>  
          </div>  
             
        </div>
<?php 
             $x = $x + 2; 
          }  
        }
?>
   </div> <!-- END of luxury -->

   <div class="col-md-12">

      <h3 id="rtype3" align="left" style="letter-spacing: 10px;">SUITE</h3>
<?php
        $query = "SELECT roomID, roomName, r.roomType, rd.bedID, b.bedType, bedCount, noOfperson, roomPrice, addPersonPrice from room_details rd join room r on rd.roomTypeId = r.roomTypeId join beds b on rd.bedID = b.bedID WHERE r.roomTypeId='3' AND status = 'Available' Group by rd.roomName, rd.bedID";
        $result = mysqli_query($conn, $query); 

        if(mysqli_num_rows($result) > 0){  
          $data = [];
          $x = 0;
          while($row = mysqli_fetch_array($result)){ 
            $data[$x] = $row;
            $x++;
          }
          $x = 0;
          $y = count($data);
          $z = $y - 1;
          while($x < $y){

          
            
?>
        <div class="col-md-3 img-grid">  
            
          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="left">  
             <img src="showimage.php?msg=<?php echo $data[$x]['roomID'] ?>" class="img-responsive" /><br />
            <div>
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
                <label class="lbl-roomdetails"><?php echo $data[$x]['bedCount'] ?></label></br>
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
               <input id ="" data-id="<?php echo $data[$x]['roomName'] ?>" type="button" name="reserve" align="center" style="margin-top:5px; border-radius: 15px 0 15px 0; background-color: black; color: yellow; width: 50%;" class="btn btn-success btnReserve" value="Reserve" />     
             </div>  
          </div>  
             
        </div>
<?php 
             $x = $x + 2;   
          }  
        }
?>
   </div> <!-- END of suite -->

<div class="col-md-12">

      <h3 id="rtype4" align="left" style="letter-spacing: 10px;">SUPERIOR</h3>
<?php
        $query = "SELECT roomID, roomName, r.roomType, rd.bedID, b.bedType, bedCount, noOfperson, roomPrice, addPersonPrice from room_details rd join room r on rd.roomTypeId = r.roomTypeId join beds b on rd.bedID = b.bedID WHERE r.roomTypeId='4' AND status = 'Available' Group by rd.roomName, rd.bedID";
        $result = mysqli_query($conn, $query); 

        if(mysqli_num_rows($result) > 0){
          $data = [];
          $x = 0;
          while($row = mysqli_fetch_array($result)){ 
            $data[$x] = $row;
            $x++;
          }
          $x = 0;
          $y = count($data);
          $z = $y - 1;
          while($x < $y){

          
            
?>
        <div class="col-md-3 img-grid">  
            
          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="left">  
             <img src="showimage.php?msg=<?php echo $data[$x]['roomID'] ?>" class="img-responsive" /><br />
            <div>
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
                <label class="lbl-roomdetails"><?php echo $data[$x]['bedCount'] ?></label></br>
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
               <input id ="" data-id="<?php echo $data[$x]['roomName'] ?>" type="button" name="reserve" align="center" style="margin-top:5px; border-radius: 15px 0 15px 0; background-color: black; color: yellow; width: 50%;" class="btn btn-success btnReserve" value="Reserve" />     
             </div>  
          </div>  
             
        </div>
<?php 
             $x = $x + 2;  
          }  
        }
?>
   </div> <!-- END superior -->

 <script type="text/javascript"> //Javascript/jquery when opening document
  $(document).ready(function(){
   
      var arrId = [];

      $(".btnReserve").one({
          click: reserveroomId
      })


      

      function reserveroomId(){
            
            var rID = $(this).attr('data-id');
            console.log("roomID: "+ rID);
            arrId.push(rID);
            console.log("array: "+ arrId);

            
      /*    $.ajax({
            url: "testarray.php",
            method: "POST",
            data: {
              action: 'transferIds',
              arrayId: arrId
            },
            success: function(response){
              //console.log(response);
              //window.location.replace("userbookings.php");

            },
            error: function(response){
              console.log(response);
            }
           
          })
         //   $('#edit-customerId').val(customerId);
           
*/

           

      }
  });

</script>

<?php

/*
if(isset($_POST['viewcd'])){
	$queryw = "select * from lib_cd where id=".$_POST['idd'];
	$resultw = $mysqli->query($queryw);
?>

<div class="container">
	<table border="1" align="center" border-collapse="collapse">
		<thead>
			<tr >
				<th >Select</th>
				<th>Well_Number</th>
				<th>Well_Name</th>
				<th width="100">CD No:</th>
				<th width="150">Logs</th>
				<th width="100">Bottom Depth</th>
				<th width="100">Top Depth</th>
				<th width="100">Date of Log</th>
			</tr>
		</thead>
<?php
	while($rowcd = $resultw->fetch_assoc()){
?>
		<tr>
			<td><?php echo $rowcd['id'] ?> </td>
			<td align="center"><?php echo $rowcd['well_no'] ?></td>
			<td align="center"><?php echo $rowcd['well_name'] ?></td>
			<td colspan="5">
				<table rules="all">
					<tr>
<?php
		$querycd = "select * from cd where pidd=".$rowcd['id'];
		$resultcd = $mysqli->query($querycd);
		while($rowcd = $resultcd->fetch_assoc()){
?>
						<td width="100" align="center"><?php echo $rowcd['cd_no'] ?></td>
						<td colspan="4">
							<table rules="all">
								<tr>
<?php
			$queryl = "select * from lib_cd_logs where pid=".$rowcd['cd_no'];
			$resultl = $mysqli->query($queryl);
			while($rowl = $resultl->fetch_assoc()){
?>
									<td width="155"><?php echo $rowl['logs'] ?></td>
									<td width="105" align="center"><?php echo $rowl['bottom'] ?></td>
									<td width="100" align="center"><?php echo $rowl['top'] ?></td>
									<td width="100" align="right"><?php echo $rowl['date'] ?></td>
								</tr>
<?php
			}
?>
							</table>
						</td>
					</tr>
<?php
		}
?>
				</table>
			</td>
<?php
	}
}
?>
	</tr>
</table>
*/
?>