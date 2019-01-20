<?php
	session_start();
	$usernameerr=$passworderr="";
	$username=$password="";
	include("../config.php");
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["username"])) {
			$usernameerr = "username is required";
		} else {
			$username = test_input($_POST["username"]);
		}
		if (empty($_POST["password"])) {
			$passworderr = "password is required";
		}else {
			$password = test_input($_POST["password"]); 
		}
	}				
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if($usernameerr=="" && $passworderr=="" &&	$username!="" && $password!=""){
		$sql = "SELECT Username, Password, Fullname FROM Profile WHERE Username='$username'";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)==0){
			$usernameerr = "Invalid Username";
			$passworderr = "Invalid Password";
		}
		else{
			$row = mysqli_fetch_assoc($result);
			if($row["Password"]==$password){
				$_SESSION['Username'] = $row['Username'];
				$username=$password="";
				header('Location:../userhome');
				exit;
			}else{
				$usernameerr = "Username is correct";
				$passworderr = "Invalid Password";
			}						
		}
	}						
	mysqli_close($conn);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../css/forms.css">
		<link rel="stylesheet" type="text/css" href="../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../img/home.png" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php include("../nav1.php");?>
		<div class="br"></div>
		<div class="form">
			<div class="header">
				<h1><i class="fa fa-plane"></i> Bon Voyage</h1>
				<p>Login to your account</p>
			</div>
			<form name="login" action="" method="post">
				<br><br>
				<input type="text" name="username" placeholder="Username" class="loginInput" pattern="[A-Za-z0-9]{8,}" autofocus required>
				<span class="error"><?php echo $usernameerr; ?></span><br><br>			
				<input type="password" name="password" placeholder="Password" class="loginInput" pattern="[A-Za-z0-9]{8,}" required>
				<span class="error"><?php echo $passworderr; ?></span><br><br>		
				<input type="submit" id="submit" value="Login"><br><br>
			</form>
		</div>
		<div class="br"></div>
		<?php include('../footer.php');?>
		<script src="../js/navbar.js"></script>
	</body>
</html>