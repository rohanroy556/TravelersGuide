<?php
	session_start();
	include("../config.php");
	$sql = "SELECT * FROM Faq";
	$result = mysqli_query($conn,$sql);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | FAQ</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../css/content.css">
		<link rel="stylesheet" type="text/css" href="css/faq.css">
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
		<div class="content">
			<h2>Frequently Asked Questions</h2>
			<hr>
			<br>
			<?php 
				while($row = mysqli_fetch_assoc($result)){
					$question = $row['Question'];
					$answer = $row['Answer'];
					echo "<div class='faq'>";
					echo "<h4 class='questions'>$question</h4><hr>";
					echo "<p class='answers'>$answer</p><br>";
					echo "</div><br>";
				}
			?>
		</div>
		<div class="br"></div>
		<?php include('../footer.php');?>
		<script src="../js/navbar.js"></script>
	</body>
</html>