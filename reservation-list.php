<?php
    include 'header.php';
    if($_SESSION['userStatus']<>1){
      session_destroy();
      header("Location: ../felicity/");
    }
    include 'navbar.php';
    //echo $_SESSION['userStatus'];
?>
<!-- Table that displays the record list -->
	<br><h3>Reservation List</h3><br>
	<div class="panel panel-default">
	  <div class="panel-heading"></div>
	  <div class="panel-body">
		  <table class="table table-hover table-responsive" id="item-list-tbl">
			<thead>
			   <tr>
				  <th>Reservation ID</th>
				  <th>First Name</th>
				  <th>Last Name</th>
				  <th>Email</th>
				  <th>Room Type</th>
     		      <th>Room Name</th>
    		      <th>Room Price</th>
              <th>Maximum Number of Person</th>
     		      <th>Exceed person payment</th>
          <th>Expected Person Count</th>
          <th>Total Price</th>
				  <th>Check In</th>
				  <th>Check Out</th>
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

  $selectquery = "SELECT reservationID, c.firstName, c.lastName, c.email, r.roomType, rd.roomName, rd.roomPrice, rd.addPersonPrice,rd.noOfperson, checkIn, checkOut, expectedPerson, totalPrice, reservationDate, rsd.status as rsdStat from reservation_details rsd join customer c on rsd.customerID = c.customerID join room_details rd on rsd.roomName=rd.roomName join room r on rd.roomTypeId = r.roomTypeId WHERE rsd.status='Pending' OR rsd.status='Cancelled' Group by rsd.roomName";

  $res = mysqli_query($conn, $selectquery);
  $data[]='';
  if(mysqli_num_rows($res) > 0){
    $x=0;
      while($result = mysqli_fetch_assoc($res)){
        $data[$x] = $result;
        $x++;
      }
  }else{
    $data[0] = 0;
  }

?> <!-- end of record list php -->


<script type="text/javascript"> //Javascript/jquery when opening document
  $(document).ready(function(){

    var data = <?php echo json_encode($data) ?>; // Populate record data in table using the data from php query
    if(data[0]==0){
      var itemTbl = $("#item-tbl-body");
      itemTbl.html("");
      var tRow = "<i>No pending reservation/s.</i>";
      itemTbl.append(tRow);
    }else{
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
                 tRow += "<td class='tbl-num'>" + data[x].roomType + "</td>";
                 tRow += "<td class='tbl-num'>" + data[x].roomName + "</td>";
                 tRow += "<td class='tbl-num'>" + data[x].roomPrice + "</td>";
                 tRow += "<td class='tbl-num'>" + data[x].noOfperson + "</td>";
                 tRow += "<td class='tbl-num'>" + data[x].addPersonPrice + "</td>";
                 tRow += "<td class='tbl-num'>" + data[x].expectedPerson + "</td>";
                 tRow += "<td class='tbl-num'>" + data[x].totalPrice + "</td>";
                 tRow += "<td class='tbl-num'>" + data[x].checkIn + "</td>";
                 tRow += "<td class='tbl-num'>" + data[x].checkOut + "</td>";
                 tRow += "<td class='tbl-num'>" + data[x].reservationDate + "</td>";
                 tRow += "<td class='tbl-num'>" + data[x].rsdStat + "</td>";

                 if(data[x].rsdStat == 'Pending'){
                    tRow += "<td class='tbl-num'>" + "<button type='button' title='Approve Reservation' class='btn btn-sm btn-default approve' data-id='"+reservationId+"'><i class='fa fa-check' style='color:green;'></i></button><button type='button' title='Remove Reservation' class='btn btn-sm btn-default cancelBooking' id='"+reservationId+"'><i class='fa fa-times' style='color:red;'></i></button>" + "</td>";
                 }else{
                    tRow += "<td class='tbl-num'>" + "<button type='button' title='Approve Cancellation' class='btn btn-sm btn-default cancelBooking' id='"+reservationId+"'><i class='fa fa-check' style='color:green;'></i></button>" + "</td>";
                 }
                 tRow += "</tr>";

              itemTbl.append(tRow);
          }         // end of populating data

        $(".approve").on({
            click: approve
        })

        $(".cancelBooking").on({
            click: cancelBooking
        })

    }
      function approve(){
    
       var reservationId = $(this).attr("data-id");
	     console.log("reservationID: " + reservationId);
		

      $.ajax({
            url: "res-function.php",
            method: "POST",
            data: {
              action: 'reserveId',
              reserveId: reservationId
            },
            success: function(response){
              //var data = JSON.parse(response);
              console.log(response);
              //console.log(data);
              alert("Booked!");
              location.reload();
            },
            error: function(response){
              console.log(response);
            }
           
          })
      
     }

      function cancelBooking(){
          
      var reservationId = $(this).attr("id");
      if(confirm('Cancel reservation?')==true){
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

  });

</script>