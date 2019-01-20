<?php
	session_start();
	if(!isset($_GET['name'])){
		header('Location: ../../home');
		exit;
	}
	include("../../config.php");
	$name = $_GET['name'];
	$sql = "SELECT * FROM News WHERE Name='$name'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)==0){
		header('Location: ../../home');
		exit;
	}
	$row = mysqli_fetch_assoc($result);
	$heading = $row['Heading'];
	$image = $row['Image'];
	$description = $row['Description'];
	$date = $row['Date'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | <?php echo $name;?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../../css/content.css">
		<link rel="stylesheet" type="text/css" href="../../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../img/home.png" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php
			if(!isset($_SESSION['Username']))
				include("../../nav1.php");
			else{
				include("../../nav2.php");
			}
		?>
		<div class="br"></div>
		<div class="content">
			<h2><?php echo $heading;?></h2>
			<p style="color: #555;">Update on <?php echo $date;?></p>
			<img src="../../<?php echo $image;?>" alt="<?php echo $name;?>">
			<p><?php echo $description;?></p>
		</div>
		<div class="br"></div>
		<?php include('../../footer.php');?>
		<script src="../../js/navbar.js"></script>
	</body>
</html>