<?php
	include 'header.php';
	if($_SESSION['userStatus']<>1){
    	session_destroy();
    	header("Location: ../felicity/");
    }
	include 'navbar.php';

?>

<!-- Table that displays the record list -->
	<h3>Booked List</h3>
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
				  <th>Total booked person</th>
				  <th>Total Price</th>
				  <th>Check In</th>
				  <th>Check Out</th>
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
<!-- end of display list -->

<!-- 	payment   -->
<div id="payment-modal" class="modal fade in" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-sm" role="document">
		  <div class="modal-content">

			  <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <h4 class="modal-title">Payment</h4>
			  </div>

			  <div class="modal-body">
				  <!-- Label shows if some data entered is invalid -->
				  <label class="label label-danger" id="datainvalid"></label>
					  
					<div class="form-group">    

						<input type="hidden" id="book-refno" class="payment-info"/>
						<input type="hidden" id="cust-id"  class="payment-info"/>
						<input type="hidden" id="total"  class="payment-info"/>
						<input type="hidden" id="room"  class="payment-info"/>


						  <label>Payment Type</label>

						  <div class="dropdown">
							  <select class= "btn btn-sm btn-info payment-info" name="paymentType" id="category">
								  <option value="1">Cash</option>
								  <option value="2">Credit</option>
								  <option value="3">Debit</option>
							</select>
						  </div><br>

						  <label>Name: </label>
						  <span id="fname1"></span>
						  <span id="lname1"></span> <br>
						  <label>ID: </label>
						  <span id="custId"></span> <br>
						  
						  <label id="lblamount">Amount</label>
						  <span><i>  </i></span><input type="number" id="amount" class="form-control payment-info" min="0" step="0.01" value="0.00" name="amount"/></br>

						  <label id="lblpayDate">Payment Date</label>
			           	  <input type="date" id="payDate" class="form-control payment-info" placeholder="Payment Date" name="paymentDate" value="<?php echo date('Y-m-d') ?>" readonly /></br>

						  <div id="cardInputs">
							  <label id="lblchName">Card Holder Name</label>
							  <input type="text" id="chName" class="form-control card-info" placeholder="card holder name" name="chName" required /></br>
							 
							  <label id="lblcName">Card Name</label>
							  <input type="text" id="cName" class="form-control card-info" placeholder="Card name" name="cName" required /></br>
							
							  <label id="lblcNum">Card Number</label>
							  <input type="number" id="cNum" class="form-control card-info" min="0" placeholder="Card number" name="cNum" required /></br>
							
							  <label id="lblrefNum">Reference Number</label>
							  <input type="number" id="refNum" class="form-control card-info" min="0"  placeholder="Reference number" name="refNum" required />
						  </div></br>

						  	<button class="btn btn-info pull-right" id="btnSubmit"> Submit </button>
					</div>
				
			  </div>
		  </div>
	  </div>
	</div>                      
	<!-- end of payment modal -->

<?php
    include 'footer.php';
?>

<?php //PHP query for getting record list

  $selectquery = "SELECT bookingRefNo, c.customerID, c.firstName, c.lastName, c.email, r.roomType, bd.roomName, rd.roomPrice, rd.addPersonPrice,rd.noOfperson,bd.noOfperson as numBookPerson, bd.totalPrice, checkIn,checkOut, bd.status as bStat from booking_details bd join customer c on bd.customerID = c.customerID join room_details rd on bd.roomName=rd.roomName join room r on rd.roomTypeId = r.roomTypeId Group by bd.roomName";
  $res = mysqli_query($conn, $selectquery);

  $data;

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


  	loadDisplayTable();

  	$("#btnSubmit").on({
		click: recordPayment
	})


  	function loadDisplayTable(){
  		var data = <?php echo json_encode($data) ?>; // Populate record data in table using the data from php query
	   	if(data[0]==0){

	      var itemTbl = $("#item-tbl-body");
	      itemTbl.html("");
	      var tRow = "<i>No booking/s in file.</i>";
	      itemTbl.append(tRow);

	    }else{
		   	var itemTbl = $("#item-tbl-body");
		      itemTbl.html("");
		      var bookingrefno = 0;
		      var stat = "";
		         for(var x=0;x<data.length;x++){

		          bookingrefno=data[x].bookingRefNo;
		          stat = data[x].bStat;
		           var tRow = "<tr>";
		               tRow += "<td>" + data[x].bookingRefNo + "</td>";
		               tRow += "<td>" + data[x].firstName + "</td>";
		               tRow += "<td>" + data[x].lastName + "</td>";
		               tRow += "<td>" + data[x].email + "</td>";
		               tRow += "<td>" + data[x].roomName + "</td>";
		               tRow += "<td>" + data[x].roomType + "</td>";
		               tRow += "<td class='tbl-num'>" + data[x].roomPrice + "</td>";
		               tRow += "<td class='tbl-num'>" + data[x].addPersonPrice + "</td>";
		               tRow += "<td class='tbl-num'>" + data[x].noOfperson + "</td>";
		               tRow += "<td class='tbl-num'>" + data[x].addPersonPrice + "</td>";
		               tRow += "<td class='tbl-num'>" + data[x].totalPrice + "</td>";
		               tRow += "<td>" + data[x].checkIn + "</td>";
		               tRow += "<td>" + data[x].checkOut + "</td>";
		               tRow += "<td>" + data[x].bStat + "</td>";

		               if(stat == "Check-out"){
		          	   		tRow += "<td><button class='btn btn-default'><i class='fa fa-code' style='color:black;'></i></button></td>";
		               }else{

		               		tRow += "<td><button type='button' title='Check-out' class='btn btn-default payment' data-id='"+bookingrefno+"' data-custid='"+data[x].customerID+"' data-room='"+data[x].roomName+"' data-price='"+data[x].totalPrice+"' data-firstName='"+data[x].firstName+"' data-lastName='"+data[x].lastName+"' data-toggle='modal' data-target='#payment-modal'><i class='fa fa-share' style='color:green;'></i></button></td>";
		               }

		          	   tRow += "</tr>";

		        itemTbl.append(tRow);
		        }   // end of populating data

		        $('#cardInputs').hide();

		        $(".payment").on({
		          click: displayPaymentModal
		      	})
	    }
  	}
    

    function displayPaymentModal(){

		var bookingrefno = $(this).attr("data-id");
		console.log("refno: " +bookingrefno);
		var custid = $(this).attr("data-custid");
		var price = $(this).attr("data-price");
		var room = $(this).attr("data-room");
	    var firstname = $(this).attr("data-firstName");
		var lastname = $(this).attr("data-lastName");
		$("#fname1").text(firstname);
		$("#lname1").text(lastname);
		$("#custId").text(custid);

		$("#book-refno").val(bookingrefno);
		$("#cust-id").val(custid);
		$("#total").val(price);
		$("#room").val(room);


	}

	function recordPayment(){
		var paymentInfo = document.getElementsByClassName('payment-info');
		var cardInfo = document.getElementsByClassName('card-info');
		var payment = [];
		var card = [];
		var cardNo = $('#cNum').val();
		var cat = $('#category').val();
		console.log("cat: "+ cat);
		console.log("cNum: "+ cardNo.length);

		if(cardNo.length==16){

			for(var x in paymentInfo){
			payment.push(paymentInfo[x].value);
			}
			for(var x in cardInfo){
				card.push(cardInfo[x].value);
			}

	
			$.ajax({
	            url: "res-function.php",
	            method: "POST",
	            data: {
	              action: 'recordPayment',
	              arrDetails: payment,
	              cardDetails: card
	            },
	            success: function(response){
	              //var data = JSON.parse(response);
	              console.log(response);
	              //console.log(data);
	              alert("Success!");
	              location.reload();
	            },
	            error: function(response){
	              console.log(response);
	            }
	       
	        })

		}else{

			alert('Card number should have 16-digits.');
		}


	}

   	

	$('#category').change(function(){

		var value = $('#category').val(); /* id of dropdown menu */
		if(value == 1){
			$('#cardInputs').hide();
		}else{
			$('#cardInputs').show();
		}

	});



});

</script>