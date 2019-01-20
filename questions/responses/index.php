<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	include("../../config.php");
	$ques_id = $_GET['id'];
	if(!isset($ques_id)){
		header('Location: ../../home');
		exit;
	}
	$sql = "SELECT * FROM Questions WHERE Id=$ques_id";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)==0){
		header('Location: ../home');
		exit;
	}
	$row = mysqli_fetch_assoc($result);
	$question = $row['Question'];
	$questioner = $row['Questioner'];
	$ques_date = $row['date_time'];
	$username = '';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bon Voyage | Response</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../../css/navbar.css">
		<link rel="stylesheet" type="text/css" href="../../css/content.css">
		<link rel="stylesheet" type="text/css" href="../css/question.css">
		<link rel="stylesheet" type="text/css" href="../../css/footer.css">
		<link rel="shortcut icon" type="image/x-icon" href="../../img/home.png" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			.content .ques{
				color: #555;
				font-size: 16px;
			}
			.content p:not[.ques]{
				text-decoration: none;
				color: #333;
				font-size: 20px;
				padding: 20px;
				display: block;
			}
		</style>
	</head>
	<body>
		<?php
			if($questioner!='Anonymous'){
				$sql = "SELECT Fullname FROM Profile WHERE Username='$questioner'";
				$res = mysqli_fetch_assoc(mysqli_query($conn,$sql));
				$fullname = $res['Fullname'];
				$questioner = "$fullname ($questioner)";
			}
			if(!isset($_SESSION['Username'])){
				include("../../nav1.php");
			}
			else{
				include("../../nav2.php");
				$username = $_SESSION['Username'];
			}
		?>
		<div class="br"></div>
		<div id="main">
			<div class="content">
				<h2><?php echo $question;?></h2>
				<p class="ques"><span><?php echo $questioner;?></span>
				<span style="float: right;"><?php echo $ques_date;?></span></p><br>
				<?php
					$sql = "SELECT * FROM Responses WHERE Ques_id=$ques_id";
					$result = mysqli_query($conn,$sql);
					if(mysqli_num_rows($result)==0){
						echo "<p>No responses uploaded yet, sorry.</p><br><br>";
					}
					else{
						while($row = mysqli_fetch_assoc($result)){
							$u = $row['Answerer'];
							$dt = $row['date_time'];
							$m = $row['Response'];
							$sql = "SELECT Fullname FROM Profile WHERE Username='$u'";
							$res = mysqli_fetch_assoc(mysqli_query($conn,$sql));
							$f = $res['Fullname'];
							echo "<p><span class='dark'>$f ($u)</span> <span class='gray'>$dt</span><br>$m</p><br>";
						}
					}
				?>
			</div>
			<div class="question-section">
				<h4>Add give your responses here...</h4>
				<form name="questionform" class="questionForm" action="response.php" method="post">
					<input type="int" name="ques_id" value="<?php echo $ques_id;?>" hidden>
					<input type="text" name="username" value="<?php echo $username;?>" hidden>
					<input type="text" name="time" value="<?php echo date('Y-m-d H:i:s');?>" hidden>
					<textarea name="response" rows="10" cols="30" class="questionArea" placeholder="response here..." required></textarea><br>
					<input type="submit" id="questionButton" value="SUBMIT">
				</form>
			</div>
		</div>
		<div class="br"></div>
		<?php include('../../footer.php');?>
		<script src="../../js/navbar.js"></script>
	</body>
</html>