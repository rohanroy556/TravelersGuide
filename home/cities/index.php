<?php
	session_start();
	include("../../config.php");
	$sql = "SELECT * FROM Description WHERE Type='City'";
	$result = mysqli_query($conn,$sql);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | Cities</title>
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
			<h2>Famous Indian Cities</h2>
			<p>India is very very diverse – probably the most diverse of countries that you will find on this earth. We have some of the Coldest places in Kashmir, 
			A place that has highest rainfall in world – Cherrapunji, and also one if the driest places on the Earth – The Thar Desert. Adding to that – More than half of 
			Indian boundary is home to beautiful beaches. And don’t forget that Northern part of India hosts Himalayan Ranges snow capped mountains.<br><br>
			Mix all this with different cultures and hundreds of Languages and Dialects – You have a got a potent mix of diversity. If you really think, 
			I really am amazed that with such diverse people & geographies how do we operate as one single democratic country !</p>
			<p>Here are some cities where you love to visit.</p>
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