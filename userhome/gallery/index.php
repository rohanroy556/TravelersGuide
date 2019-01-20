<?php
	session_start();
	error_reporting(0);
	if(!isset($_SESSION['Username'])){
		header("Location: ../../login");
		exit;
	}
	include("../../config.php");
	$username=$_SESSION['Username'];
	$sql = "SELECT * FROM Profile WHERE Username='$username'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$fullname=$row['Fullname'];
	$path = "../../img/pictures/";
	$c=false;
	$folders = scandir($path);
	for($i=2;$i<count($folders);$i++){
		if($folders[$i]==$username&&is_dir($username)){
			$path = $path.$username.'/';
			$pic = scandir($path);
			$c=true;
			break;
		}
	}
	if(!$c){
		$path = $path.$username.'/';
		mkdir($path);
		$pic = scandir($path);
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | Gallery</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../../css/slideshow.css">
		<link rel="stylesheet" type="text/css" href="../../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../../img/home.png" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php include("../../nav2.php");?>
		<div class="br"></div>
		<h1 style="text-align: center; color: #333;">My Gallery</h1>
		<div class="slideshow" title="My Pictures">
			<div class="slideshow-container">
				<div class="num" id="number1"></div>
				<img class="slides" id="slides1" src="../../img/pictures/blank.jpg" height="auto">
			</div>
			<a class="prev" id="prev1">&#10094;</a>
			<a class="next" id="next1">&#10095;</a>
			<div style="text-align:center">
				<?php
					if(count($pic)==2)
						echo '<span class="dot 1"></span>';
					else{
						for($i=2;$i<count($pic);$i++)
							echo '<span class="dot 1"></span>';
					}
				?>
			</div><br>
			<a href="upload.php" class="goto">Add New &#10095;</a>
		</div>
		<div class="br"></div>
		<?php include('../../footer.php');?>
		<script src="../../js/navbar.js"></script>
		<script>
			var picIndex = 1;
			var slides1 = $("#slides1");
			var dots1 = $(".1");
			var path = "<?php echo $path;?>";
			var pic = <?php echo json_encode($pic); ?>;
			pic.splice(0,2,"");
			showPic(picIndex);
			$("#prev1").click(function()  {
				showPic(picIndex -= 1);
			});
			$("#next1").click(function()  {
				showPic(picIndex += 1);
			});
			dots1.click(function()  {
				var n = $(this).index()+1;
				showPic(picIndex = n);
			});
			function showPic(n) {
				var i,l;
				l = pic.length-1;
				if(l!=0){
					n = n>l?1:n<1?l:n;
					picIndex = n;
					slides1.attr('src',path+pic[n]);
					for(i=0;i<dots1.length;i++)
						dots1[i].style.backgroundColor = "#bbb";
					dots1[n-1].style.backgroundColor = "#717171";
					$("#number1").html(n+"/"+l);
				}
			}
			function getName(s){
				s = s.split(".");
				return s[0];
			}
		</script>
	</body>
</html>