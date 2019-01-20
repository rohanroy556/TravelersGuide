<?php
	session_start();
	include("../../config.php");
	$name = $_GET['name'];
	$sql = "SELECT * FROM Description WHERE Type='Monument'";
	$result = mysqli_query($conn,$sql);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | Monuments</title>
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
			<h2>Famous Monuments in India</h2>
			<p>India’s architectural splendor is a fine exemplar of its golden past. The emperors of history left an imprint of their reign in the form of these spectacular 
			vestiges which speak greatly about their king. The architectural heritage of our country is our ancestral property which needs to be preserved with utmost care 
			so as to be passed on to the future generations. There is a plethora of known and unknown monuments in India, each with a story of its own. The impressionable 
			magnificence of some of them makes them relatively popular and significant from the others. So today I am going to write about ten such monuments which have proved 
			to be glorious for the nation.</p>
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