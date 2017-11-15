<?php
	include 'header.php';
	include 'navbar.php';
?>
    <div class="container-fluid">
		<div id="homecontent">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			
			<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
					    <img src="images/1a.jpg" alt="...">
					</div>
					<div class="item">
					    <img src="images/1b.jpg" alt="...">
					</div>
					<div class="item">
					    <img src="images/1c.jpg" alt="...">
					</div>
				</div>
			<!-- end of wrapper -->
			<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			<!-- end of controls -->
		</div>
	</div>

<?php
	include_once 'footer.php';
?>