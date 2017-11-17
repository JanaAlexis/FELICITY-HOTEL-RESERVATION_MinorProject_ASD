<?php
    include_once('config/config.php');
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        switch($_GET["action"]){
            
            case "add":
                    //Get records from modal
                    $roomtype = $_POST['roomType'];
                    $roomname = $_POST['roomName'];
                    $single = $_POST['singleBed'];
                    $double = $_POST['doubleBed'];
                    $persons  = $_POST['numPersons'];
                    $roomprice  = $_POST['roomPrice'];
                    $addpersonprice  = $_POST['addPersonPrice'];
                    $status = $_POST['roomStatus'];
                    
                    $roomname = strtoupper($roomname);

                    $query;

                    
                  if(is_uploaded_file($_FILES['image']['tmp_name'])) {
                   
                    //echo $_FILES['image']['tmp_name'];
                    if($single > 0 || $double > 0){

                        $selectquery ="SELECT roomName from room_details where roomName ='$roomname'";

                        $selectRes = mysqli_query($conn, $selectquery);
                        $row = mysqli_fetch_assoc($selectRes);
                        
                        if(empty($row)){

                          $imgData =addslashes(file_get_contents($_FILES['image']['tmp_name']));
                          $imageProperties = getimageSize($_FILES['image']['tmp_name']);

                            if($single > 0){

                                $query = "INSERT INTO room_details (roomName, roomTypeId, bedID, bedCount, noOfperson, roomPrice, addPersonPrice, imgType, imgData, status) VALUES ('$roomname','$roomtype','1','$single','$persons','$roomprice','$addpersonprice','{$imageProperties['mime']}', '{$imgData}', '$status')";
                               $insertquery = mysqli_query($conn, $query) or die(mysqli_error($conn));

                            }
                            if($double > 0){
                               $query = "INSERT INTO room_details (roomName, roomTypeId, bedID, bedCount, noOfperson, roomPrice, addPersonPrice, imgType, imgData, status) VALUES ('$roomname','$roomtype','2','$double','$persons','$roomprice','$addpersonprice','{$imageProperties['mime']}', '{$imgData}', '$status')";
                               $insertquery = mysqli_query($conn, $query) or die(mysqli_error($conn));
                            }
                            header("Location: admindashboard-roomdetails.php");

                        }else{
                          header("Location: admindashboard-roomdetails.php?page=addroom&msg=existing");
                        }

                    }else{
                        header("Location: admindashboard-roomdetails.php?page=addroom&msg=invalidnum");
                    }

                }else{
                  header("Location: admindashboard-roomdetails.php?page=addroom&msg=noimg");
                } 
            break;

            case "update":
                    //Get records from edit record modal
                    $roomId = $_POST['roomId'];
                    $roomtype = $_POST['roomType'];
                    $roomname = $_POST['roomName'];
                    $single = $_POST['singleBed'];
                    $double = $_POST['doubleBed'];
                    $persons  = $_POST['numPersons'];
                    $roomprice  = $_POST['roomPrice'];
                    $addpersonprice  = $_POST['addPersonPrice'];
                    $status = $_POST['roomStatus'];
                    $roomnameDB;
                    
                    $roomname = strtoupper($roomname); //Set room name to always be capital letters
                 
                    if($single > 0 || $double > 0){ //Catch invalid num count of beds

                        //Get room name for update
                      $query = "SELECT roomName from room_details WHERE roomID = '$roomId'";
                            $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
                            $row = mysqli_fetch_assoc($res);
                            $roomnameDB = $row['roomName'];

                      $query = "SELECT bedID from room_details WHERE roomName = '$roomnameDB'";
                      $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

                              while($row = mysqli_fetch_assoc($res)){
                                $bedId = $row['bedID'];

                                if($bedId=='1'){
                                    $updatequery = "UPDATE `room_details` SET `bedCount`='$single' WHERE roomName = '$roomnameDB' AND bedID = '$bedId'";
                                    mysqli_query($conn, $updatequery) or die(mysqli_error($conn));
                                }else{
                                    $updatequery = "UPDATE `room_details` SET `bedCount`='$double' WHERE roomName = '$roomnameDB' AND bedID = '$bedId'";
                                    mysqli_query($conn, $updatequery) or die(mysqli_error($conn));
                                }

                              }

                      //check if there is new image to be inserted
                      if(is_uploaded_file($_FILES['edit-image']['tmp_name'])){

                         $imageData = addslashes(file_get_contents($_FILES['edit-image']['tmp_name']));
                         $imageMime = getimageSize($_FILES['edit-image']['tmp_name']);
                         $imageType = $imageMime['mime'];

                         $updatequery = "UPDATE `room_details` SET `roomName`='$roomname',`roomTypeId`='$roomtype',`noOfperson`='$persons',`roomPrice`='$roomprice',`addPersonPrice`='$addpersonprice',`imgType`='$imageType',`imgData`='$imageData',`status`='$status' WHERE roomName='$roomnameDB'";

                           mysqli_query($conn, $updatequery) or die(mysqli_error($conn));

                      }else{

                        $updatequery = "UPDATE `room_details` SET `roomName`='$roomname',`roomTypeId`='$roomtype',`noOfperson`='$persons',`roomPrice`='$roomprice',`addPersonPrice`='$addpersonprice',`status`='$status' WHERE roomName='$roomnameDB'";

                          mysqli_query($conn, $updatequery) or die(mysqli_error($conn));
                      }

                      header("Location: admindashboard-roomdetails.php");
                    }else{
                        header("Location: admindashboard-roomdetails.php?page=editroom&msg=invalidnum");
                    }

            break;

            case 'updatestat':

                  $custId = $_POST['custId'];
                  $custStatus = $_POST['custStatus'];

                   $updatequery = "UPDATE `customer` SET `status`='$custStatus' WHERE customerID = '$custId'";
                   mysqli_query($conn, $updatequery) or die(mysqli_error($conn));

                   header("Location: dashboard-users.php");
        }
    }

?>