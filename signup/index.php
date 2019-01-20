<?php
	$usernameerr=$passworderr=$confirmpasserr=$firstnameerr=$lastnameerr=$doberr=$gendererr=$mobileerr=$emailerr=$countryerr="";
	$username=$password=$confirmpass=$firstname=$lastname=$dob=$gender=$mobile=$email=$country="";
	include("../config.php");
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["username"])) {
			$usernameerr = "username is required";
		} else {
			$username = test_input($_POST["username"]);
			if (!preg_match("/[A-Za-z0-9]{8,}/",$username)) {
				$usernameerr= "should contain Alphanumeric and the  length of text string to be atleast 8 characters"; 
			}
		}
		if (empty($_POST["firstname"])) {
			$firstnameerr = "Name is required";
		} else {
			$firstname = test_input($_POST["firstname"]);
		}
		if (empty($_POST["lastname"])) {
			$lastnameerr = "Last name is required";
		} else {
			$lastname = test_input($_POST["username"]);
		}
		if (empty($_POST["password"])) {
			$passworderr = "password is required";
		}else {
			$password = test_input($_POST["password"]);   
			if (!preg_match("/[A-Za-z0-9]{8,}/",$password)) {
				$passworderr= "should contain Alphanumeric and the  length of text string to be atleast 8 characters"; 
			}
		}
		if (empty($_POST["confirmpass"])) {
			$confirmpasserr = "password is required";	
		} else {
			$confirmpass = test_input($_POST["confirmpass"]);
			if (!preg_match("/[A-Za-z0-9]{8,}/",$password)) {
				$confirmpasserr= "should contain Alphanumeric and the  length of text string to be atleast 8 characters"; 
			}
			else if($confirmpass!=$password) {
				$confirmpasserr= "passwords do not match"; 
			}
		}
		if (empty($_POST["mobile"])) {
			$mobileerr = "mobile is required";
		}else {
			$mobile = test_input($_POST["mobile"]);   
			if (!preg_match("/[0-9]{10}/",$mobile)) {
				$mobileerr= "Mobile number contains 10 digits"; 
			}
		}
		if (empty($_POST["dob"])) {
			$doberr = "invalid birthday date";
		} else {
			$dob = test_input($_POST["dob"]);
		}
		if (empty($_POST["email"])) {
			$emailerr = "invalid email";
		} else {
			$email = test_input($_POST["email"]);
		}
		if (empty($_POST["country"])) {
			$countryerr = "country cannot be empty";
		} else {
			$country = test_input($_POST["country"]);
		}
		$fullname=$_POST['firstname']." ".$_POST['lastname'];
	}				
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if($usernameerr=="" && $firstnameerr=="" && $lastnameerr=="" && $passworderr=="" && $confirmpasserr=="" && $mobileerr=="" && $doberr=="" && $emailerr=="" && $countryerr=="" &&
		$username!="" && $firstname!="" && $lastname!="" && $password!="" && $confirmpass!="" && $mobile!="" && $dob!="" && $email!="" && $country!=""){
		$gender=$_POST["gender"];
		$sql="INSERT INTO Profile(Username,Password,Fullname,DOB,Gender,Mobile,Country,Email) VALUES ('$username','$password','$fullname','$dob','$gender','$mobile','$country','$email')";
		if(mysqli_query($conn,$sql)){
			header("Location: ../login");
			exit;
		}
	}						
	mysqli_close($conn);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | Sign-Up</title>
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
				<p>Sign-Up to create a account</p>
			</div>
			<form name="login" class="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<br><br>				
				<input type="text" name="firstname" placeholder="First Name" class="loginInput" autofocus required>
				<span class="error"><?php echo $firstnameerr; ?></span><br><br>
				<input type="text" name="lastname" placeholder="Last Name" class="loginInput" required>
				<span class="error"><?php echo $lastnameerr; ?></span><br><br>
				<input type="text" name="username" placeholder="Username" class="loginInput" pattern="[A-Za-z0-9]{8,}" required>
				<span class="error"><?php echo $usernameerr; ?></span><br><br>
				<input type="password" name="password" placeholder="New Password" class="loginInput" pattern="[A-Za-z0-9]{8,}" required>
				<span class="error"><?php echo $passworderr; ?></span><br><br>
				<input type="password" name="confirmpass" placeholder="Confirm Password" class="loginInput" pattern="[A-Za-z0-9]{8,}" required>
				<span class="error"><?php echo $confirmpasserr; ?></span><br><br>
				Gender <input type="radio" name="gender" value="Male" checked> Male 
				<input type="radio" name="gender" value="Female"> Female 
				<input type="radio" name="gender" value="Other"> Other<br><br><br>
				<input type="text" name="dob" placeholder="Birthday" onfocus="(this.type='date')" onblur="(this.type='text')" class="loginInput" required>
				<span class="error"><?php echo $doberr; ?></span><br><br>
				<input type="text" name="mobile" placeholder="Mobile Number" class="loginInput" required>
				<span class="error"><?php echo $mobileerr; ?></span><br><br>
				<input type="text" name="country" placeholder="Country" class="loginInput" required>
				<span class="error"><?php echo $countryerr; ?></span><br><br>
				<input type="text" name="email" placeholder="E-Mail Address" class="loginInput" required>
				<span class="error"><?php echo $emailerr; ?></span><br><br><br>
				<input type="submit" id="submit" value="Sign-Up"><br><br>
				<center><a href="../login">If you are already a member</a></center>
			</form>
		</div>
		<div class="br"></div>
		<?php include('../footer.php');?>
		<script src="../js/navbar.js"></script>
	</body>
</html>