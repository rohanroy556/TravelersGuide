<?php
	session_start();
	if(!isset($_SESSION['Username'])){
		header("Location: ../login");
		exit;
	}
	include("../config.php");
	$username=$_SESSION['Username'];
	$sql = "SELECT * FROM Profile WHERE Username='$username'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$fullname=$row['Fullname'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Welcome | <?php echo $fullname;?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../css/content.css">
		<link rel="stylesheet" type="text/css" href="css/userhome.css">
		<link rel="stylesheet" type="text/css" href="../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../img/home.png" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			
		</style>
	</head>
	<body>
		<?php include("../nav2.php");?>
		<div class="br"></div>
		<div class="heading">
			<h1><i class="fa fa-plane"></i> Welcome <?php echo $fullname;?> !</h1>
			<p>Your Travel Guide</p> 
		</div>
		<div class="br"></div>
		<div class="news" title="Latest News">
			<div class="content">
				<table>
					<?php
						$sql = "SELECT * FROM News ORDER BY Date DESC";
						$result = mysqli_query($conn,$sql);
						for($i=1;$i<=2;$i++){
							$row = mysqli_fetch_assoc($result);
							$name = $row['Name'];
							$heading = $row['Heading'];
							$image = $row['Image'];
							$description = $row['Description'];
							$description = substr($description, 0, 100);
							$date = $row['Date'];
							echo "<tr>
									<td width='30%'><img src='../$image' alt='$name'></td>	
									<td>
										<h4>$heading</h4>
										<p>Update on $date</p>
										<p>$description...<a href='../news/description/?name=$name' >more</a></p>
									</td>								
								</tr>";
						}
					?>
				</table>
				<a href="../news" class="goto">News &#10095;</a>
			</div>
		</div>
		<div class="slideshow" title="Famous places in India">
			<div class="slideshow-container">
				<img class="slides" id="slides1">	
				<a href="../home/monuments" class="goto">Monuments &#10095;</a>
			</div>	
			<div class="br"></div>
			<div class="slideshow-container">
				<img class="slides" id="slides2">	
				<a href="../home/cities" class="goto">Cities &#10095;</a>
			</div>
		</div>
		<div class="gallery">
			<div class="gallery-container">
				<h2>Visit your Gallery</h2>
				<p>Here you can add your pictures or you can view uploaded pictures</p>
				<a href="gallery" class="goto">Gallery &#10095;</a>
			</div>
		</div>
		<div class="br"></div>
		<?php include('../footer.php');?>
		<?php
			$monuments = scandir("../img/monuments");
			$cities = scandir("../img/cities");
		?>
		<script src="../js/navbar.js"></script>
		<script>
			var monumentsIndex = 1;
			var citiesIndex = 1;
			var slides1 = $("#slides1");
			var slides2 = $("#slides2");
			var dots1 = $(".1");
			var dots2 = $(".2");
			var monuments=<?php echo json_encode($monuments); ?>;
			monuments.splice(0,2,"");
			var cities=<?php echo json_encode($cities); ?>;
			cities.splice(0,2,"");
			showMonuments(monumentsIndex);
			showCities(citiesIndex);
			function showMonuments(n) {
				var i,l;
				l = monuments.length-1;
				if (typeof(n) == "undefined")
					n = monumentsIndex+1;
				n = n>l?1:n<1?l:n;
				monumentsIndex = n;
				slides1.attr('src',"../img/monuments/"+monuments[n]);
				setTimeout(showMonuments, 2000);
			}
			function showCities(n) {
				var i,l;
				l = cities.length-1;
				if (typeof(n) == "undefined")
					n = citiesIndex+1;
				n = n>l?1:n<1?l:n;
				citiesIndex = n;
				slides2.attr('src',"../img/cities/"+cities[n]);
				setTimeout(showCities, 2000);
			}
			function getName(s){
				s = s.split(".");
				return s[0];
			}
		</script>
	</body>
</html>