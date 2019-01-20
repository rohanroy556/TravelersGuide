<?php
	include("../../config.php");
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["username"])) {
			header("Location: ../../login");
			exit;
		} else {
			$username = test_input($_POST["username"]);
			$ques_id = $_POST["ques_id"];
			$response = $_POST["response"];
			$time = $_POST["time"];
			$sql="INSERT INTO Responses(Ques_id,Response,Answerer,date_time) VALUES ($ques_id,'$response','$username','$time')";
			mysqli_query($conn,$sql);
			header("Location: ../responses/?id=$ques_id");
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