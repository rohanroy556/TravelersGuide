<?php
	$usernameerr=$passworderr="";
	$username=$password="";
	include("../config.php");
	$username = urldecode($_POST['username']);
	$password = urldecode($_POST['password']);
	if (empty($username)) 
		$usernameerr = "username is required";
	else
		$username = test_input($username);
	if (empty($password))
		$passworderr = "password is required";
	else
		$password = test_input($password); 
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if($usernameerr=="" && $passworderr=="" &&	$username!="" && $password!=""){
		$sql = "SELECT * FROM Profile WHERE Username='$username'";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)==0){
			$usernameerr = "Invalid Username";
			$passworderr = "Invalid Password";
		}
		else{
			$row = mysqli_fetch_assoc($result);
			if($row["Password"]==$password){
				$json->Profile = array($row);
				echo json_encode($json);
			}else{
				$usernameerr = "Username is correct";
				$passworderr = "Invalid Password";
			}						
		}
	}
	if($usernameerr!="" && $passworderr!=""){
	    $json = array("usernameerr"=>$usernameerr, "passworderr"=>$passworderr);
	    echo json_encode($json); 
	}
	mysqli_close($conn);
?>