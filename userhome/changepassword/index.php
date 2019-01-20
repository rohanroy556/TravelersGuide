<?php
	session_start();
	if(!isset($_SESSION['Username'])){
		header("Location: ../");
		exit;
	}
	include("../../config.php");
	$username=$_SESSION['Username'];
	$sql = "SELECT * FROM Profile WHERE Username='$username'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$fullname=$row['Fullname'];
	$password=$row['Password'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Welcome | <?php echo $fullname;?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/changepass.css">
		<link rel="stylesheet" type="text/css" href="../../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../../img/home.png" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php include("../../nav2.php");?>
		<div class="br"></div>
		<?php
			$oldpasserr=$confirmpasserr=$newpasserr="";
			$oldpass=$confirmpass=$newpass="";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["oldpass"])) {
					$oldpasserr = "Old password is required";
				} else {
					$oldpass = test_input($_POST["oldpass"]);
				}
				if (empty($_POST["newpass"])) {
					$newpasserr = "New Password is required";
				}else {
					$newpass = test_input($_POST["newpass"]); 
				}
				if (empty($_POST["confirmpass"])) {
					$confirmpasserr = "Confirm Password is required";
				}else {
					$confirmpass = test_input($_POST["confirmpass"]); 
				}
			}				
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			if($newpasserr=="" && $confirmpasserr=="" && $oldpasserr=="" && $newpass!="" && $confirmpass!="" && $oldpass!=""){
				if($oldpass!=$password){
					$oldpasserr = "Old Password didn't match";
				}
				else{
					if($newpass==$confirmpass){
						$sql = "UPDATE Profile SET Password='$newpass' WHERE Username='$username'";
						mysqli_query($conn,$sql);
						$oldpass=$confirmpass=$newpass="";
					}else{
						$newpasserr = "New password didn't match confirm password";
						$confirmpasserr = "New password didn't match confirm password";
					}						
				}
			}
			mysqli_close($conn);			
		?>
		<div class="form">
			<div class="header">
				<h1>Username : <?php echo $username;?></h1>
			</div>
			<form name="login" class="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<br><br><br>	
				<input type="password" name="oldpass" placeholder="Old Password" class="loginInput" pattern="[A-Za-z0-9]{8,}" required>
				<span class="error"><?php echo $oldpasserr; ?></span><br><br><br>
				<input type="password" name="newpass" placeholder="New Password" class="loginInput" pattern="[A-Za-z0-9]{8,}" required>
				<span class="error"><?php echo $newpasserr; ?></span><br><br><br>
				<input type="password" name="confirmpass" placeholder="Confirm Password" class="loginInput" pattern="[A-Za-z0-9]{8,}" required>
				<span class="error"><?php echo $confirmpasserr; ?></span><br><br><br><br>
				<input type="submit" id="button" value="Change">
			</form>
		</div>
		<div class="br"></div>
		<?php include('../../footer.php');?>
		<script src="../../js/navbar.js"></script>
	</body>
</html>
