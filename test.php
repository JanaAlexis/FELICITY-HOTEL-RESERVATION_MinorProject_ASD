<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<img src="testimage.php?msg=<?php echo 47 ?>" alt="Video Thumbnail" class="img-responsive"/>
</body>
</html>
<?php

/*
if(isset($_POST['viewcd'])){
	$queryw = "select * from lib_cd where id=".$_POST['idd'];
	$resultw = $mysqli->query($queryw);
?>

<div class="container">
	<table border="1" align="center" border-collapse="collapse">
		<thead>
			<tr >
				<th >Select</th>
				<th>Well_Number</th>
				<th>Well_Name</th>
				<th width="100">CD No:</th>
				<th width="150">Logs</th>
				<th width="100">Bottom Depth</th>
				<th width="100">Top Depth</th>
				<th width="100">Date of Log</th>
			</tr>
		</thead>
<?php
	while($rowcd = $resultw->fetch_assoc()){
?>
		<tr>
			<td><?php echo $rowcd['id'] ?> </td>
			<td align="center"><?php echo $rowcd['well_no'] ?></td>
			<td align="center"><?php echo $rowcd['well_name'] ?></td>
			<td colspan="5">
				<table rules="all">
					<tr>
<?php
		$querycd = "select * from cd where pidd=".$rowcd['id'];
		$resultcd = $mysqli->query($querycd);
		while($rowcd = $resultcd->fetch_assoc()){
?>
						<td width="100" align="center"><?php echo $rowcd['cd_no'] ?></td>
						<td colspan="4">
							<table rules="all">
								<tr>
<?php
			$queryl = "select * from lib_cd_logs where pid=".$rowcd['cd_no'];
			$resultl = $mysqli->query($queryl);
			while($rowl = $resultl->fetch_assoc()){
?>
									<td width="155"><?php echo $rowl['logs'] ?></td>
									<td width="105" align="center"><?php echo $rowl['bottom'] ?></td>
									<td width="100" align="center"><?php echo $rowl['top'] ?></td>
									<td width="100" align="right"><?php echo $rowl['date'] ?></td>
								</tr>
<?php
			}
?>
							</table>
						</td>
					</tr>
<?php
		}
?>
				</table>
			</td>
<?php
	}
}
?>
	</tr>
</table>
*/
?>