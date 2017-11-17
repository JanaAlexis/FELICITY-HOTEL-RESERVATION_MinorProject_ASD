<?php
    include 'header.php';
    include 'navbar.php';
    //echo $_SESSION['userStatus'];
?>

<div class="container-fluid container-padding">
    <button class="btn btn-secondary btn-fontgray" data-toggle="modal" data-target="#newroom-modal">Add New Room Record</button></br>
    
	<!-- Add new room modal -->
	<div id="newroom-modal" class="modal fade in" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-sm" role="document">
		  <div class="modal-content">

			  <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <h4 class="modal-title">Add New Room Record </h4>
			  </div>

			  <div class="modal-body">
				  <!-- Label shows if some data entered is invalid -->
					  <label class="label label-danger" id="datainvalid"></label></br>
					  
				<form method="post" action="admin-functions.php?action=add" enctype="multipart/form-data">
					<div class="form-group">    
						  <label>Room Type</label>
						  <div class="dropdown">
							  <select class= "btn btn-sm btn-info" name="roomType" id="roomType">
								  <option value="1">Deluxe</option>
								  <option value="2">Luxury</option>
								  <option value="3">Suite</option>
								  <option value="4">Superior</option>
							  </select>
						  </div>
						  <label>Room Name</label>
						  <input type="text" id="" class="form-control" placeholder="Room name" name="roomName" required /></br>
						  <label>Bed Type</label></br>
						  <label style="font-size: 13px;">Single</label>
						  <input type="number" id="" class="form-control" min="0" value="0" name="singleBed"/>
						  <label style="font-size: 13px;">Double</label>
						  <input type="number" id="" class="form-control" min="0" value="0" name="doubleBed"/></br>
						  
						  <label>No. of Persons</label>
						  <input type="number" id="" class="form-control" min="1" value="1" name="numPersons"/></br>

						  <label>Room Price</label>
						  <span><i>  (in Php)</i></span><input type="number" id="" class="form-control" min="0" step="0.01" value="0.00" name="roomPrice"/></br>

						  <label>Charge for Extra Person</label>
						  <span><i>  (in Php)</i></span>
						  <input type="number" id="" class="form-control" min="0" step="0.01" value="0.00" name="addPersonPrice"/></br>

						  <label>Room Image</label>
							<input type="file" name="image" required /></br>
						  
						  <label>Status</label>
						  <div class="dropdown">
							  <select class= "btn btn-sm btn-info" name="roomStatus" id="roomStatus" required>
								  <option value="Available">Available</option>
								  <option value="Unavailable">Unavailable</option>
							  </select>
						  </div></br></br>
						  
						  <button class="btn btn-info pull-right" type="submit" name="submit"> Submit Record </button>
					</div>
				</form>
			  </div>
		  </div>
	  </div>
	</div>                      
	<!-- end of add new room modal -->

	<!-- Table that displays the record list -->
	<h3>Room Details</h3>
	<div class="panel panel-default">
	  <div class="panel-heading"></div>
	  <div class="panel-body">
		  <table class="table table-hover" id="item-list-tbl">
			<thead>
			   <tr>
				  <th>Room Name</th>
				  <th>Room Type</th>
				  <th>Bed Type</th>
				  <th>No. of Bed/s</th>
				  <th>No. of Person/s</th>
				  <th>Room Price <i>(in Php)</i></th>
				  <th>Additional Person <i>(in Php)</i></th>
				  <th>Status</th>
				  <th>Action</th>
				</tr>
			  </thead>
			  <tbody id="item-tbl-body">
				<!-- to be filled dynamically -->
			  </tbody>
		  </table>
	  </div>
	</div>
	<!-- end of display list -->

	<!-- Edit room data modal -->
	<div id="editroom-modal" class="modal fade in" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-sm" role="document">
		  <div class="modal-content">
			  <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <h4 class="modal-title">Update Room Record </h4>
			  </div>
			  <div class="modal-body">
				  <!-- Label shows if some data entered is invalid -->
					  <label class="label label-danger" id="updateDatainvalid"></label></br>
					  
				<form method="post" action="admin-functions.php?action=update" enctype="multipart/form-data">
					<div class="form-group">

						<input type="hidden" id="edit-roomId" class="form-control" name="roomId"/>

						<label>Room Type</label>
						<div class="dropdown">
							<select class= "btn btn-sm btn-success" name="roomType" id="edit-roomType">
								<option value="1">Deluxe</option>
								<option value="2">Luxury</option>
								<option value="3">Suite</option>
								<option value="4">Superior</option>
							</select>
						</div>

						<label>Room Name</label>
						<input type="text" id="edit-roomName" class="form-control" placeholder="Room name" name="roomName" required /></br>

						<label>Bed Type</label></br>
						<label id="edit-single-lbl" style="font-size: 13px;">Single</label>
						<input type="number" id="edit-single" class="form-control" min="0" value="0" name="singleBed"/>

						<label id="edit-double-lbl" style="font-size: 13px;">Double</label>
						<input type="number" id="edit-double" class="form-control" min="0" value="0" name="doubleBed"/></br>
						
						<label>No. of Persons</label>
						<input type="number" id="edit-numPerson" class="form-control" min="1" value="1" name="numPersons"/></br>

						<label>Room Price</label>
						<span><i>  (in Php)</i></span><input type="number" id="edit-roomPrice" class="form-control" min="0" step="0.01" value="0.00" name="roomPrice"/></br>

						<label>Charge for Extra Person</label>
						<span><i>  (in Php)</i></span><input type="number" id="edit-addPersonPrice" class="form-control" min="0" step="0.01" value="0.00" name="addPersonPrice"/></br>
						
						<label>Room Image</label>
						<input type="file" name="edit-image" /></br>

						<label>Status</label>
						<div class="dropdown">
							<select class= "btn btn-sm btn-success" name="roomStatus" id="edit-roomStatus" required>
								<option value="Available">Available</option>
								<option value="Unavailable">Unavailable</option>
								<option value="Archived">Archive</option>
							</select>
						</div></br></br>
						
						<button class="btn btn-success pull-right" type="submit" name="submit"> Update Record </button>
					</div>
				</form>
			  </div>
		  </div>
	  </div>
	</div>                      
<!-- end of edit room data modal -->
</div>

<?php
    include 'footer.php';
?>

<?php   //Displays message when data in adding new room is invalid
if (isset($_GET['page'])){ 

    if($_GET['page']=="addroom"){               
        if(!empty($_GET['msg'])){

            switch ($_GET['msg']) {
              case 'invalidnum':
?>
                   <script>
                  $('#datainvalid').text('Number count is invalid. Please try again.');
                  $('#newroom-modal').modal('show');
                  </script>
<?php
              break;
              case 'existing':
?>
                  <script>
                  $('#datainvalid').text('Room name already exist. Please try again.');
                  $('#newroom-modal').modal('show');
                  </script>
<?php
              break;
              case 'noimg':
?>
                  <script>
                  $('#datainvalid').text('No image selected. Please try again.');
                  $('#newroom-modal').modal('show');
                  </script>
<?php
              break;
            }
        }
    }

    if($_GET['page']=="editroom"){               
        if(!empty($_GET['msg'])){

            switch ($_GET['msg']) {
              case 'invalidnum':
?>
                  <script>
                    alert("Number count is invalid. Please try again.");
                    window.location.replace("admindashboard-roomdetails.php");
                  </script>
<?php         
							break;
							case 'noimg':
?>
									<script>
                    alert("No image selected. Please try again.");
                    window.location.replace("admindashboard-roomdetails.php");
                  </script>

<?php 
              break;
            }
        }
    }
}
?> <!-- end of display message  -->

<?php //PHP query for getting record list

  $selectquery = "SELECT roomID, roomName, r.roomType, b.bedType, bedCount, noOfperson, roomPrice, addPersonPrice, status as roomStatus from room_details rd join room r on rd.roomTypeId = r.roomTypeId join beds b on rd.bedID = b.bedID WHERE rd.status <> 'Archived' Group by rd.roomName, rd.bedId";
  $res = mysqli_query($conn, $selectquery);
  $data;
  if($res){
    $x=0;
      while($result = mysqli_fetch_assoc($res)){
        $data[$x] = $result;
        $x++;
      }
  }

?> <!-- end of record list php -->


<script type="text/javascript"> //Javascript/jquery when opening document
  $(document).ready(function(){

    var data = <?php echo json_encode($data) ?>; // Populate record data in table using the data from php query
    
    var itemTbl = $("#item-tbl-body");
    itemTbl.html("");
    var roomId = 0;

       for(var x=0;x<data.length;x++){
       
         roomId = data[x].roomID;
         var tRow = "<tr>";
         tRow += "<td>" + data[x].roomName + "</td>";
         tRow += "<td>" + data[x].roomType + "</td>";
         tRow += "<td>" + data[x].bedType + "</td>";
         tRow += "<td class='tbl-num'>" + data[x].bedCount + "</td>";
         tRow += "<td class='tbl-num'>" + data[x].noOfperson + "</td>";
         tRow += "<td class='tbl-num'>" + data[x].roomPrice + "</td>";
         tRow += "<td class='tbl-num'>" + data[x].addPersonPrice + "</td>";
         tRow += "<td><img src='showimage.php?msg=" + roomId + "' class='tbl-img'/></td>";
         
         tRow += "<td>" + data[x].roomStatus + "</td>";
         tRow += "<td><div class='actions-menu'><button type='button' class='btn btn-sm btn-default editRecordLink' data-roomName='"+data[x].roomName+"' data-roomType='"+data[x].roomType+"' data-bedType='"+data[x].bedType+"' data-bedNum='"+data[x].bedCount+"' data-numPerson='"+data[x].noOfperson+"' data-roomPrice='"+data[x].roomPrice+"' data-addPersonPrice='"+data[x].addPersonPrice+"' data-roomStatus='"+data[x].roomStatus+"' data-toggle='modal' data-target='#editroom-modal' id='"+roomId+"'><i class='fa fa-edit' style='color:green;'></i></button></div></td>";
         tRow += "</tr>";

       itemTbl.append(tRow);
      }   // end of populating data

      $(".editRecordLink").on({
          click: editRecord
      })


      function editRecord(){
            var roomId = $(this).attr("id");
            var roomname = $(this).attr("data-roomName");
            var roomtype = $(this).attr("data-roomType");
            var bedtype = $(this).attr("data-bedType");
            var bedcount = $(this).attr("data-bedNum");
            var numperson = $(this).attr("data-numPerson");
            var roomprice = $(this).attr("data-roomPrice");
            var addpersonprice = $(this).attr("data-addPersonPrice");
            var roomstatus = $(this).attr("data-roomStatus");
            $('#edit-roomId').val(roomId);
            $('#edit-roomName').val(roomname);


            if(roomtype=='Deluxe'){
                $('#edit-roomType').val('1');
            }else if(roomtype=='Luxury'){
                $('#edit-roomType').val('2');
            }else if(roomtype=='Suite'){
                $('#edit-roomType').val('3');
            }else{
                $('#edit-roomType').val('4');
            }
            $('#edit-bedType').val(bedtype);
            if(bedtype=='Single'){
                $('#edit-single').val(bedcount);
            }else{
                $('#edit-double').val(bedcount);
            }
            $('#edit-numPerson').val(numperson);
            $('#edit-roomPrice').val(roomprice);
            $('#edit-addPersonPrice').val(addpersonprice);
            $('#edit-roomStatus').val(roomstatus);

      }
  });

</script>