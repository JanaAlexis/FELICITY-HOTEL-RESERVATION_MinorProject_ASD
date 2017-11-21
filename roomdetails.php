 <?php
  include ('config/config.php');
  include 'header.php';
  include 'navbar.php';

 ?>
<div class="container-fluid">
    <div class="col-md-12">
      <div align="center" class="date-div">
          <label>Select Check-in Date: </label>
          <input type="date" style="text-align: center;" placeholder="yyyy-mm-dd" value="<?php echo date('Y-m-d') ?>" name="checkInDate" id="checkInDate">
          <button class="btn btn-warning btn-sm" id="searchDate">Go</button>
      </div>
    </div>
    <h1 align="center" style="letter-spacing: 15px;">ROOM LIST</h1><br>
    <div class="col-md-12" id="roomImgs">
<?php
		$query = "SELECT roomID, r.roomType from room_details rd join room r on rd.roomTypeId = r.roomTypeId";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
           if(mysqli_num_rows($result) > 0){  
              $data = [];
              $x = 0;
              while($row = mysqli_fetch_array($result)){  //fetch all rows at once
                $data[$x] = $row;

?>
            <div class="col-md-3 img-grid">
              <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="left">  
                <img src="showimage.php?msg=<?php echo $data[$x]['roomID'] ?>" class="img-responsive" /></br>
              </div>
            </div>
<?php
                $x++;
            }
          }
?>
  </div> <!-- End col-lg-12 -->

  <div id="roomdetail-display" class="col-md-12"></div> <!-- parent element for populating room list -->

    <button id="btnBook" class="btn btn-primary fixed-btn">Complete Reservation >>> </button>

<!-- Confirm reservation modal -->
<div id="booking-modal" class="modal fade in" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #f5f5f5;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4>Confirm Reservation</h4>
        </div>
        <div class="modal-body" style="background-color: #f5f5f5;">
          
            <div id="resForm">
              
            </div></br>
        
        </div>
      </div>
  </div>
</div>
<!-- end of confirm reservation modal -->

</div> <!-- End container-fluid -->


<?php
    include 'footer.php';
?>

  <script type="text/javascript"> //Javascript/jquery when opening document
  $(document).ready(function(){

    alert("Select Check-in date to view room details.");

      var rName = "";
      var checkInDate = "";

      $("#searchDate").on({
          click: displayRooms
      })


      $("#btnBook").on({
          click: bookRoom
      })


      function displayRooms() {
         checkIndate = document.getElementById("checkInDate").value;
        console.log(checkIndate);

            $.ajax({
            url: "getResData.php",
            method: "POST",
            data: {
              action: 'checkAvailable',
              checkIndate: checkIndate
            },
            success: function(response){
              var data = JSON.parse(response);
            // console.log(data);
            // console.log(response);
              $('#roomImgs').hide();
              populateRooms(data);
            },
            error: function(response){
              console.log(response);
            }
           
          })

      }

      function populateRooms(data){
          var data = data;
          //console.log(data.length);

          var displayDiv = $("#roomdetail-display");
          displayDiv.html("");
          var roomId = 0;
          var z = data.length - 1;
          //console.log(z);
          for(var x=0;x<data.length;x++){
       
           roomId = data[x].roomID;
           var tRow = "<div class='col-md-3 img-grid'>";

           tRow += "<img src='showimage.php?msg=" + roomId + "' class='img-responsive'/>";
           tRow += "<div align='center'><h4>"+ data[x].roomType.toUpperCase(); + "</h4></div>";
           tRow += "</br></br><label class='lbl-roomdetails'>Single bed/s : </label>";
           tRow += "<span>" + data[x].bedCount + "</span></br>";
           tRow += "<label class='lbl-roomdetails'>Double bed/s : </label>";
           
           if(x!=z){
              tRow += "<span>" + data[x+1].bedCount + "</span></br>";
           }else{
              tRow += "<span>" + data[x].bedCount + "</span></br>";
           }

           tRow += "<label class='lbl-roomdetails'>Pax : </label>";
           tRow += "<span>" + data[x].noOfperson + "</span></br>";
           tRow += "<label class='lbl-roomdetails'>Extra Person : </label>";
           tRow += "<span>" + data[x].addPersonPrice + "</span></br>";
           tRow += "<label class='lbl-roomdetails'>Room Price : </label>";
           tRow += "<span>" + data[x].roomPrice + "</span></br>";
           
           tRow += "<div class=''><button type='button' class='btnReserve' data-name ='"+ data[x].roomName +"' data-id='"+roomId+"' style='letter-spacing:2px; margin-top:5px; background-color: black; color: yellow; width: 50%;'>Reserve</button></div>";
           tRow += "</div>";

            displayDiv.append(tRow);
            x++;
          }   // end of populating data

          $(".btnReserve").on({
              click: reserveRoom
          })
          
      }


      function reserveRoom(){ //store selected rooms in array for query later
        var userStat = "<?php echo $_SESSION['userStatus'] ?>";
        console.log("user: " + userStat);

        if(userStat==0 || userStat==1){

          alert("Please log in as customer to continue. Thank you.");
          location.reload();

        }else{
            rName = $(this).attr('data-name');
            console.log("roomName: "+ rName);
        }
      }

      function bookRoom(){

        if(rName==""){

          alert("Select a room first.");

        }else{

          $('#booking-modal').modal('toggle');
          //console.log(arrId);

          $.ajax({
            url: "getResData.php",
            method: "POST",
            data: {
              action: 'reserveIds',
              rName: rName
            },
            success: function(response){
              var data = JSON.parse(response);
              //console.log(data);
              displayBookingModal(data);

            },
            error: function(response){
              console.log(response);
            }
           
          })

        }
      }

      function displayBookingModal(data){
          var data = data;
          var displayDiv = $("#resForm");
          displayDiv.html("");
          var tRow = "";

          for(var x=0;x<data.length;x++){
           
           tRow += "<label >Room Type : </label>";
           tRow += "<span>"+ data[x].roomType + "</span></br>";
           tRow += "<label >Room Name : </label>";
           tRow += "<span>"+ data[x].roomName + "</span></br>";
           tRow += "<label >Bed Count : </label>";
           tRow += "<span>" + data[x].bedCount + "</span></br>";
           tRow += "<label>Pax : </label>";
           tRow += "<span>" + data[x].noOfperson + "</span></br>";
           tRow += "<label>Extra Rate per Person : </label>";
           tRow += "<span>" + data[x].addPersonPrice + "</span></br>";
           tRow += "<label>Room Price : </label>";
           tRow += "<span>" + data[x].roomPrice + "</span></br>";
           tRow += "<span>------------</span></br>";
           
          }
          tRow += "</br><label>Expected No. of Person : </label>";
          tRow += "<input type='number' style='text-align: center;' min='1' value='1' class='date-info' required/>";
          tRow += "<label>Check-in Date : </label>";
          tRow += "<input type='date' style='text-align: center; color: gray;' placeholder='yyyy-mm-dd' value='"+ checkIndate +"' class='date-info' readonly/>";
          tRow += "</br><label>Check-out Date : </label>";
          tRow += "<input type='date' style='text-align: center;' placeholder='yyyy-mm-dd' class='date-info' required /></br>";

          tRow += "<div class=''><button type='button' class='btn btn-success btn-sm pull-right btnConfirm'>Submit</button></div>";

            displayDiv.append(tRow);

          $(".btnConfirm").on({
            click: confirmBooking
          })
      }

      function confirmBooking(){
        //console.log(arrId);
        var dateInfo = [];
        var dates = document.getElementsByClassName("date-info");
        
          dateInfo.push(dates[0].value);
          dateInfo.push(dates[1].value);
          dateInfo.push(dates[2].value);
       
        //console.log(dateInfo);
        if(dates[2].value=="" || dates[0].value < 0){

          alert("Please enter a valid data.");

        }else{

          $.ajax({
            url: "getResData.php",
            method: "POST",
            data: {
              action: 'confirmRes',
              resvRoom: rName,
              dateInfo: dateInfo
            },
            success: function(response){
              //var data = JSON.parse(response);
              //console.log(data);
              console.log(response);
              $('#booking-modal').modal('toggle');
              alert("Reservation complete. Thank you.");
              location.reload();
            },
            error: function(response){
              console.log(response);
            }
           
          })
        }
        
      }
    
  });

</script>