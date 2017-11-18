<?php
    include 'header.php';
    include 'navbar.php';
    //echo $_SESSION['userStatus'];
?>


<div class="container-fluid container-padding">
	<div class="row">
		
		<div id="clouds">
		<div class="cloud x1"></div>
			<!-- Time for multiple clouds to dance around -->
		<div class="cloud x2"></div>
		<section class="section" height: "250px" width:"100%" align="center">
			<a href="dashboard-users.php"><i class="fa fa-user-circle-o"><h1>USERS DETAILS</h1></i></a>
		</section>
		<div class="cloud x3"></div>
		<div class="cloud x4"></div>
		<section class="section" height:"250px" width:"100%" align="center">
			<i class="fa fa-user-circle-o"><a href="admindashboard-roomdetails.php"><h1>ADMIN DASHBOARD</h1></a>
		</section>
		<div class="cloud x5"></div>



		</div>
		
	</div>
</div>

<?php
    include 'footer.php';
?>