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
	$dob=$row['DOB'];
	$gender=$row['Gender'];
	$mobile=$row['Mobile'];
	$country=$row['Country'];
	$email=$row['Email'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Welcome | <?php echo $fullname;?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/profile.css">
		<link rel="stylesheet" type="text/css" href="../../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../../img/home.png" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script>
			var input = document.getElementsByClassName("profileInput");
			function changeProfile(){
				document.getElementById("change").style.display = "none";
				document.getElementById("save").style.display = "block";
				document.getElementById("cancel").style.display = "block";
				for(var i=0;i<input.length;i++)
					input[i].removeAttribute("readonly");
			}
			function cancelChange(){
				document.getElementById("change").style.display = "block";
				document.getElementById("save").style.display = "none";
				document.getElementById("cancel").style.display = "none";
				for(var i=0;i<input.length;i++)
					input[i].setAttribute("readonly",true);
					location.reload();
			}
		</script>
	</head>
	<body>
		<?php include("../../nav2.php");?>
		<div class="br"></div>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$name = test_input($_POST["name"]);
				$mob = test_input($_POST["mobile"]); 
				$bd = test_input($_POST["dob"]);
				$em = test_input($_POST["email"]);
				$coun = test_input($_POST["country"]);
				$gen=$_POST["gender"];
				$sql="UPDATE Profile SET Fullname='$name',DOB='$bd',Gender='$gen',Mobile='$mob',Country='$coun',Email='$em' WHERE Username='$username'";
				mysqli_query($conn,$sql);
			}				
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}					
			mysqli_close($conn);
		?>
		<div class="form">
			<div class="header">
				<h1>Username : <?php echo $username;?></h1>
			</div>
			<form name="profile" class="profileForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<br><br><br>	
				<input type="text" name="name" value="<?php echo $fullname;?>" class="profileInput" readonly required><br><br><br>
				<input type="text" name="gender" value="<?php echo $gender;?>" class="profileInput" readonly required><br><br><br>
				<input type="text" name="dob" value="<?php echo $dob;?>" onfocus="(this.type='date')" onblur="(this.type='text')" class="profileInput" readonly required><br><br><br>
				<input type="text" name="mobile" value="<?php echo $mobile;?>" class="profileInput" readonly required><br><br><br>
				<input type="text" name="country" value="<?php echo $country;?>" class="profileInput" readonly required><br><br><br>
				<input type="text" name="email" value="<?php echo $email;?>" class="profileInput" readonly required><br><br><br><br>
				<input type="button" id="change" value="Change" onclick="changeProfile()" style="display: block;">
				<input type="submit" id="save" value="Save" style="display: none;"><br>
				<input type="button" id="cancel" value="Cancel" onclick="cancelChange()" style="display: none;">
			</form>
		</div>
		<div class="br"></div>
		<?php include('../../footer.php');?>
		<script src="../../js/navbar.js"></script>
	</body>
</html>
