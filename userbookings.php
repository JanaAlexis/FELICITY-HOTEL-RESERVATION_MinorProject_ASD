<?php
	include 'header.php';
	include 'navbar.php';

?>

<!-- Table that displays the record list -->
	<br><h3>Booked List</h3><br>
	<div class="panel panel-default">
	  <div class="panel-heading"></div>
	  <div class="panel-body">
		  <table class="table table-hover" id="item-list-tbl">
			<thead>
			   <tr>
				  <th>Booking Ref No</th>
				  <th>First Name</th>
				  <th>Last Name</th>
				  <th>Email</th>
				  <th>Room Type</th>
     		      <th>Room Name</th>
    		      <th>Room Price</th>
     		      <th>Exceed person payment</th>
     		      <th>Maximum Number of Person</th>
				  <th>Check In</th>
				  <th>Check Out</th>
				  <th>Total booked person</th>
				  <th>Status</th>
				  <th>Action</th>
				<!--  <th>Update</th> -->
				</tr>
			  </thead>
			  <tbody id="item-tbl-body">
				<!-- to be filled dynamically -->

				<tr><td>totalprice();</td></td>


			  </tbody>
		  </table>
	  </div>
	</div>
<!-- end of display list -->

<!-- end of display list -->
<div id="editbook-modal" class="modal fade in" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-sm" role="document">
		  <div class="modal-content">
			  <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <h4 class="modal-title">Update Booking Record </h4>
			  </div>
			  <!-- Edit room data modal -->
			<div class="modal-body">
			    <!-- Label shows if some data entered is invalid -->
			    <label class="label label-danger" id="updateDatainvalid"></label></br>
			        
			        <form method="post" action="userfunction.php?action=update" enctype="multipart/form-data">
			            <div class="form-group">

			            <input type="hidden" id="edit- bookingrefno" class="form-control" name=" bookingrefno"/>


			            <label>Check In</label>
			            <input type="date" id="edit-checkIn" class="form-control" placeholder="check in" name="checkIn" required /></br>

			            <label>Check Out</label>
			            <input type="date" id="edit-checkOut" class="form-control" placeholder="check out" name="checkOut" required /></br>

			      
			            <button class="btn btn-success pull-right" type="submit" name="submit"> Update Record </button>
			            </div>
			        </form>
			</div>
		  </div>
	  </div>
</div>



<?php
    include 'footer.php';
?>

<?php //PHP query for getting record list

  $selectquery = "SELECT bookingRefNo, c.firstName, c.lastName, c.email, r.roomType, rd.roomName, rd.roomPrice, rd.addPersonPrice,rd.noOfperson ,checkIn,checkOut, expectedPerson, bd.status as bStat from booking_details bd join customer c on bd.customerID = c.customerID join room_details rd on bd.roomID=rd.roomID join room r on rd.roomTypeId = r.roomTypeId";
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
      var bookingrefno = 0;

         for(var x=0;x<data.length;x++){
          bookingrefno=data[x].bookingRefNo;
           var tRow = "<tr>";
               tRow += "<td>" + data[x].bookingRefNo + "</td>";
               tRow += "<td>" + data[x].firstName + "</td>";
               tRow += "<td>" + data[x].lastName + "</td>";
               tRow += "<td>" + data[x].email + "</td>";
               tRow += "<td class='tbl-num'>" + data[x].roomName + "</td>";
               tRow += "<td class='tbl-num'>" + data[x].roomType + "</td>";
               tRow += "<td class='tbl-num'>" + data[x].roomPrice + "</td>";
               tRow += "<td class='tbl-num'>" + data[x].addPersonPrice + "</td>";
               tRow += "<td class='tbl-num'>" + data[x].noOfperson + "</td>";
               tRow += "<td class='tbl-num'>" + data[x].checkIn + "</td>";
               tRow += "<td class='tbl-num'>" + data[x].checkOut + "</td>";
               tRow += "<td class='tbl-num'>" + data[x].expectedPerson + "</td>";
               tRow += "<td class='tbl-num'>" + data[x].bStat + "</td>";
          	   tRow += "<td><div class='actions-menu'><button type='button' class='btn btn-sm btn-default editRecordLink' data- bookingrefno='"+data[x].bookingRefNo+"' data-checkIn='"+data[x].checkIn+"' data-checkOut='"+data[x].checkOut+"' data-expectedPerson='"+data[x].expectedPerson+"'  data-bStat='"+data[x].bStat+"' data-toggle='modal' data-target='#editbook-modal' id='"+bookingrefno+"'><i class='fa fa-edit' style='color:green;'></i></button></div></td>";
       		   tRow += "</tr>";

        itemTbl.append(tRow);
        }   // end of populating data

        $(".editRecordLink").on({
          click: editRecord
      	})


        function editRecord(){
            var bookingrefno = $(this).attr("id");
            var firstname = $(this).attr("data-firstName");
			var lastname = $(this).attr("data-lastName");
            var email = $(this).attr("data-email");
            var roomname = $(this).attr("data-roomName");
            var roomtype = $(this).attr("data-roomType");
            var roomprice = $(this).attr("data-roomPrice");
            var addpersonprice = $(this).attr("data-addPersonPrice");
            var numperson = $(this).attr("data-numPerson")
           	var checkin = $(this).attr("data-checkIn");
           	var checkout = $(this).attr("data-checkOut");
           	var expectedperson = $(this).attr("data-expectedPerson");
            var bStat = $(this).attr("data-bStat");
            
            $('#edit-bookinrefno').val(bookingrefno);
            $('#edit-firstName').val(firstname);
            $('#edit-lastName').val(lastname);
            $('#edit-email').val(email);

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
            $('#edit-roomPrice').val(roomprice);
            $('#edit-addPersonPrice').val(addpersonprice);
             $('#edit-numPerson').val(numperson);
            $('#edit-checkIn').val(checkin);
            $('#edit-checkOut').val(checkout);
			$('#edit-expectedPerson').val(expectedperson);
            $('#edit-bStat').val(bStat);
      }


 });
</script>