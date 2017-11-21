<?php
    include 'header.php';
    if($_SESSION['userStatus']<>1){
    	session_destroy();
    	header("Location: ../felicity/");
    }
    include 'navbar.php';
    //echo $_SESSION['userStatus'];
?>

<div class="container-fluid container-padding">
	<div class="row">
		<div class="col-lg-12">
			<!-- Table that displays the record list -->
			<h3>Customer Details</h3>
			<div class="panel panel-default">
			  <div class="panel-heading"></div>
			  <div class="panel-body">
				  <table class="table table-hover" id="item-list-tbl">
					<thead>
					   <tr>
						  <th id="th-custId">UserID</th>
						  <th>First Name</th>
						  <th>Last Name</th>
						  <th>Email</th>
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
		</div>
	</div>
</div>
<!-- Confirm customer status modal -->
<div id="updateStatus-modal" class="modal fade in" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #f5f5f5;">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <h4>Customer Update</h4>
			  </div>
			  <div class="modal-body" style="background-color: #f5f5f5;">
			  	<form method="post" action="admin-functions.php?action=updatestat">
				  	<div class="form-group">
					  	<input type="hidden" id="update-custId" name="custId"/></br>
					  	<label id="uName" style="font-size: 14px; letter-spacing: 2px;"></label></br></br>
					  	<label>Status</label>
					  	<div class='dropdown center'>
					  		<select class= 'btn btn-sm btn-info' name='custStatus'>
					  			<option value='Activated'>Activate</option>
					  			<option value='Deactivated'>Deactivate</option>
					  			<option value='Archived'>Archive</option>
					  		</select>
					  	</div>
				  	</div></br>
				  	
				  	<button class="btn btn-secondary pull-right" type="button" class="close" data-dismiss="modal"> Cancel </button>
				  	<button class="btn btn-info pull-right" type="submit" name="submit"> Update </button>
			  </form>
			  </div>
			</div>
	</div>
</div>
<!-- end of confirm customer status modal -->


<?php
    include 'footer.php';
?>

<?php //PHP query for getting record list

  $selectquery = "SELECT `customerID`, `firstName`, `lastName`, `email`, `status` as custStatus FROM `customer` WHERE status <> 'Archived'";
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
    var custId = 0;
    var custStat="";

       for(var x=0;x<data.length;x++){

				custId = data[x].customerID;

         var tRow = "<tr>";
         tRow += "<td id='td-custId' class='tbl-center'>" + custId + "</td>";
         tRow += "<td>" + data[x].firstName + "</td>";
         tRow += "<td>" + data[x].lastName + "</td>";
         tRow += "<td>" + data[x].email + "</td>";
         tRow += "<td class='tbl-center'>" + data[x].custStatus + "</td>";

         tRow += "<td  class='tbl-center'><div class='actions-menu'><button type='button' class='btn btn-sm btn-default editStatusLink' data-toggle='modal' data-target='#updateStatus-modal' data-fname='"+data[x].firstName+"' data-lname='"+data[x].lastName+"' id='"+custId+"'><i class='fa fa-edit' style='color:green;'></i></button></div></td>";
         tRow += "</tr>";

       itemTbl.append(tRow);
      }


      $(".editStatusLink").on({
          click: editStatus
      })

      function editStatus(){
      	var custId = $(this).attr('id');
      	var fname = $(this).attr('data-fname');
      	var lname = $(this).attr('data-lname');
      	var name = lname + ",   " + fname;
      	console.log(custId);
      	$('#update-custId').val(custId);
      	$('#uName').text(name);
      }
  });

</script>