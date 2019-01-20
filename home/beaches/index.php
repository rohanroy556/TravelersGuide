<?php
	session_start();
	include("../../config.php");
	$name = $_GET['name'];
	$sql = "SELECT * FROM Description WHERE Type='Beach'";
	$result = mysqli_query($conn,$sql);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | Beaches</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../../img/home.png" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php
			if(!isset($_SESSION['Username']))
				include("../../nav1.php");
			else
				include("../../nav2.php");
		?>
		<div class="br"></div><br>
		<div class="container">
			<h2>Famous Indian Beaches</h2>
			<p> India is gifted with some of the best beaches in the world spread across the coastal lines of Southern India. 
			It embraces as many as 215 incredibly scenic beaches that offer everything from beauty to solace to action and invites 
			people from different parts of the country to get involved in a wide range of beach activities. However, not every 
			beach is commercialized in India…most of them have been simply abandoned due to lack of proper care and maintenance. 
			Recently, Tripadvisor announced the top 25 beaches in India ranked on the basis of reviews by millions of travellers 
			across the world. In case you are planning to treat yourself with an Indian beach holiday, here’s the list of top 25 
			beaches in India to help you plan your vacation smartly.</p>
			<div class="row">
				<?php
					while($row = mysqli_fetch_assoc($result)){
						$name = $row['Name'];
						$image = $row['Image'];
						$heading = $row['Heading'];
						echo "<div class=\"col-md-4\"><div class=\"thumbnail\">";
						echo "<a href=\"../../description/?name=$name\">";
						echo "<img src=\"../../$image\" alt=\"$name\" style=\"width:100%\">";
						echo "<div class=\"caption\">";
						echo "<h4>$name</h4>";
						echo "<p>$heading</p>";
						echo "</div></a></div></div>";
					}
				?>
			</div>
		</div>
		<div class="br"></div>
		<?php include('../../footer.php');?>
		<script src="../../js/navbar.js"></script>
	</body>
</html>