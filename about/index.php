<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | About Us</title>
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
		<div class="content">
			<h2>About Us</h2>
			<hr>
			<p><strong>About Bon Voyage : </strong>This website and opinion site officially started on 1st July 2017, although we wrote a few posts in the end of September 2017. 
			The reason we started Bon Voyage as a project, and in the process it has become a website which helps us and the readers of this website intouch with Indian Tourism 
			and latest news regarding Indian tourism. The focus of this website will always remain on Indian Tourism in general, however,  as we are being in IT for more than a 
			few years and being passionate about technology we may sometimes drift	into Technology and Web.</p>
			<p><strong>About India : </strong>Tourism in India has shown a phenomenal growth in the past decade. One of the reasons is that the Ministry of tourism, India has 
			realized the immense potential of tourism in India during vacations. India travel tourism has grown rapidly with a great influx of tourists from all across the globe 
			who have been irresistibly attracted to the rich culture, heritage, and incredible natural beauty of India. India tourism with its foggy hill stations, captivating 
			beaches, historical monuments, golden deserts, serene backwaters, pilgrimage sites, rich wildlife, and colourful fairs capture the heart of every tourist. In addition, 
			a variety of festivals, lively markets, vibrant lifestyle, and traditional Indian hospitality, will make your experience as an india tourist truly unforgettable and 
			fantastic. Travel through the lovely Indian states and discover closely the resplendent colors and rich cultural locales of this incredible land. Our India tourism 
			guide provides you a glimpse of travel and tourism in india, india tourism information about south india tourism, north India tourism, and all the major tourist 
			destinations, and tourism services of India. For more information about travel and tourism India and tourism of India, click BonVOYAGE.</p><br>
		</div>
		<div class="br"></div>
		<?php include('../footer.php');?>
		<script src="../js/navbar.js"></script>
	</body>
</html>