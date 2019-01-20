<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | Home</title>
		<link rel="stylesheet" type="text/css" href="../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../css/slideshow.css">
		<link rel="stylesheet" type="text/css" href="../css/footer.css">
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<link rel="shortcut icon" type="image/x-icon" href="../img/home.png" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php
			if(!isset($_SESSION['Username']))
				include("../nav1.php");
			else
				include("../nav2.php");
			$monuments = scandir("../img/monuments");
			$cities = scandir("../img/cities");
			$beaches = scandir("../img/beaches");
		?>
		<div class="br"></div>
		<div class="heading">
			<h1><i class="fa fa-plane"></i> Welcome to Bon Voyage !</h1>
			<p>Your Travel Guide</p> 
			<a href="../signup" class="goto">Join Us &#10095;</a>
		</div>
		<div class="br"></div>
		<h1 class="slideheading">Famous Monuments in India</h1>
		<div class="slideshow" title="Famous Monuments in India">
			<div class="slideshow-container">
				<div class="num" id="number1"></div>
				<img class="slides" id="slides1">
				<div class="text" id="text1"></div>
			</div>
			<a class="prev" id="prev1">&#10094;</a>
			<a class="next" id="next1">&#10095;</a>
			<div style="text-align:center">
				<?php
					for($i=2;$i<count($monuments);$i++)
						echo '<span class="dot 1"></span>';
				?> 
			</div>			
			<a href="monuments" class="goto">View &#10095;</a>
		</div>
		<div class="br"></div>
		<h1 class="slideheading">Famous Cities in India</h1>
		<div class="slideshow" title="Famous Cities in India">
			<div class="slideshow-container">
				<div class="num" id="number2"></div>
				<img class="slides" id="slides2">
				<div class="text" id="text2"></div>
			</div>
			<a class="prev" id="prev2">&#10094;</a>
			<a class="next" id="next2">&#10095;</a>
			<div style="text-align:center">
				<?php
					for($i=2;$i<count($cities);$i++)
						echo '<span class="dot 2"></span>';
				?>
			</div>			
			<a href="cities" class="goto">View &#10095;</a>
		</div>
		<div class="br"></div>
		<h1 class="slideheading">Famous Beaches in India</h1>
		<div class="slideshow" title="Famous Beaches in India">
			<div class="slideshow-container">
				<div class="num" id="number3"></div>
				<img class="slides" id="slides3">
				<div class="text" id="text3"></div>
			</div>
			<a class="prev" id="prev3">&#10094;</a>
			<a class="next" id="next3">&#10095;</a>
			<div style="text-align:center">
				<?php
					for($i=2;$i<count($beaches);$i++)
						echo '<span class="dot 3"></span>';
				?>
			</div>			
			<a href="beaches" class="goto">View &#10095;</a>
		</div>
		<div class="br"></div>
		<?php include('../footer.php');?>
		<script src="../js/navbar.js"></script>
		<script>
			var monumentsIndex = 1;
			var citiesIndex = 1;
			var beachesIndex = 1;
			var slides1 = $("#slides1");
			var slides2 = $("#slides2");
			var slides3 = $("#slides3");
			var dots1 = $(".1");
			var dots2 = $(".2");
			var dots3 = $(".3");
			var monuments = <?php echo json_encode($monuments); ?>;
			monuments.splice(0,2,"");
			var cities = <?php echo json_encode($cities); ?>;
			cities.splice(0,2,"");
			var beaches = <?php echo json_encode($beaches); ?>;
			beaches.splice(0,2,"");
			showMonuments(monumentsIndex);
			showCities(citiesIndex);
			showBeaches(beachesIndex);
			$("#prev1").click(function()  {
				showMonuments(monumentsIndex -= 1);
			});
			$("#next1").click(function()  {
				showMonuments(monumentsIndex += 1);
			});
			dots1.click(function()  {
				var n = $(this).index()+1;
				showMonuments(monumentsIndex = n);
			});
			function showMonuments(n) {
				var i,l;
				l = monuments.length-1;
				n = n>l?1:n<1?l:n;
				monumentsIndex = n;
				slides1.attr('src',"../img/monuments/"+monuments[n]);
				for(i=0;i<dots1.length;i++)
					dots1[i].style.backgroundColor = "#bbb";
				dots1[n-1].style.backgroundColor = "#717171";
				$("#text1").html(getName(monuments[n]));
				$("#number1").html(n+"/"+l);
			}
			$("#prev2").click(function()  {
				showCities(citiesIndex -= 1);
			});
			$("#next2").click(function()  {
				showCities(citiesIndex += 1);
			});
			dots2.click(function()  {
				var n = $(this).index()+1;
				showCities(citiesIndex = n);
			});
			function showCities(n) {
				var i,l;
				l = cities.length-1;
				n = n>l?1:n<1?l:n;
				citiesIndex = n;
				slides2.attr('src',"../img/cities/"+cities[n]);
				for(i=0;i<dots2.length;i++)
					dots2[i].style.backgroundColor = "#bbb";
				dots2[n-1].style.backgroundColor = "#717171";
				$("#text2").html(getName(cities[n]));
				$("#number2").html(n+"/"+l);
			}
			$("#prev3").click(function() {
				showBeaches(beachesIndex -= 1);
			});
			$("#next3").click(function() {
				showBeaches(beachesIndex += 1);
			});
			dots3.click(function() {
				var n = $(this).index()+1;
				showBeaches(beachesIndex = n);
			});
			function showBeaches(n) {
				var i,l;
				l = beaches.length-1;
				n = n>l?1:n<1?l:n;
				beachesIndex = n;
				slides3.attr('src',"../img/beaches/"+beaches[n]);
				for(i=0;i<dots3.length;i++)
					dots3[i].style.backgroundColor = "#bbb";
				dots3[n-1].style.backgroundColor = "#717171";
				$("#text3").html(getName(beaches[n]));
				$("#number3").html(n+"/"+l);
			}
			function getName(s){
				s = s.split(".");
				return s[0];
			}
		</script>
	</body>
</html>