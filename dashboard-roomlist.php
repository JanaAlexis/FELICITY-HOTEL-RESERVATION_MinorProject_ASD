<?php
    include 'header.php';
    include 'navbar.php';
    //echo $_SESSION['userStatus'];
?>
<img src='displayimg.php?img=1' width='250px' height='200px' alt='No image available.'/>
<div class="container-fluid container-padding">
    <h3>Room List</h3>
	<div class="panel panel-default">
	  <div class="panel-heading"></div>
	  <div class="panel-body">
		  <table class="table table-hover tbl-center" id="item-list-tbl">
			<thead>
			   <tr>
				  <th>Room No.</th>
				  <th>Room Type</th>
				  <th>Room Image</th>
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

	<!-- Update image modal -->
	<div id="editimg-modal" class="modal fade in" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-sm" role="document">
		  <div class="modal-content">

				  <div class="modal-header">

					  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						<h4 class="modal-title">Update Image</h4>
				  </div>

				  <div class="modal-body">
				  	<div class="form-inline">
							<label>Room Type:   </label>
							<label id="roomtype" style="color: #5F9EA0; font-size: 20px; margin-left: 20px;"></label>
						</div>
							<!-- Label shows if no image is selected -->
							<label id="noImg" class="label label-danger"></label></br>

							<label>Room image in file:</label></br>
							<!-- Form for uploading image -->
					  		<form method="post" action="admin-functions.php?action=updateimg" enctype="multipart/form-data">
									<div class="form-group">
										<input type="hidden" id="roomId" class="form-control" name="roomId"/>
										<input type="hidden" id="roomName" class="form-control" name="roomName"/>
											<input type="file" name="image" />
											<input type="submit" name="submit" value="Upload" />
									</div>
								</form> <!-- end of upload form -->
				 </div>

			</div>
		</div>
	</div>
</div>


<?php
    include 'footer.php';
?>

<?php   //Displays message when no image is selected during upload
if (isset($_GET['page'])){ 

    if($_GET['page']=="uploadimg"){               
        if(!empty($_GET['msg'])){

            switch ($_GET['msg']) {
              case 'none':
?>
                   <script>
	                   	var roomId = "<?php echo $_SESSION['imgRoomId'] ?>";
	                   	var roomtype = "<?php echo $_SESSION['imgRoomname'] ?>";
							          $('#roomId').val(roomId); //set the values again in modal for form resubmission
							          $('#roomName').val(roomtype);
		          				$('#roomtype').text(roomtype);
		                  $('#noImg').text('No image selected. Please try again.');
		                  $('#editimg-modal').modal('show');
                  </script>
<?php
                        break;
            }
        }
    }
}
?>
<?php //PHP query for getting room list

  $selectquery = "SELECT roomTypeId, roomType, imgID from room";
  $res = mysqli_query($conn, $selectquery);
  $data;
  if($res){
    $x=0;
      while($result = mysqli_fetch_assoc($res)){
        $data[$x] = $result;
        $x++;
      }
  }

?> <!-- end of room list php -->
<script type="text/javascript"> //Javascript/jquery when opening document
	$(document).ready(function(){

	    var data = <?php echo json_encode($data) ?>; // Populate room data in table using the data from php query
	    
	    var itemTbl = $("#item-tbl-body");
	    itemTbl.html("");
	    var roomId = 0;

	       for(var x=0;x<data.length;x++){
	         
	         console.log("imgId:" + data[x].imgID);
	       
	         roomId = data[x].roomTypeId;
	         var tRow = "<tr>";
	         tRow += "<td>" + data[x].roomTypeId + "</td>";
	         tRow += "<td>" + data[x].roomType + "</td>";
	         //tRow += "<td>" + data[x].imgID + "</td>";

	         tRow += "<td><img src='displayimg.php?img='" + data[x].imgID + "' width='250px' height='200px' alt='No image available.'/></td>";

	         tRow += "<td><div class='actions-menu'><button type='button' class='btn btn-sm btn-default editImgLink' data-roomtype='"+ data[x].roomType +"' data-toggle='modal' data-target='#editimg-modal' id='"+roomId+"'><i class='fa fa-edit' style='color:green;'></i></button></div></td>";
	         tRow += "</tr>";

	       itemTbl.append(tRow);
	      }   // end of populating data

	      $(".editImgLink").on({
          	click: editImg
      	 })


      function editImg(){

          var roomId = $(this).attr("id");
          var roomtype = $(this).attr("data-roomtype");

          $('#roomId').val(roomId);
          $('#roomName').val(roomtype);
          $('#roomtype').text(roomtype);
          console.log('roomId: '+ roomId);

      }

	});
</script>