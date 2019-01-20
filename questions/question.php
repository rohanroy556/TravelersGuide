<?php
	include("../config.php");
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = test_input($_POST["username"]);
		$question = $_POST["question"];
		$time = $_POST["time"];
		$sql="INSERT INTO Questions(Question,Questioner,date_time) VALUES ('$question','$username','$time')";
		mysqli_query($conn,$sql);
		header("Location: ../questions");
		exit;
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>