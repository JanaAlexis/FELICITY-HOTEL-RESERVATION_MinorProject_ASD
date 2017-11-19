<?php
    include 'header.php';
    include 'navbar.php';
    //echo $_SESSION['userStatus'];
?>
<!-- Table that displays the record list -->
	<br><h3>Reservation List</h3><br>
	<div class="panel panel-default">
	  <div class="panel-heading"></div>
	  <div class="panel-body">
		  <table class="table table-hover" id="item-list-tbl">
			<thead>
			   <tr>
				  <th>Reservation ID</th>
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
				  <th>Reservation Date</th>
				  <th>Status</th>
				  <th>Action</th>
				<!--  <th>Update</th> -->
				</tr>
			  </thead>
			  <tbody id="item-tbl-body">
				<!-- to be filled dynamically -->


				
			  </tbody>
		  </table>
	  </div>
	</div>

<?php
    include 'footer.php';
?>

<?php //PHP query for getting record list

  $selectquery = "SELECT reservationID, c.firstName, c.lastName, c.email, r.roomType, rd.roomName, rd.roomPrice, rd.addPersonPrice,rd.noOfperson ,checkIn,checkOut, expectedPerson,reservationDate, rsd.status as rsdStat from reservation_details rsd join customer c on rsd.customerID = c.customerID join room_details rd on rsd.roomID=rd.roomID join room r on rd.roomTypeId = r.roomTypeId";
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
      var reservationId = 0;

         for(var x=0;x<data.length;x++){
          reservationId=data[x].reservationID;
           var tRow = "<tr>";
               tRow += "<td>" + data[x].reservationID + "</td>";
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
               tRow += "<td class='tbl-num'>" + data[x].reservationDate + "</td>";
               tRow += "<td class='tbl-num'>" + data[x].rsdStat + "</td>";
               tRow += "<td class='tbl-num'>" + "<button type='button' title='Approve' class='btn btn-info approve' data-id='"+reservationId+"'><span class='glyphicon glyphicon-edit'></span></button><button type='button' title='Cancel' class='btn btn-danger cancelBooking' id='"+reservationId+"'><span class='glyphicon glyphicon-trash'></span></button>" + "</td>";
         /*     tRow += "<td><div class='actions-menu'><button type='button' class='btn btn-sm btn-default editRecordLink' data-reservationId='"+data[x].reservationId+"' data-firstName='"+data[x].firstName+"' data-lastName='"+data[x].lastName+"' data-email='"+data[x].email+"' data-roomName='"+data[x].roomName+"' data-roomType='"+data[x].roomType+"' data-roomPrice='"+data[x].roomPrice+"' data-addPersonPrice='"+data[x].addPersonPrice+"' data-numPerson='"+data[x].noOfperson+"' data-checkIn='"+data[x].checkIn+"' data-checkOut='"+data[x].checkOut+"' data-expectedPerson='"+data[x].expectedPerson+"' data-reservationDate='"+data[x].reservationDate+"' data-revStat='"+data[x].rsdStat+"' data-toggle='modal' data-target='#editroom-modal' id='"+reservationId+"'><i class='fa fa-edit' style='color:green;'></i></button></div></td>";
       
          */
               tRow += "</tr>";

         itemTbl.append(tRow);
        }   // end of populating data
    

      $(".editRecordLink").on({
          click: editRecord
      })

      $(".approve").on({
          click: approve
      })

      $(".cancelBooking").on({
          click: cancelBooking
      })


      function editRecord(){
            var reservationId = $(this).attr("id");
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
           	var reservationdate = $(this).attr("data-reservationDate");
            var rsdStat = $(this).attr("data-rsdStat");
            
            $('#edit-reservationId').val(reservationId);
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
			$('#edit-expectedperson').val(expectedperson);
            $('#edit-reservationDate').val(reservationdate);
            $('#edit-rsdStat').val(rsdStat);
      }

      function approve(){
    //  	var arrRsdId = [];
      	var reservationId = $(this).attr("data-id");
	    console.log("reservationID: " + reservationId);
		//arrRsdId.push(reservationId);
    //    console.log("array: "+ arrRsdId);

        $.ajax({
            url: "res-function.php",
            method: "POST",
            data: {
              action: 'reserveId',
              reserveId: reservationId
            },
            success: function(response){
              //console.log(response);
              alert("Booked!");
            },
            error: function(response){
              console.log(response);
            }
           
          })

     }

      function cancelBooking(){
          
      var reservationId = $(this).attr("id");
      if(confirm('Are you want to cancel reservation?')==true){
          console.log("reservationID: " + reservationId);
    

          $.ajax({
              url: "res-function.php",
              method: "POST",
              data: {
                action: 'removeId',
                removeId: reservationId
              },
              success: function(response){
                console.log(response);
                //alert("Cancelled!");
              },
              error: function(response){
                console.log(response);
              }
             
            })

      }else{
        location.reload();
      }
        

     }

  });

</script>