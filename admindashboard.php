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
        
    </div>
</div>

<?php
    include 'footer.php';
?>