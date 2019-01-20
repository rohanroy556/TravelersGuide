<?php
	session_start();
	if(!isset($_SESSION['Username'])){
		header("Location: ../../login");
		exit;
	}
	include("../../config.php");
	$username=$_SESSION['Username'];
	$sql = "SELECT * FROM profile WHERE Username='$username'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$fullname=$row['Fullname'];
	$path = "../../img/pictures/$username/";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | Gallery</title>
		<link rel="stylesheet" type="text/css" href="../../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../../img/home.png" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			.myform{
				text-align:center;
				margin:50px auto;
				border: 1px solid #333;
				max-width: 800px;
			}
			.inputfile {
				width: 0.1px;
				height: 0.1px;
				opacity: 0;
				overflow: hidden;
				position: absolute;
				z-index: -1;
			}
			.inputfile + label {
				font-size: 20px;
				font-weight: 700;
				color: white;
				background-color: black;
				display: inline-block;
				cursor: pointer;
				padding: 10px;
			}
			.inputfile:focus + label,
			.inputfile + label:hover {
				background-color: red;
			}
			.button{
				height:60px;
				border:1px solid #ccc;
				border-radius:4px;
				outline:none;
				padding:10px;
				font-size:20px;
				color:black;
				background:linear-gradient(#fff,#ccc);
			}
			.button:hover{
				color:white;
				border:#555;
				background:linear-gradient(#555,#aaa);
			}
			.myform p{
				font-size:20px;
				margin:auto;
				padding:20px;
				background-color:#ccc;
			}
		</style>
	</head>
	<body>
		<?php include("../../nav2.php");?>
		<div class="br"></div>
		<h1 style="text-align: center;">Add to the Gallery</h1><br><br>
		<?php
			$target_dir = $path;
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$target_file = $target_dir . basename($_FILES["file"]["name"]);
				$uploadFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$fileSize = $_FILES["file"]["size"];
				$fileTypes = array("jpg","png","JPG","JPEG","PNG","bmp","BMP","jpe","JPE","tif","tiff","TIFF","gif","GIF");
				$fileNames = scandir($target_dir);
				if(in_array($uploadFileType,$fileTypes) && $fileSize<=40*1024*1024 && 
					!in_array($_FILES["file"]["name"],$fileNames))
					move_uploaded_file( $_FILES['file']['tmp_name'], $target_file);
				else
					echo "Cannot upload file ".$_FILES["file"]["name"];
			}
		?>
		<div class="myform">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
				<p>Select image to upload:</p><br>
				<input type="file" name="file" id="file" class="inputfile" />
				<label for="file"><i class="fa fa-upload"></i> Choose a file</label><br><br>
				<input type="submit" value="Upload Image" name="submit" class="button"><br><br>
			</form>
		</div><br>
		<div class="br"></div>
		<?php include('../../footer.php');?>
		<script src="../../js/navbar.js"></script>
	</body>
</html>