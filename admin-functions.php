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
                    $status = $_POST['roomStatus'];
                    
                    $roomname = strtoupper($roomname);

                    $query;
                    if($single > 0 || $double > 0){

                        $selectquery ="SELECT roomName from room_details where roomName ='$roomname'";

                        $selectRes = mysqli_query($conn, $selectquery);
                        $row = mysqli_fetch_assoc($selectRes);
                        
                        if(empty($row)){

                            if($single > 0){
                              while($single > 0){
                                  $query = "INSERT INTO room_details (roomName, roomTypeId, bedID, noOfperson, status) VALUES ('$roomname','$roomtype','1','$persons','$status')";
                                  $insertquery = mysqli_query($conn, $query);

                                  $single--;
                              }
                            }
                            if($double > 0){
                                while($double > 0){
                                    $query = "INSERT INTO room_details (roomName, roomTypeId, bedID, noOfperson, status) VALUES ('$roomname','$roomtype','2','$persons','$status')";
                                    $insertquery = mysqli_query($conn, $query);

                                    $double--;
                                }
                            }
                            header("Location: admindashboard.php");

                        }else{
                          header("Location: admindashboard.php?page=addroom&msg=existing");
                        }

                    }else{
                        header("Location: admindashboard.php?page=addroom&msg=invalidnum");
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
                    $status = $_POST['roomStatus'];
                    
                    $roomname = strtoupper($roomname); //Set room name to always be capital letters

                    if($single > 0 || $double > 0){ //Catch invalid num count of beds

                        //Get room name for update
                        $query = "SELECT roomName from room_details WHERE roomID = '$roomId'";

                            $res = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($res);
                            $roomnameDB = $row['roomName'];
                            echo $roomnameDB."</br>";

                        //Get room ids for deletion
                        $query = "SELECT roomID from room_details WHERE roomName = '$roomnameDB'";
                            $res = mysqli_query($conn, $query);

                              while($row = mysqli_fetch_assoc($res)){
                                echo $row['roomID']."</br>";
                                $id = $row['roomID'];
                                $query ="DELETE from room_details WHERE roomID = '$id'";
                                mysqli_query($conn, $query);
                              }

                          //Inserting new updated data of rooms
                            if($single > 0){
                              while($single > 0){
                                  $query = "INSERT INTO room_details (roomName, roomTypeId, bedID, noOfperson, status) VALUES ('$roomname','$roomtype','1','$persons','$status')";
                                  $insertquery = mysqli_query($conn, $query);

                                  $single--;
                              }
                            }
                            if($double > 0){
                                while($double > 0){
                                    $query = "INSERT INTO room_details (roomName, roomTypeId, bedID, noOfperson, status) VALUES ('$roomname','$roomtype','2','$persons','$status')";
                                    $insertquery = mysqli_query($conn, $query);

                                    $double--;
                                }
                            }
                            header("Location: admindashboard.php");
                    
                    }else{
                        header("Location: admindashboard.php?page=editroom&msg=invalidnum");
                    }
            break;
        }
    }
?>