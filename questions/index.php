<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	include("../config.php");
	$sql = "SELECT * FROM Questions  ORDER BY date_time DESC";
	$result = mysqli_query($conn,$sql);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | Questions</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../css/content.css">
		<link rel="stylesheet" type="text/css" href="css/question.css">
		<link rel="stylesheet" type="text/css" href="../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../img/home.png" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			.content a{
				text-decoration: none;
				color: #333;
				font-size: 20px;
				padding: 20px;
				border: 1px solid #333;
				display: block;
			}
			.content a:hover{
				background-color: #333;
				color: #fff;
			}
		</style>
	</head>
	<body>
		<?php
			if(!isset($_SESSION['Username'])){
				include("../nav1.php");
				$username = 'Anonymous';
			}
			else{
				include("../nav2.php");
				$username = $_SESSION['Username'];
			}
		?>
		<div class="br"></div>
		<div id="main">
			<div class="content">
				<h2>Ask a Question or Queries</h2><br>
				<?php
					if(mysqli_num_rows($result)==0){
						echo "<br><p>No questions uploaded yet. If you have any questions or queries then you can ask here.</p><br><br>";
					}
					else{
						while($row = mysqli_fetch_assoc($result)){
							$id = $row['Id'];
							$question = $row['Question'];
							$date = $row['date_time'];
							echo "<a href='responses/?id=$id'>$question</a><br>";
						}
					}
				?>
			</div>
			<div class="question-section">
				<h4>Add your question here...</h4>
				<form name="questionform" class="questionForm" action="question.php" method="post">
					<input type="text" name="username" value="<?php echo $username;?>" hidden>
					<input type="text" name="time" value="<?php echo date('Y-m-d H:i:s');?>" hidden>
					<textarea name="question" rows="10" cols="30" class="questionArea" placeholder="question here..." required></textarea><br>
					<input type="submit" id="questionButton" value="SUBMIT">
				</form>
			</div>
		</div>
		<div class="br"></div>
		<?php include('../footer.php');?>
		<script src="../js/navbar.js"></script>
	</body>
</html>