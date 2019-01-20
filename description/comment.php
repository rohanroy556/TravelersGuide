<?php
	include("../config.php");
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["username"])) {
			header("Location: ../login");
			exit;
		} else {
			$username = test_input($_POST["username"]);
			$name = test_input($_POST["name"]);
			$comment = $_POST["comment"];
			$time = $_POST["time"];
			$sql="INSERT INTO Comment(Name,Username,Message,date_time) VALUES ('$name','$username','$comment','$time')";
			mysqli_query($conn,$sql);
			header("Location: ../description/?name=$name");
			exit;
		}
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>