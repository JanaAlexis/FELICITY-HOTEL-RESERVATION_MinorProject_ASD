<nav class="navbar navbar-default nav-container">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-nav">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Felicity</a>
    </div>
    <ul class="nav navbar-nav collapse navbar-collapse main-nav">
        <li>
            <a href="index.php"> Home </a>
        </li>
        <li>
            <a href="#"> About </a>
        </li>
        <li class="dropdown">
            <a href="rooms.php" class="dropdown-toggle" data-toggle="dropdown"> Rooms <i class="caret"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="rooms.php">Deluxe</a></li>
                    <li class="divider"></li>
                    <li><a href="rooms.php">Luxury</a></li>
                    <li class="divider"></li>
                    <li><a href="rooms.php">Suite</a></li>
                    <li class="divider"></li>
                    <li><a href="rooms.php">Superior</a></li>
                </ul>
        </li>
    </ul>
    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle user-icon" data-toggle="dropdown"><i class="fa fa-user"></i></a>
                    <ul class="dropdown-menu">
                        <li id="dashboard-li">
                            <a href="admindashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li id="booking-li">
                            <a href="userbookings.php"><i class="fa fa-fw fa-user"></i> My Bookings</a>
                        </li>
                        <li id="login-li">
                            <a href="" data-toggle='modal' data-target='#login-modal'><i class="fa fa-fw fa-user"></i> Log in</a>
                        </li>
                        <li class="divider"  id="div1"></li>
                        <li id="signup-li">
                            <a href="" data-toggle='modal' data-target='#signup-modal'><i class="fa fa-fw fa-sign-in"></i> Sign up</a>
                        </li>
                        <li class="divider"  id="div2"></li>
                        <li id="logout-li">
                            <a href="navbar-functions.php?action=logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
            </li>
        </ul>
    </div>
  </div>
</nav>

<!-- Login Modal -->
<div id="login-modal" class="modal fade in" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-info-circle"></i> Login </h4>
            </div>
            <div class="modal-body">
                <img id="" class="img-responsive center-block" src="images/loginIcon.png"/>
                
                <!-- Label shows if login is invalid -->
                <label class="label label-danger" id="loginNotif"></label></br></br>
                
                <form method="post" action="navbar-functions.php?action=login">
                    <input type="text" id="" class="form-control login-info" placeholder="Email or Username" name="user" required autofocus/></br>
                    <input type ="password" id="" class="form-control login-info" placeholder="Password" name="password" required /></br>
                    <button class="btn btn-primary btn-block" type="submit" name="submit" id="loginBtn"> Login </button>
                    <p class="center">Forgot password? </p>
                    <p class="center">Don't have an account? <a href="#signup-modal" data-toggle="modal" data-dismiss="modal">Sign up</a></p>
                </form>
            </div>
        </div>
    </div>
</div>                      
<!-- end of login modal -->

<!-- Sign up Modal -->
<div id="signup-modal" class="modal fade in" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-info-circle"></i> Sign up </h4>
            </div>
            <div class="modal-body">
                <!-- Label shows if email is invalid -->
                <label class="label label-danger" id="signupNotif"></label></br></br>
                
                <form method="post" action="navbar-functions.php?action=signup">
                    <div class="form-group">
                        <input type="text" id="fname" name="firstName" placeholder="First Name" class="form-control cust-info" autofocus required/></br>
                        <input type="text" id="lname" name="lastName" placeholder="Last Name" class="form-control cust-info" required/></br>
                        
                        <!-- Label shows if email exist -->
                        <label class="label label-danger" id="emailExist"></label></br></br>
                        
                        <input type="text" id="singupEmail" name="email" placeholder="Email" class="form-control cust-info"  required/></br>
                        <input type="password" name="password" placeholder="password" class="form-control cust-info" required/>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-7">
                            <button class="btn b10 pull-right" type="button"data-dismiss="modal">
                                Cancel    
                            </button>  
                            <button class="btn btn-success b10 pull-right" type="submit" name="submit">
                                Sign up                               
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>                      
<!-- end of sign up modal -->
<?php
    include_once 'footer.php';
    
    if(!(isset($_SESSION['userStatus']))){
        $_SESSION['userStatus'] = 0; //tracks who is the user

    }
    //$_SESSION['userStatus'] = 2;
    //echo $_SESSION['userStatus'];
?>

    <script>
        $(document).ready(function(){
            if(<?php echo $_SESSION['userStatus']?> == 1){
                $('#dashboard-li').show();
                $('#booking-li').hide();
                $('#login-li').hide();
                $('#signup-li').hide();
                $('#div1').hide();
            }else if(<?php echo $_SESSION['userStatus']?> == 2){
                $('#booking-li').show();
                $('#dashboard-li').hide();
                $('#login-li').hide();
                $('#signup-li').hide();
                $('#div1').hide();
            }else{
                $('#dashboard-li').hide();
                $('#booking-li').hide();
                $('#logout-li').hide();
                $('#div2').hide();
            }
            
        });
        
    </script>

<?php
if (isset($_GET['page'])){ 
    if($_GET['page']=="login"){             
        if(!empty($_GET['msg'])){

            switch ($_GET['msg']) {
                    case 'invalid':
?>
                         <script>
                        $('#loginNotif').text('Invalid username or password. Please try again.');
                        $('#login-modal').modal('show');
                        </script>
<?php
                    break;
            }
        }
    }else if($_GET['page']=="signup"){              
        if(!empty($_GET['msg'])){
            switch ($_GET['msg']) {
                    case 'invalid':
?>
                        <script>
                        $('#signupNotif').text('Invalid email. Please try again.');
                        var fname = "<?php echo $_SESSION['firstname']?>";
                        var lname = "<?php echo $_SESSION['lastname']?>";
                        var email = "<?php echo $_SESSION['email']?>";
                        //alert(data);
                        $('#fname').val(fname);
                        $('#lname').val(lname);
                        $('#singupEmail').val(email);
                        $('#signup-modal').modal('show');
                        </script>
<?php
                        break;
                    case 'existing':
?>
                        <script>
                        $('#emailExist').text('Email already exist.');
                        var fname = "<?php echo $_SESSION['firstname']?>";
                        var lname = "<?php echo $_SESSION['lastname']?>";
                        var email = "<?php echo $_SESSION['email']?>";
                        //alert(data);
                        $('#fname').val(fname);
                        $('#lname').val(lname);
                        $('#singupEmail').val(email);
                        $('#signup-modal').modal('show');
                        </script>
<?php
                        break;
            }
        }
    }
}
?>

