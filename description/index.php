<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	if(!isset($_GET['name'])){
		header('Location: ../home');
		exit;
	}
	include("../config.php");
	$name = $_GET['name'];
	$sql = "SELECT * FROM Description WHERE Name='$name'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)==0){
		header('Location: ../home');
		exit;
	}
	$row = mysqli_fetch_assoc($result);
	$image = $row['Image'];
	$description = $row['Description'];
	$username = '';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | <?php echo $name;?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" type="text/css" href="../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../css/content.css">
		<link rel="stylesheet" type="text/css" href="css/comment.css">
		<link rel="stylesheet" type="text/css" href="../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../img/home.png" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php
			if(!isset($_SESSION['Username']))
				include("../nav1.php");
			else{
				include("../nav2.php");
				$username = $_SESSION['Username'];
			}
		?>
		<div class="br"></div>
		<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none;" id="mySidebar">
			<button class="w3-bar-item w3-button w3-large"	onclick="w3_close()"><center>&times;</center></button>
			<?php 
				$sql = "SELECT * FROM Description";
				$result = mysqli_query($conn,$sql);
				while($row = mysqli_fetch_assoc($result)){
					$n = $row['Name'];
					echo "<a href='../description/?name=$n' class='w3-bar-item w3-button'>$n</a>";
				}
			?>
			<br><br><br>
		</div>
		<div id="main">
			<div class="w3-teal w3-grey">
				<button id="openNav" class="w3-button w3-teal w3-xlarge w3-grey" onclick="w3_open()">&#9776;</button>
			</div>
			<div class="w3-container content">
				<h2><?php echo $name;?></h2>
				<img src="../<?php echo $image;?>" alt="<?php echo $name;?>">
				<p><?php echo $description;?></p>
				<hr>
			</div>
			<div class="comment-section">
				<h4>Add your comment here...</h4>
				<form name="commentform" class="commentForm" action="comment.php" method="post">
					<input type="text" name="name" value="<?php echo $name;?>" hidden>
					<input type="text" name="username" value="<?php echo $username;?>" hidden>
					<input type="text" name="time" value="<?php echo date('Y-m-d H:i:s');?>" hidden>
					<textarea name="comment" rows="10" cols="30" class="commentArea" placeholder="Comment here..." required></textarea><br>
					<input type="submit" id="commentButton" value="SUBMIT">
				</form>
			</div>
			<div class="comment-display">
				<hr>
				<?php
					$sql = "SELECT * FROM Comment WHERE Name='$name'";
					$result = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_assoc($result)){
						$u = $row['Username'];
						$dt = $row['date_time'];
						$m = $row['Message'];
						$sql = "SELECT Fullname FROM Profile WHERE Username='$u'";
						$res = mysqli_fetch_assoc(mysqli_query($conn,$sql));
						$f = $res['Fullname'];
						echo "<p><span class='dark'>$f ($u)</span> <span class='gray'>$dt</span><br>$m</p>";
					}
				?>
			</div>
		</div>
		<div class="br"></div>
		<?php include('../footer.php');?>
		<script src="../js/navbar.js"></script>
		<script>
			function w3_open() {
				document.getElementById("main").style.marginLeft = "25%";
				document.getElementById("mySidebar").style.width = "25%";
				document.getElementById("mySidebar").style.display = "block";
				document.getElementById("openNav").style.display = 'none';
			}
			function w3_close() {
				document.getElementById("main").style.marginLeft = "0%";
				document.getElementById("mySidebar").style.display = "none";
				document.getElementById("openNav").style.display = "inline-block";
			}
		</script>
	</body>
</html>