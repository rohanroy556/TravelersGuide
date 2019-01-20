<?php
	$serverName = "localhost";
	$serverUsername = "id3635878_localhost";
	$serverPassword = "12345";
	$dbname = "id3635878_tourguide";
	$conn = mysqli_connect($serverName, $serverUsername, $serverPassword, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>