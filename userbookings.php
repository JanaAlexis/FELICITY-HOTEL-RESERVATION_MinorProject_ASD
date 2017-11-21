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
			  <tbody id="reserve-tbl-body">
				<!-- to be filled dynamically -->
			  </tbody>
		  </table>
	  </div>
	</div>

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
				  <th>Total Price</th>
				  <th>Status</th>
				<!--  <th>Update</th> -->
				</tr>
			  </thead>
			  <tbody id="book-tbl-body">
				<!-- to be filled dynamically -->

				

			  </tbody>
		  </table>
	  </div>
	</div>
<!-- end of display list -->

<?php
    include 'footer.php';
?>


<!--reservation-->

<?php //PHP query for getting reservation list

$user = $_SESSION['userId'];


  $resquery = "SELECT reservationID, c.firstName, c.lastName, c.email, r.roomType, rd.roomName, rd.roomPrice, rd.addPersonPrice,rd.noOfperson ,checkIn,checkOut, expectedPerson,reservationDate, rsd.status as rsdStat from reservation_details rsd join customer c on rsd.customerID = c.customerID join room_details rd on rsd.roomName=rd.roomName join room r on rd.roomTypeId = r.roomTypeId WHERE  rsd.customerID = '$user' AND rsd.status='Pending' Group by rsd.roomName";
  $res = mysqli_query($conn, $resquery);
  $resdata;
  if($res){
    $x=0;
      while($resresult = mysqli_fetch_assoc($res)){
        $resdata[$x] = $resresult;
        $x++;
        
        
      }
  }
?> <!-- end of reservation list php -->


<?php //PHP query for getting book list

  $bookquery = "SELECT bookingRefNo, c.firstName, c.lastName, c.email, r.roomType, rd.roomName, rd.roomPrice, rd.addPersonPrice,rd.noOfperson ,checkIn,checkOut, bd.noOfperson as bookedPerson,totalPrice, bd.status as bStat from booking_details bd join customer c on bd.customerID = c.customerID join room_details rd on bd.roomName=rd.roomName join room r on rd.roomTypeId = r.roomTypeId WHERE  bd.customerID = '$user' GROUP BY bd.roomName";
  $bookres = mysqli_query($conn, $bookquery);
  $bookdata;
  if($bookres){
    $x=0;
      while($bookresult = mysqli_fetch_assoc($bookres)){
        $bookdata[$x] = $bookresult;
        $x++;
      }
  }

?> <!-- end of Book list php -->


<script type="text/javascript"> //Javascript/jquery when opening document
  $(document).ready(function(){

    var resdata = <?php echo json_encode($resdata) ?>; // Populate record data in table using the data from php query
   	console.log(resdata);

      var rsvTbl = $("#reserve-tbl-body");
      rsvTbl.html("");
      var reservationId = 0;

         for(var x=0;x<resdata.length;x++){
          reservationId=resdata[x].reservationID;
           var tRow = "<tr>";
               tRow += "<td>" + resdata[x].reservationID + "</td>";
               tRow += "<td>" + resdata[x].firstName + "</td>";
               tRow += "<td>" + resdata[x].lastName + "</td>";
               tRow += "<td>" + resdata[x].email + "</td>";
               tRow += "<td>" + resdata[x].roomType + "</td>";
               tRow += "<td>" + resdata[x].roomName + "</td>";
               tRow += "<td class='tbl-num'>" + resdata[x].roomPrice + "</td>";
               tRow += "<td class='tbl-num'>" + resdata[x].addPersonPrice + "</td>";
               tRow += "<td class='tbl-num'>" + resdata[x].noOfperson + "</td>";
               tRow += "<td>" + resdata[x].checkIn + "</td>";
               tRow += "<td>" + resdata[x].checkOut + "</td>";
               tRow += "<td class='tbl-num'>" + resdata[x].expectedPerson + "</td>";
               tRow += "<td>" + resdata[x].reservationDate + "</td>";
               tRow += "<td>" + resdata[x].rsdStat + "</td>";
               tRow += "<td>" + "<button type='button' title='Cancel' class='btn btn-danger cancel' id='"+reservationId+"'><span class='glyphicon glyphicon-trash'></span></button>" + "</td>";
               tRow += "</tr>";

         rsvTbl.append(tRow);
        }   // end of populating data

         $(".cancel").on({
          click: cancelReservation
   	    })

		function cancelReservation(){
        var reservationId = $(this).attr("id");

	      if(confirm('Cancel reservation?')==true){
	          console.log("reservationID: " + reservationId);
	    

	          $.ajax({
	              url: "res-function.php",
	              method: "POST",
	              data: {
	                action: 'cancel',
	                cancel: reservationId
	              },
	              success: function(response){
	                console.log(response);
	                alert("Cancelled!");
	                location.reload();
	              },
	              error: function(response){
	                console.log(response);
	              }
	             
	            })

	      }else{
	        location.reload();
	      }
	        

	     }


	    var bookdata = <?php echo json_encode($bookdata) ?>; // Populate record data in table using the data from php query
	
		var bookTbl = $("#book-tbl-body");
    	bookTbl.html("");
      	for(var x=0;x<bookdata.length;x++){
          bookingrefno=bookdata[x].bookingRefNo;
           var tRow = "<tr>";
               tRow += "<td>" + bookdata[x].bookingRefNo + "</td>";
               tRow += "<td>" + bookdata[x].firstName + "</td>";
               tRow += "<td>" + bookdata[x].lastName + "</td>";
               tRow += "<td>" + bookdata[x].email + "</td>";
               tRow += "<td>" + bookdata[x].roomName + "</td>";
               tRow += "<td class='tbl-num'>" + bookdata[x].roomType + "</td>";
               tRow += "<td class='tbl-num'>" + bookdata[x].roomPrice + "</td>";
               tRow += "<td class='tbl-num'>" + bookdata[x].addPersonPrice + "</td>";
               tRow += "<td class='tbl-num'>" + bookdata[x].noOfperson + "</td>";
               tRow += "<td>" + bookdata[x].checkIn + "</td>";
               tRow += "<td>" + bookdata[x].checkOut + "</td>";
               tRow += "<td class='tbl-num'>" + bookdata[x].bookedPerson + "</td>";
               tRow += "<td class='tbl-num'>" + bookdata[x].totalPrice + "</td>";
               tRow += "<td class='tbl-num'>" + bookdata[x].bStat + "</td>";

        bookTbl.append(tRow);
        }   // end of populating data




	});
	
</script>
