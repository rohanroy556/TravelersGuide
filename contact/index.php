<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | Contact</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../css/content.css">
		<link rel="stylesheet" type="text/css" href="../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../img/home.png" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php
			if(!isset($_SESSION['Username']))
				include("../nav1.php");
			else
				include("../nav2.php");
		?>
		<div class="br"></div>
		<?php
			$name=$email=$comment=$result="";
			include("../config.php");
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$name = test_input($_POST["name"]);
				$email = test_input($_POST["email"]);
				$comment = test_input($_POST["comment"]);
			}				
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			if($name!="" && $email!="" && $comment!=""){
				$sql="INSERT INTO feedback(Name,Email,Comment) VALUES ('$name','$email','$comment')";
				if(mysqli_query($conn,$sql)){
					$result = "Your query has been submitted";
				}
			}						
			mysqli_close($conn);
		?>
		<div class="content">
			<h2>Contact Information</h2>
			<hr><br>
			<p>We are here to help. You can always contact us here.</p><br>
			<p><strong>Address : </strong>BonVoyage TravelGuide, Vellore, Tamil Nadu - 632014</p>
			<p><strong>Mobile No. : </strong>(+91) 9824123654</p><br>
			<p>If you have any suggestions / issues / request about content published on Bon Voyage. You can send us your email or fill in the form given below.</p>
			<p><?php echo $result;?></p>
			<form name="contact" class="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<br><br>
				<input type="text" name="name" placeholder="Name" class="contactInput" autofocus required><br><br><br>
				<input type="text" name="email" placeholder="Email" class="contactInput" required><br><br><br>
				<textarea name="comment" rows="10" cols="30" class="contactArea" placeholder="Comment here..." required></textarea><br><br><br>
				<input type="submit" id="submit" value="SUBMIT">
			</form>
		</div>
		<div class="br"></div>
		<?php include('../footer.php');?>
		<script src="../js/navbar.js"></script>
	</body>
</html>