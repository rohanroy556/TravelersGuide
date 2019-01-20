<?php
	include("../config.php");
	$table = $_POST["Sync"];
	$sql = "SELECT * FROM Description";
	$result = mysqli_query($conn,$sql);
	$rows = array();
	while($row = mysqli_fetch_assoc($result)) {
		array_push($rows, $row);
	}
	$json->Description = $rows;
	echo json_encode($json);
?>