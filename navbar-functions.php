<?php
    include_once('config/config.php');
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        switch($_GET["action"]){
            
            case "login":
                    //Define $user and $password
                    $user = $_POST['user'];
                    $pass = $_POST['password'];
                    if(empty($_POST['user']) || empty($_POST['password'])){
                        
                        $error = "Please complete all fields.";
                        echo $error;
                        
                    }else{
                        
                        if ($user == "admin" || $user == "Admin" || $user == "ADMIN"){
                            $user = strtolower($user);
                            //sql query to fetch information of registered user and finds user match
                            $query = mysqli_query($conn, "SELECT * FROM employee WHERE password='".$pass."' AND username='".$user."'");
                            
                            if($query){
                                if(mysqli_num_rows($query) < 1){
                                    header("Location: index.php?page=login&msg=invalid");
                                }else{
                                    
                                    $_SESSION['userStatus'] = 1; //tracks who is the user
                                    
                                    while($row = mysqli_fetch_assoc($query)){
                                        $_SESSION['userId'] = $row['employeeID'];
                                        $_SESSION['firstname'] = $row['firstName'];
                                        $_SESSION['lastname'] = $row['lastName'];
                                        $_SESSION['user'] = $row['username'];;
                                    }
                                    header("Location: admindashboard.php");
                                    //echo $_SESSION['userStatus'];
                                }
                            }else{
                                echo "Admin login error.";
                            }
                        }else{
                            if(strchr($user, "@") && strchr($user, ".")){
                                $query = mysqli_query($conn, "SELECT * FROM customer WHERE password='".$pass."' AND email='".$user."'");
                            
                                if($query){
                                    if(mysqli_num_rows($query) < 1){
                                        header("Location: index.php?page=login&msg=invalid");
                                    }else{
                                        
                                        $_SESSION['userStatus'] = 2;
                                        
                                        while($row = mysqli_fetch_assoc($query)){
                                        $_SESSION['userId'] = $row['customerID'];
                                        $_SESSION['firstname'] = $row['firstName'];
                                        $_SESSION['lastname'] = $row['lastName'];
                                        $_SESSION['email'] = $row['email'];;
                                        }
                                        header("Location: rooms.php");
                                    }
                                }else{
                                    echo "Customer login error.";
                                }
                            }else{
                                header("Location: index.php?page=login&msg=invalid");
                            }
                        }
                    }
                break;
                
            case "signup":
                    //Define $user and $password
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    
                    $firstName = ucfirst($firstName);
                    $lastName = ucfirst($lastName);
                    
                    $findAt = strchr($email, '@');
                    $finddot = strchr($email, '.');
                    
                    if($findAt && $finddot){
                        
                        $check = mysqli_query($conn, "SELECT * FROM customer WHERE email = '".$email."'");
                        $rows = mysqli_fetch_assoc($check);
                        $filter = $rows['email'];
                        
                        if($filter){
                            // Declare sessions to display previous data in modal
                            $_SESSION['firstname'] = $rows['firstName'];
                            $_SESSION['lastname'] = $rows['lastName'];
                            $_SESSION['email'] = $rows['email'];
                            header("Location: index.php?page=signup&msg=existing");
                            
                        }else{
                            //create user
                            $query = "INSERT INTO customer (firstName, lastName, email, password, status) VALUES ('$firstName','$lastName','$email','$password','activated')";
                            
                            $insertquery = mysqli_query($conn, $query);
                            
                            //check if data is in the database
                            if($insertquery){
                                
                                $_SESSION['userStatus'] = 2; //tracks who is the user
                                
                                $_SESSION['userId'] = $rows['customerID'];
                                $_SESSION['firstname'] = $rows['firstName'];
                                $_SESSION['lastname'] = $rows['lastName'];
                                $_SESSION['email'] = $rows['email'];
                                
                                header("Location: rooms.php?page=signup&msg=success");
                            }
                            
                        }
                    }else{
                        // Declare sessions to display previous data in modal
                        $_SESSION['firstname'] = $firstName;
                        $_SESSION['lastname'] = $lastName;
                        $_SESSION['email'] = $email;
                        header("Location: index.php?page=signup&msg=invalid");
                    }
            break;
        }
    }else{
        echo "Error POST";
    }
    
    if(isset($_GET["action"]) && ($_GET["action"]=="logout")){
        session_unset();
        session_destroy();
        header("Location: ../felicity");
    }
?>